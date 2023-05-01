<?php

namespace App\Http\ApiV1\Modules\Protocols\Controllers;

use App\Domain\Protocols\Actions\CreateProtocolAction;
use App\Domain\Protocols\Actions\DeleteProtocolAction;
use App\Domain\Protocols\Actions\PatchProtocolAction;
use App\Http\ApiV1\Modules\Protocols\Queries\ProtocolsQuery;
use App\Http\ApiV1\Modules\Protocols\Requests\AddProtocolRequest;
use App\Http\ApiV1\Modules\Protocols\Requests\PatchProtocolRequest;
use App\Http\ApiV1\Modules\Protocols\Resources\ProtocolResource;
use App\Http\ApiV1\Support\Resources\EmptyResource;

class ProtocolController
{
    public function get(int $id, ProtocolsQuery $query): ProtocolResource
    {
        return new ProtocolResource($query->findOrFail($id));
    }
    public function delete(int $id, DeleteProtocolAction $action): EmptyResource
    {
        $action->execute($id);
        return new EmptyResource();
    }
    public function patch(int $id, PatchProtocolRequest $request, PatchProtocolAction $action): ProtocolResource
    {
        return new ProtocolResource($action->execute($id, $request->validated()));
    }
    public function create(AddProtocolRequest $request, CreateProtocolAction $action): ProtocolResource
    {
        return new ProtocolResource($action->execute($request->validated()));
    }
}
