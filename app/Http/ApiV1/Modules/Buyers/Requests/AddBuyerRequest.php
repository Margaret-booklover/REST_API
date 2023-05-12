<?php

namespace App\Http\ApiV1\Modules\Buyers\Requests;


use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class AddBuyerRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'status' => ['required', 'string'],
            'fio' => ['required', 'string'],
        ];
    }
}
