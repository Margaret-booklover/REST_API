<?php

namespace App\Domain\Buyers\Actions;

use App\Domain\Buyers\Models\Buyer;

class PatchBuyerAction
{
    public function execute(int $id, array $fields): Buyer
    {
        /** @var Buyer $buyer */
        $buyer = Buyer::query()->findOrFail($id);
        $buyer->update($fields);
        $buyer->save();
        return $buyer;
    }
}
