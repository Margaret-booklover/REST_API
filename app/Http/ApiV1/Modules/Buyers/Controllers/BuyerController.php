<?php

namespace App\Http\ApiV1\Modules\Buyers\Controllers;

use App\Domain\Buyers\Actions\CreateBuyerAction;
use App\Domain\Buyers\Actions\DeleteBuyerAction;
use App\Domain\Buyers\Actions\PatchBuyerAction;
use App\Http\ApiV1\Modules\Buyers\Queries\BuyersQuery;
use App\Http\ApiV1\Modules\Buyers\Requests\AddBuyerRequest;
use App\Http\ApiV1\Modules\Buyers\Requests\PatchBuyerRequest;
use App\Http\ApiV1\Modules\Buyers\Resources\BuyerResource;
use App\Http\ApiV1\Support\Resources\EmptyResource;

class BuyerController
{
    public function get(int $id, BuyersQuery $query): BuyerResource
    {
        return new BuyerResource($query->findOrFail($id));
    }
    public function delete(int $id, DeleteBuyerAction $action): EmptyResource
    {
        $action->execute($id);
        return new EmptyResource();
    }
    public function patch(int $id, PatchBuyerRequest $request, PatchBuyerAction $action): BuyerResource
    {
        return new BuyerResource($action->execute($id, $request->validated()));
    }
    public function create(AddBuyerRequest $request, CreateBuyerAction $action): BuyerResource
    {
        return new BuyerResource($action->execute($request->validated()));
    }
}
