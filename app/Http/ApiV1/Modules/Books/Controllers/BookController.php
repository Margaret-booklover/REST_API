<?php

namespace App\Http\ApiV1\Modules\Books\Controllers;

use App\Domain\Books\Actions\CreateBookAction;
use App\Domain\Books\Actions\DeleteBookAction;
use App\Domain\Books\Actions\PatchBookAction;
use App\Domain\Books\Actions\ReplaceBookAction;
use App\Http\ApiV1\Modules\Books\Queries\BooksQuery;
use App\Http\ApiV1\Modules\Books\Requests\AddBookRequest;
use App\Http\ApiV1\Modules\Books\Requests\PatchBookRequest;
use App\Http\ApiV1\Modules\Books\Requests\ReplaceBookRequest;
use App\Http\ApiV1\Modules\Books\Resources\BookResource;
use App\Http\ApiV1\Support\Resources\EmptyResource;

class BookController
{
    public function create(AddBookRequest $request, CreateBookAction $action): BookResource
    {
        return new BookResource($action->execute($request->validated()));
    }
    public function replace(int $id, ReplaceBookRequest $request, ReplaceBookAction $action): BookResource
    {
        return new BookResource($action->execute($id, $request->validated()));
    }
    public function patch(int $id, PatchBookRequest $request, PatchBookAction $action): BookResource
    {
        return new BookResource($action->execute($id, $request->validated()));
    }
    public function delete(int $id, DeleteBookAction $action): EmptyResource
    {
        $action->execute($id);
        return new EmptyResource();
    }
    public function get(int $id, BooksQuery $query): BookResource
    {
        return new BookResource($query->findOrFail($id));
    }
}
