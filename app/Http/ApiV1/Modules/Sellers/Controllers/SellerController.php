<?php

namespace App\Http\ApiV1\Modules\Sellers\Controllers;

use App\Domain\Sellers\Actions\CreateSellerAction;
use App\Domain\Sellers\Actions\DeleteSellerAction;
use App\Domain\Sellers\Actions\PatchSellerAction;
use App\Http\ApiV1\Modules\Sellers\Queries\SellersQuery;
use App\Http\ApiV1\Modules\Sellers\Requests\AddSellerRequest;
use App\Http\ApiV1\Modules\Sellers\Requests\PatchSellerRequest;
use App\Http\ApiV1\Modules\Sellers\Resources\SellerResource;
use App\Http\ApiV1\Support\Resources\EmptyResource;

class SellerController
{
    public function get(int $id, SellersQuery $query): SellerResource
    {
        return new SellerResource($query->findOrFail($id));
    }
    public function delete(int $id, DeleteSellerAction $action): EmptyResource
    {
        $action->execute($id);
        return new EmptyResource();
    }
    public function patch(int $id, PatchSellerRequest $request, PatchSellerAction $action): SellerResource
    {
        return new SellerResource($action->execute($id, $request->validated()));
    }
    public function create(AddSellerRequest $request, CreateSellerAction $action): SellerResource
    {
        return new SellerResource($action->execute($request->validated()));
    }
}
