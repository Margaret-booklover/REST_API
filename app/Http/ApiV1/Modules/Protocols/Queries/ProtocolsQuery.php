<?php

namespace App\Http\ApiV1\Modules\Protocols\Queries;

use App\Domain\Protocols\Models\Protocol;
use Spatie\QueryBuilder\QueryBuilder;

class ProtocolsQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = Protocol::query();

        parent::__construct($query);
        $this->defaultSort('id');
    }
}
