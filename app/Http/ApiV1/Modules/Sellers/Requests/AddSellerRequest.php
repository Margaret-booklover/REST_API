<?php

namespace App\Http\ApiV1\Modules\Sellers\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class AddSellerRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'phone' => ['required', 'string'],
            'fio' => ['required', 'string'],
        ];
    }
}
