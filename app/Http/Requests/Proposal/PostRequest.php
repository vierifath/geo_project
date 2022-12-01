<?php

namespace App\Http\Requests\Proposal;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
            return [
                'id' => '',
                'judul' => 'required',
                'bidang_ilmu' => 'required',
                'metodologi' => 'required',
                'abstrak' => 'required',
                'upload' => 'required|max:4096|min:1024',
                'rmk' => 'required',
                'dosen_pembimbing_1' => 'required|different:dosen_pembimbing_2',
                'dosen_pembimbing_2' => 'different:dosen_pembimbing_1',
                'dosen_pembimbing_luar' => '',
            ];
    }
}
