<?php

namespace App\Http\ApiV1\Modules\Protocols\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class PatchProtocolRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'date' => ['nullable', 'date'],
            'buyer_id' => ['nullable',  'integer'],
            'seller_id' => ['nullable',  'integer'],
            'book_id' => ['nullable',  'integer'],
        ];
    }
}
