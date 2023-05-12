<?php

namespace App\Http\ApiV1\Modules\Sellers\Queries;

use App\Domain\Sellers\Models\Seller;
use Spatie\QueryBuilder\QueryBuilder;

class SellersQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = Seller::query();

        parent::__construct($query);
        $this->allowedIncludes([
            'protocols'
        ]);
        $this->defaultSort('id');

    }

}
