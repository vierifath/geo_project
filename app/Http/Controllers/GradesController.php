<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    public function update(Request $request)
    {
        $data = [
            'geologi_' . $request->status => $request->nilai1,
            'geofisika_dasar_' . $request->status => $request->nilai2,
            'petrofisika_' . $request->status => $request->nilai3,
            'geofisika_terapan_' . $request->status => $request->nilai4,
            'geofisika_komputasi_' . $request->status => $request->nilai5,
            'penguasaan_materi_' . $request->status => $request->nilai6,
            'cara_komunikasi_' . $request->status => $request->nilai7,
            'materi_ppt_' . $request->status => $request->nilai8,
            'laporan_' . $request->status => $request->nilai9,
        ];
        if ($request->status == 1 || $request->status == 2) {
            $data['nilai_pembimbingan_' . $request->status] = $request->nilai10;
        }

        Nilai::where('id', $request->id)->update($data);

        return redirect('/mahasiswa/tugas-akhir/' . $request->mahasiswa_id)->with('success', 'Berhasil menilai sidang mahasiswa');
    }
}
