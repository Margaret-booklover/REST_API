<?php

namespace App\Http\ApiV1\Modules\Books\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class AddBookRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'price' => ['required','integer','min:100'],
            'count' => ['required','integer','min:1'],
            'title' => ['required','string'],
            'author' => ['required','string'],
        ];
    }
}
