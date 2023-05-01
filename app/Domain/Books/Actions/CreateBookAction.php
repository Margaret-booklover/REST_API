<?php

namespace App\Domain\Books\Actions;

use App\Domain\Books\Models\Book;

class CreateBookAction
{
    public function execute(array $fields): Book
    {
        $book = new Book();
        $book->fill($fields);
        $book->save();
        return $book;
    }
}
