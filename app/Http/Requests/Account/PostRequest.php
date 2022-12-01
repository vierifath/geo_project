<?php

namespace App\Http\Requests\Account;

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
        if ($request->role == 3) {
            return [
                'nip' => 'required|unique:users,nip',
                'nama' => 'required',
                'role' => 'required',
                'email' => 'required',
                'institusi' => 'required'
            ];
        } else if ($request->role == 2) {
            return [
                'nip' => 'required|unique:users,nip',
                'nama' => 'required',
                'role' => 'required',
                'email' => 'required'
            ];
        } else {
            return [
                'nip' => 'required|unique:users,nip',
                'nama' => 'required',
                'role' => 'required',
                'rmk' => 'required',
                'email' => 'required'
            ];
        }
    }
}
