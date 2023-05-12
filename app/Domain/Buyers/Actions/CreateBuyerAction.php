<?php

namespace App\Domain\Buyers\Actions;

use App\Domain\Buyers\Models\Buyer;

class CreateBuyerAction
{
    public function execute(array $fields): Buyer
    {
        $buyer = new Buyer();
        $buyer->fill($fields);
        $buyer->save();
        return $buyer;
    }
}
