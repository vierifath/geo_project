<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    public function index()
    {
        $data['logbooks'] = Logbook::where('mahasiswa_id', Auth::user()->id)->get();

        return view('logbook.index', $data);
    }

    public function postLogbook(Request $request)
    {
        $data = [
            'mahasiswa_id' => Auth::user()->id,
            'created_at' => $request->waktu,
            'topik' => $request->topik,
            'status' => 0,
            'komentar' => '-'
        ];

        Logbook::create($data);

        return redirect('logbook')->with('success', 'Berhasil menambah logbook');
    }

    public function logbookMahasiswa($mahasiswa_id)
    {
        $data['logbooks'] = Logbook::where('mahasiswa_id', $mahasiswa_id)->get();

        return view('logbook.mahasiswa', $data);
    }

    public function setujuLogbook(Request $request)
    {
        $data = [
            'status' => 2,
            'komentar' => $request->komentar,
        ];

        Logbook::where('id', $request->id)->update($data);

        return redirect('mahasiswa/logbook/' . $request->mahasiswa_id)->with('success', 'Berhasil menyetujui logbook');
    }
    
    public function setujuAllLogbook(Request $request)
    {
        $data = [
            'status' => 2,
            'komentar' => '-',
        ];

        Logbook::where('mahasiswa_id', $request->mahasiswa_id)->where('status', 0)->update($data);

        return redirect('mahasiswa/logbook/' . $request->mahasiswa_id)->with('success', 'Berhasil menyetujui logbook');
    }
    
    public function tolakLogbook(Request $request)
    {
        $data = [
            'status' => 1,
            'komentar' => $request->komentar,
        ];

        Logbook::where('id', $request->id)->update($data);

        return redirect('mahasiswa/logbook/' . $request->mahasiswa_id)->with('success', 'Berhasil menolak logbook');
    }
}
