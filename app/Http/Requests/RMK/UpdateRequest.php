<?php

namespace App\Http\Requests\RMK;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => [
                "required",
                Rule::unique('rmks', 'nama')
                    ->ignore($this->route('id'), 'id'),
            ],
        ];
    }
}
