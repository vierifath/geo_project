<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\PostRequest;
use App\Models\Rmk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class AccountController extends Controller
{
    public function all($role)
    {
        $data['role'] = $role;

        if ($role == 'dosen') {
            $data['users'] = User::with(['RMK'])->where('role', 1)->where('institusi', null)->get();
            return view('account.all', $data);
        } else if ($role == 'mahasiswa') {
            $data['users'] = User::where('role', 2)->get();
            return view('account.all', $data);
        } else if ($role == 'dosen-eksternal') {
            $data['users'] = User::where('role', 1)->where('institusi', '<>', null)->get();
            return view('account.all', $data);
        } else {
            return view('layouts.404');
        }
    }

    public function add($role)
    {
        $data['rmks'] = Rmk::all();
        $data['role'] = $role;

        return view('account.add', $data);
    }
    
    public function edit($id)
    {
        $data['user'] = User::where('id', $id)->first();;

        if ($data['user']['role'] == 1 && $data['user']['institusi'] == null) {
            $data['rmks'] = Rmk::all();
            return view('account.edit', $data);
        } else {
            return redirect('/home');
        }
    }
    
    public function update(Request $request)
    {
        $user = User::where('nip', $request->nip)->first();

        if ($user && $user->id == $request->id) {
            $data = [
                'email' => $request->email,
                'nip' => $request->nip,
                'nama' => $request->nama,
                'rmk_id' => $request->rmk,
            ];
    
            User::where('id', $request->id)->update($data);
    
            return redirect('/account/dosen')->with('success', 'Berhasil mengubah data user ');
        } else {
            return redirect('/account/edit/' . $request->id)->withErrors('NIP sudah dimiliki oleh orang lain!');
        }
    }

    public function postAccount(PostRequest $request)
    {
        if ($request->role == 1) {
            $role = 'dosen';
        } else if ($request->role == 3) {
            $role = 'dosen-eksternal';
            $request->role = 1;
        } else {
            $role = 'mahasiswa';
        }

        $data = [
            'email' => $request->email,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'rmk_id' => $request->rmk,
            'institusi' => $request->institusi,
            'password' => Hash::make($request->nip),
            'role' => $request->role,
        ];

        User::create($data);

        return redirect('/account/' . $role)->with('success', 'Berhasil menambah data user ' . $role);
    }

    public function deleteAccount(Request $request)
    {
        User::where('id', $request->id)->delete();

        return redirect('/account/' . $request->role)->with('success', 'Berhasil menghapus data user ' . $request->role);
    }

    public function addTemplate(){
        Excel::import(new UsersImport,request()->file('upload'));

        return redirect('/account/mahasiswa')->with('success', 'Berhasil menambah data user mahasiswa');
    }
}
