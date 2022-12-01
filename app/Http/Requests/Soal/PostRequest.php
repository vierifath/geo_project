<?php

namespace App\Http\Requests\Soal;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PostRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'jenis' => 'required',
            'mata_kuliah' => 'required',
            'topik' => 'required',
            'jawaban' => 'required',
            'upload' => '',
        ];
    }
}
