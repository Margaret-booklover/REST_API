<?php

namespace App\Http\ApiV1\Modules\Buyers\Resources;

use App\Domain\Buyers\Models\Buyer;
use App\Http\ApiV1\Modules\Protocols\Resources\ProtocolResource;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;
use Illuminate\Http\Request;

class BuyerResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     * @mixin Buyer
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'fio' => $this->fio,
            'status' => $this->status,
            'protocols' => ProtocolResource::collection($this->whenLoaded('protocols')),
        ];
    }
}
