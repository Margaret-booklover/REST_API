<?php

namespace App\Http\ApiV1\Modules\Sellers\Resources;

use App\Domain\Sellers\Models\Seller;
use App\Http\ApiV1\Modules\Protocols\Resources\ProtocolResource;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;
use Illuminate\Http\Request;

class SellerResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     * @mixin Seller
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'fio' => $this->fio,
            'phone' => $this->phone,
            'protocols' => ProtocolResource::collection($this->whenLoaded('protocols')),
        ];
    }
}
