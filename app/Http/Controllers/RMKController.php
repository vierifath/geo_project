<?php

namespace App\Http\Controllers;

use App\Http\Requests\RMK\PostRequest;
use App\Http\Requests\RMK\UpdateRequest;
use App\Models\Rmk;
use Illuminate\Http\Request;

class RMKController extends Controller
{
    public function index()
    {
        $data['rmks'] = Rmk::all();

        return view('rmk.index', $data);
    }

    public function add()
    {
        return view('rmk.add');
    }

    public function post(PostRequest $postRequest)
    {
        $data = [
            'nama' => $postRequest->nama
        ];

        Rmk::create($data);

        return redirect('/rmk')->with('success', 'Berhasil menambah data RMK');
    }

    public function edit($id)
    {
        $data['rmk'] = Rmk::where('id', $id)->first();

        return view('rmk.edit', $data);
    }

    public function update(UpdateRequest $updateRequest)
    {
        $data = [
            'nama' => $updateRequest->nama
        ];

        Rmk::where('id', $updateRequest->id)->update($data);
        
        return redirect('/rmk')->with('success', 'Berhasil Mengubah data RMK');
    }

    public function delete(Request $request)
    {
        Rmk::where('id', $request->id)->delete();

        return redirect('/rmk')->with('success', 'Berhasil menghapus data RMK');
    }
}
