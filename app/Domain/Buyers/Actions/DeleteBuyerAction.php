<?php

namespace App\Domain\Buyers\Actions;

use App\Domain\Buyers\Models\Buyer;

class DeleteBuyerAction
{
    public function execute(int $id): void
    {
        Buyer::where('id',$id)->delete();
    }
}
