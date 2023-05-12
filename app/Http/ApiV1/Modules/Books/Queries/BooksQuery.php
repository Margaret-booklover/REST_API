<?php

namespace App\Http\ApiV1\Modules\Books\Queries;

use App\Domain\Books\Models\Book;
use Spatie\QueryBuilder\QueryBuilder;

class BooksQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = Book::query();

        parent::__construct($query);
        $this->allowedIncludes([
            'protocols'
        ]);
        $this->defaultSort('id');

    }

}
