<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $data['beritas'] = Berita::all();

        return view('news.index', $data);
    }

    public function add()
    {
        return view('news.add');
    }

    public function post(Request $postRequest)
    {
        $file = null;

        if (isset($postRequest->upload)) {
            $file = str_replace("public", "storage", $postRequest->upload->storeAs('public/berita', "berkas-" . Str::random(30) . $postRequest->upload->getClientOriginalExtension() ));
        }

        $data = [
            'judul' => $postRequest->judul,
            'deskripsi' => $postRequest->deskripsi,
            'berkas' => $file,
        ];

        Berita::create($data);

        return redirect('/news')->with('success', 'Success to Add News');
    }

    public function edit($id)
    {
        $data['berita'] = Berita::where('id', $id)->first();

        return view('news.edit', $data);
    }

    public function update(UpdateRequest $updateRequest)
    {
        $file = Berita::where('id', $updateRequest->upload)->image;

        if (isset($updateRequest->upload)) {
            $file = str_replace("public", "storage", $updateRequest->upload->storeAs('public/berita', "berkas-" . Str::random(30) . $updateRequest->upload->getClientOriginalExtension() ));
        }

        $data = [
            'judul' => $updateRequest->judul,
            'deskripsi' => $updateRequest->deskripsi,
            'berkas' => $file,
        ];

        Berita::where('id', $updateRequest->id)->update($data);
        
        return redirect('/news')->with('success', 'Success to Edit Data');
    }

    public function delete(Request $request)
    {
        Berita::where('id', $request->id)->delete();

        return redirect('/news')->with('success', 'Success to Delete Data');
    }
}
