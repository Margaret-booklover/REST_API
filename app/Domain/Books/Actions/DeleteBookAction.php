<?php

namespace App\Domain\Books\Actions;

use App\Domain\Books\Models\Book;

class DeleteBookAction
{
    public function execute(int $id): void
    {
        Book::where('id',$id)->delete();
    }

}
