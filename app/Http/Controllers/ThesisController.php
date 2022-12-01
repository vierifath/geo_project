<?php

namespace App\Http\Controllers;

use App\Http\Requests\Proposal\PostRequest;
use App\Http\Requests\TugasAkhir\MajuSidangRequest;
use App\Models\Config;
use App\Models\Nilai;
use App\Models\Proposal;
use App\Models\Rmk;
use App\Models\Soal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThesisController extends Controller
{
    private function getStatus()
    {
        $statusArray = ['waktu_upload_proposal', 'waktu_revisi_proposal', 'waktu_upload_akhir', 'waktu_revisi_akhir'];
        $i = 0;
        while ($i != 4) {
            $date = Config::where('nama', $statusArray[$i])->first()->value;
            if ($date == null) {
                $data['status'] = -1;
                $data['date'] = 'Admin Havent Set Schedule';
                return $data;
            }
            $array = explode(' - ', $date);
    
            $today = date('Y-m-d');
            $today=date('Y-m-d', strtotime($today));
            $begin = date('Y-m-d', strtotime($array[0]));
            $end = date('Y-m-d', strtotime($array[1]));
    
            if (($today >= $begin) && ($today <= $end)){
                $data['status'] = $i + 1;
                $data['date'] = $date;
                return $data;
            } else{
                $i++;
            }
        }

        $data['status'] = 0;
        $data['date'] = '-';
        return $data;
    }

    public function index()
    {
        $data = $this->getStatus();
        $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'rmk'])->where('mahasiswa_id', Auth::user()->id)->first();
        if (Auth::user()->role == 1) {
            $data['nilai'] = Nilai::with(['soal_geologi', 'soal_petrofisika', 'soal_geofisika_dasar', 'soal_geofisika_terapan', 'soal_geofisika_komputasi'])->where('mahasiswa_id', $data['proposal']['mahasiswa_id'])->first();
        }
        
        if ($data['proposal'] != null) {
            if ($data['proposal']->status == 7) {
                $data['status'] = 6;
            } elseif ($data['proposal']->status == 1 || $data['proposal']->status == 5) {
                $data['status'] = 5;
            }
        }

        $data['rmks'] = Rmk::all();
        $data['dosens'] = User::where('role', 1)->get();
        
        return view('thesis.index', $data);
    }

    public function postTA(Request $request)
    {
        $status = Proposal::where('id', $request->id)->first()->status;

        if ($status == 2 || $status == 3) {
            if (isset($request->upload)) {
                $file = str_replace("public", "storage", $request->upload->storeAs('public/file', Auth::user()->nip . "-" . Auth::user()->nama . "-Buku TA.pdf"));
                $data = [
                    'file_ta'               => $file,
                ];
            } else {
                return redirect('tugas-akhir')->withErrors('Mohon Unggah File!');
            }
        } elseif ($status == 6) {
            if (isset($request->upload) && isset($request->jurnal) && isset($request->pomits)) {
                $file = str_replace("public", "storage", $request->upload->storeAs('public/file', Auth::user()->nip . "-" . Auth::user()->nama . "-Buku TA.pdf"));
                $jurnal = str_replace("public", "storage", $request->upload->storeAs('public/file', Auth::user()->nip . "-" . Auth::user()->nama . "-Jurnal.pdf"));
                $pomits = str_replace("public", "storage", $request->upload->storeAs('public/file', Auth::user()->nip . "-" . Auth::user()->nama . "-Pomits.pdf"));
                $data = [
                    'file_ta'               => $file,
                    'pomits'                => $pomits,
                    'jurnal'                => $jurnal,
                    'status_revisi_ta'      => 1,
                ];
            } else {
                return redirect('tugas-akhir')->withErrors('Mohon Unggah File!');
            }
        } elseif ($status == 7) {
            if (isset($request->jurnal) && isset($request->pomits)) {
                $jurnal = str_replace("public", "storage", $request->upload->storeAs('public/file', Auth::user()->nip . "-" . Auth::user()->nama . "-Jurnal.pdf"));
                $pomits = str_replace("public", "storage", $request->upload->storeAs('public/file', Auth::user()->nip . "-" . Auth::user()->nama . "-Pomits.pdf"));
                $data = [
                    'pomits'                => $pomits,
                    'jurnal'                => $jurnal,
                ];
            } else {
                return redirect('tugas-akhir')->withErrors('Mohon Unggah File!');
            }
        }

        Proposal::where('id', $request->id)->update($data);

        return redirect('tugas-akhir')->with('success', 'Berhasil mengunggah tugas akhir');
    }

    public function mahasiswa()
    {
        $data['mahasiswas'] = Proposal::with('mahasiswa')->select('mahasiswa_id', 'created_at', 'status')->where('dosen_pembimbing_1_id', Auth::user()->id)->get();
        
        return view('proposal.mahasiswa_all', $data);
    }

    public function TAMahasiswa($mahasiswa_id)
    {
        $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'rmk'])->where('mahasiswa_id', $mahasiswa_id)->first();
        $data['nilai'] = Nilai::with(['soal_geologi', 'soal_petrofisika', 'soal_geofisika_dasar', 'soal_geofisika_terapan', 'soal_geofisika_komputasi'])->where('mahasiswa_id', $data['proposal']['mahasiswa_id'])->first();

        if (proposal::where('dosen_pembimbing_1_id', Auth::user()->id)->first() != null){
            $data['status'] = 'revisi_dosen_pembimbing_1';
            $data['status_nilai'] = '1';
        } else if (proposal::where('dosen_pembimbing_2_id', Auth::user()->id)->first() != null){
            $data['status'] = 'revisi_dosen_pembimbing_2';
            $data['status_nilai'] = '2';
        } else if (proposal::where('dosen_penguji_3_id', Auth::user()->id)->first() != null){
            $data['status'] = 'revisi_dosen_penguji_1';
            $data['status_nilai'] = '3';
        } else if (proposal::where('dosen_penguji_4_id', Auth::user()->id)->first() != null){
            $data['status'] = 'revisi_dosen_penguji_2';
            $data['status_nilai'] = '4';
        } else if (proposal::where('dosen_pembimbing_luar', Auth::user()->id)->first() != null){
            $data['status'] = 'revisi_dosen_luar';
            $data['status_nilai'] = 'luar';
        }

        if ($data['proposal']['status'] == 3) {
            $data['geologis'] = Soal::where('jenis', 'geologi')->get();
            $data['geofisika_dasars'] = Soal::where('jenis', 'geofisika_dasar')->get();
            $data['petrofisikas'] = Soal::where('jenis', 'petrofisika')->get();
            $data['geofisika_terapans'] = Soal::where('jenis', 'geofisika_terapan')->get();
            $data['geofisika_komputasis'] = Soal::where('jenis', 'geofisika_komputasi')->get();
        }

        return view('thesis.mahasiswa', $data);
    }

    public function setujuTA(Request $request)
    {
        $data = [
            'status' => 7,
        ];

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);

        return redirect('sidang/tugas-akhir')->with('success', 'Berhasil menyetujui Tugas Akhir');
    }
    
    public function tolakTA(Request $request)
    {
        $data = [
            'status' => 5,
        ];

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);

        return redirect('sidang/tugas-akhir')->with('success', 'Berhasil menolak Tugas Akhir');
    }
    
    public function revisiTA(Request $request)
    {
        $data = [
            'status' => 6,
        ];

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);

        return redirect('sidang/tugas-akhir')->with('success', 'Berhasil mengubah status Tugas Akhir');
    }

    public function revisi(Request $request)
    {
        $mahasiswa = User::where('id', $request->mahasiswa_id)->first();

        if (isset($request->upload)) {
            $file = str_replace("public", "storage", $request->upload->storeAs('public/file', $mahasiswa->nip . "-" . $mahasiswa->nama . "-Revisi Buku TA-" . Auth::user()->nama . ".pdf"));
        } else {
            return redirect('tugas-akhir')->withErrors('Mohon Unggah File!');
        }

        $data = [
            $request->status => $file,
        ];

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);

        $details = [
            'title'     => 'Notifikasi Revisi Tugas Akhir',
            'body'     => 'Segera lihat website geofonta.ac.id untuk melihat file revisi anda',
        ];

        \Mail::to($mahasiswa->email)->send(new \App\Mail\SendNotifikasi($details));

        return redirect('mahasiswa/tugas-akhir/' . $request->mahasiswa_id)->with('success', 'Berhasil mengunggah revisi Tugas Akhir');
    }
    
    public function revisiOk(Request $request)
    {
        $data = [
            $request->status => "OK",
        ];

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);
        
        $proposal = Proposal::where('mahasiswa_id', $request->mahasiswa_id)->first();
        if ($proposal->revisi_dosen_pembimbing_1 == "OK" && $proposal->revisi_dosen_pembimbing_2 == "OK" && $proposal->revisi_dosen_penguji_1 == "OK" && $proposal->revisi_dosen_penguji_2 == "OK") {
            Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update(['status' => 7]);
        }
        return redirect('mahasiswa/tugas-akhir/' . $request->mahasiswa_id)->with('success', 'Berhasil menyetujui revisi Tugas Akhir');
    }
    
    public function jurnalOk(Request $request)
    {
        $data = [
            'status_jurnal' => 1,
        ];

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);
        
        return redirect('mahasiswa/tugas-akhir/' . $request->mahasiswa_id)->with('success', 'Berhasil menyetujui Jurnal');
    }
    
    public function pomitsOk(Request $request)
    {
        $data = [
            'status_pomits' => 1,
        ];

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);
        
        return redirect('mahasiswa/tugas-akhir/' . $request->mahasiswa_id)->with('success', 'Berhasil menyetujui Jurnal');
    }
    
    public function majuSidang(MajuSidangRequest $request)
    {
        $data = [
            'status' => 4,
        ];

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);
        
        $data = [
            'mahasiswa_id' => $request->mahasiswa_id,
            'geologi' => $request->geologi,
            'geofisika_terapan' => $request->geofisika_terapan,
            'petrofisika' => $request->petrofisika,
            'geofisika_dasar' => $request->geofisika_dasar,
            'geofisika_komputasi' => $request->geofisika_komputasi,
        ];

        Nilai::create($data);

        return redirect('mahasiswa/tugas-akhir/' . $request->mahasiswa_id)->with('success', 'Berhasil mengubah status tugas akhir');
    }
}
