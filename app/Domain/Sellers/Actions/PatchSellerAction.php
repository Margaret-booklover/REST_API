<?php

namespace App\Domain\Sellers\Actions;

use App\Domain\Sellers\Models\Seller;

class PatchSellerAction
{
    public function execute(int $id, array $fields): Seller
    {
        /** @var Seller $seller */
        $seller = Seller::query()->findOrFail($id);
        $seller->update($fields);
        $seller->save();
        return $seller;
    }
}
