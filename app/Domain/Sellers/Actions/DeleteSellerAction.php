<?php

namespace App\Domain\Sellers\Actions;

use App\Domain\Sellers\Models\Seller;

class DeleteSellerAction
{
    public function execute(int $id): void
    {
        Seller::where('id',$id)->delete();
    }
}
