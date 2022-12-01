<?php

namespace App\Http\Controllers;

use App\Http\Requests\Soal\PostRequest;
use App\Models\MataKuliah;
use App\Models\Proposal;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function index()
    {
        $data['geologis'] = Soal::with(['MataKuliah'])->where('jenis', 'geologi')->get();
        $data['geofisika_dasars'] = Soal::with(['MataKuliah'])->where('jenis', 'geofisika_dasar')->get();
        $data['petrofisikas'] = Soal::with(['MataKuliah'])->where('jenis', 'petrofisika')->get();
        $data['geofisika_terapans'] = Soal::with(['MataKuliah'])->where('jenis', 'geofisika_terapan')->get();
        $data['geofisika_komputasis'] = Soal::with(['MataKuliah'])->where('jenis', 'geofisika_komputasi')->get();
        $data['mata_kuliahs'] = MataKuliah::all();
        return view('question.index', $data);
    }
    
    public function add(PostRequest $request)
    {
        $image = '';

        if (isset($request->upload)) {
            $image = str_replace("public", "storage", $request->upload->storeAs('public/image', "soal-" . Str::random(30) . "-" . Soal::where('jenis', $request->jenis)->count() + 1 . $request->upload->getClientOriginalExtension() ));
        }

        $data = [
            'jenis' => $request->jenis,
            'soal' => $request->topik,
            'jawaban' => $request->jawaban,
            'mata_kuliah_id' => $request->mata_kuliah,
            'image' => $image,
        ];
        
        Soal::create($data);

        if (Auth::user()->role == 0) {
            return redirect('/admin-question')->with('success', 'Success to Add Question');
        } else {
            return redirect('/question')->with('success', 'Success to Add Question');
        }
    }
    
    public function update(Request $request)
    {
        $image = Soal::where('id', $request->id)->first()->image;

        if (isset($request->upload)) {
            $image = str_replace("public", "storage", $request->upload->storeAs('public/image', "soal-" . Str::random(30) . "-" . Soal::where('jenis', $request->jenis)->count() + 1 . $request->upload->getClientOriginalExtension() ));
        }

        $data = [
            'soal' => $request->topik,
            'jawaban' => $request->jawaban,
            'mata_kuliah_id' => $request->mata_kuliah,
            'image' => $image,
        ];

        Soal::where('id', $request->id)->update($data);

        if (Auth::user()->role == 0) {
            return redirect('/admin-question')->with('success', 'Berhasil mengubah soal');
        } else {
            return redirect('/soal')->with('success', 'Berhasil mengubah soal');
        }
    }
    
    public function delete(Request $request)
    {
        Soal::where('id', $request->id)->delete();

        if (Auth::user()->role == 0) {
            return redirect('/admin-question')->with('success', 'Berhasil menghapus soal');
        } else {
            return redirect('/soal')->with('success', 'Berhasil menghapus soal');
        }
    }

    public function soal(Request $request)
    {
        $data = [
            'status_soal' => $request->status_soal
        ];

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);

        if ($request->status_soal == 1) {
            return redirect('mahasiswa/tugas-akhir/' . $request->mahasiswa_id)->with('success', 'Berhasil memberi akses soal');;
        } else {
            return redirect('mahasiswa/tugas-akhir/' . $request->mahasiswa_id)->with('success', 'Berhasil membatasi akses soal');;
        }
        
    }
}
