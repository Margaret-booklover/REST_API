<?php

namespace App\Http\ApiV1\Modules\Protocols\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class AddProtocolRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'buyer_id' => ['required', 'integer'],
            'seller_id' => ['required', 'integer'],
            'book_id' => ['required', 'integer'],
        ];
    }
}
