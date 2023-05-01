<?php

namespace App\Domain\Books\Actions;

use App\Domain\Books\Models\Book;

class ReplaceBookAction
{
    public function execute(int $id, array $fields): Book
    {
        /** @var Book $book */
        $book = Book::query()->findOrFail($id);
        $book->update($fields);
        $book->save();
        return $book;
    }
}
