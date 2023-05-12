<?php

namespace App\Http\ApiV1\Support\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseJsonResource extends JsonResource
{
    public const DATE_FORMAT = 'Y-m-d';

    public function dateToIso(?DateTime $date): ?string
    {
        return $date?->format(static::DATE_FORMAT);
    }

}
