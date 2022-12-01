<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class LectureSubjectController extends Controller
{
    public function index()
    {
        $data['mata_kuliahs'] = MataKuliah::all();

        return view('lecture_subject.index', $data);
    }
    
    public function add(Request $request)
    {
        $data = [
            'nama' => $request->nama,
        ];

        MataKuliah::create($data);

        return redirect('/admin-lecture-subject')->with('success', 'Course was successfully added');
    }
    
    public function update(Request $request)
    {
        $data = [
            'nama' => $request->nama,
        ];

        MataKuliah::where('id', $request->id)->update($data);

        return redirect('/admin-lecture-subject')->with('success', 'Course was successfully edited');
    }
    
    public function delete(Request $request)
    {
        MataKuliah::where('id', $request->id)->delete();

        return redirect('/admin-lecture-subject')->with('success', 'Course was successfully deleted');
    }
}
