<?php

namespace App\Domain\Protocols\Actions;

use App\Domain\Protocols\Models\Protocol;

class CreateProtocolAction
{
    public function execute(array $fields): Protocol
    {
        $protocol = new Protocol();
        $protocol->fill($fields);
        $protocol->save();
        return $protocol;
    }
}
