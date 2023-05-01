<?php

namespace App\Domain\Sellers\Actions;

use App\Domain\Sellers\Models\Seller;

class CreateSellerAction
{
    public function execute(array $fields): Seller
    {
        $seller = new Seller();
        $seller->fill($fields);
        $seller->save();
        return $seller;
    }
}
