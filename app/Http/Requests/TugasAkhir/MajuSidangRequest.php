<?php

namespace App\Http\Requests\TugasAkhir;

use Illuminate\Foundation\Http\FormRequest;

class MajuSidangRequest extends FormRequest
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
            'mahasiswa_id' => 'required',
            'geologi' => 'required',
            'geofisika_terapan' => 'required',
            'petrofisika' => 'required',
            'geofisika_dasar' => 'required',
            'geofisika_komputasi' => 'required',
        ];
    }
}
