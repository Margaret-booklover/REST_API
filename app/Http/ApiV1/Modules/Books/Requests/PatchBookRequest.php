<?php

namespace App\Http\ApiV1\Modules\Books\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class PatchBookRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string'],
            'author' => ['nullable', 'string'],
            'count' => ['nullable','integer','min:1'],
            'price' => ['nullable','integer','min:100'],
        ];
    }
}
