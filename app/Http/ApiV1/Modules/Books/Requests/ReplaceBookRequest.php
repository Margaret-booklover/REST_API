<?php

namespace App\Http\ApiV1\Modules\Books\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class ReplaceBookRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'author' => ['nullable', 'string'],
            'count' => ['nullable','integer','min:1'],
            'price' => ['nullable','integer','min:100'],
        ];
    }
}
