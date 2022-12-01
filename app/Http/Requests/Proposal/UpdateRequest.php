<?php

namespace App\Http\Requests\Proposal;

use Illuminate\Foundation\Http\FormRequest;

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
            'mahasiswa_id' => 'required',
            'judul' => 'required',
            'bidang_ilmu' => 'required',
            'metodologi' => 'required',
            'abstrak' => 'required',
            'rmk' => 'required',
            'dosen_pembimbing_1' => 'required|different:dosen_pembimbing_2',
            'dosen_pembimbing_2' => 'different:dosen_pembimbing_1',
            'dosen_pembimbing_luar' => '',
            'dosen_penguji_1' => 'required|different:dosen_penguji_2',
            'dosen_penguji_2' => 'required|different:dosen_penguji_1',
            'tanggal_sidang_proposal' => 'required',
            'lokasi_sidang_proposal' => 'required',
        ];
    }
}
