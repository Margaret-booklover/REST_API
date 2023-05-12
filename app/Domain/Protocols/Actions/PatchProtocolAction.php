<?php

namespace App\Domain\Protocols\Actions;

use App\Domain\Protocols\Models\Protocol;

class PatchProtocolAction
{
    public function execute(int $id, array $fields): Protocol
    {
        /** @var Protocol $protocol */
        $protocol = Protocol::query()->findOrFail($id);
        $protocol->update($fields);
        $protocol->save();
        return $protocol;
    }
}
