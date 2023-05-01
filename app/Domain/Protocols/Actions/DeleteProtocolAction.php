<?php

namespace App\Domain\Protocols\Actions;

use App\Domain\Protocols\Models\Protocol;

class DeleteProtocolAction
{
    public function execute(int $id): void
    {
        Protocol::where('id',$id)->delete();
    }
}
