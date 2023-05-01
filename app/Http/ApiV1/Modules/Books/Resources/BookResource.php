<?php

namespace App\Http\ApiV1\Modules\Books\Resources;

use App\Domain\Books\Models\Book;
use App\Http\ApiV1\Modules\Protocols\Resources\ProtocolResource;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class BookResource extends BaseJsonResource
{
    /**@mixin Book
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'author' => $this->author,
            'title' => $this->title,
            'count' => $this->count,
            'price' => $this->price,
            'protocols' => ProtocolResource::collection($this->whenLoaded('protocols')),
        ];
    }
}

