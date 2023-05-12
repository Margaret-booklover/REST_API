<?php

namespace App\Http\ApiV1\Modules\Protocols\Resources;

use App\Domain\Protocols\Models\Protocol;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class ProtocolResource extends BaseJsonResource
{
    /** @mixin Protocol
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'book_id' => $this->book_id,
            'seller_id' => $this->seller_id,
            'buyer_id' => $this->buyer_id,
        ];
    }
}

