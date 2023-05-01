<?php

namespace App\Http\ApiV1\Modules\Buyers\Queries;

use App\Domain\Buyers\Models\Buyer;
use Spatie\QueryBuilder\QueryBuilder;

class BuyersQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = Buyer::query();

        parent::__construct($query);
        $this->allowedIncludes([
            'protocols'
        ]);
        $this->defaultSort('id');

    }

}
