<?php

namespace App\Http\Controllers;

use App\Http\Requests\Proposal\PostRequest;
use App\Http\Requests\Proposal\PostRevisiRequest;
use App\Models\Config;
use App\Models\Proposal;
use App\Models\Rmk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
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
        if ($data['proposal'] != null) {
            if ($data['proposal']->status == 7) {
                $data['status'] = 6;
            } elseif ($data['proposal']->status == 1 || $data['proposal']->status == 5) {
                $data['status'] = 5;
            }
        }
        
        $data['rmks'] = Rmk::all();
        $data['dosens'] = User::where('role', 1)->where('institusi', null)->get();
        $data['dosen_luars'] = User::where('role', 1)->where('institusi', '<>', null)->get();

        return view('proposal.index', $data);
    }

    public function postProposal(PostRequest $request)
    {
        if (isset($request->upload)) {
            $file = str_replace("public", "storage", $request->upload->storeAs('public/file', Auth::user()->nip . "-" . Auth::user()->nama . "-Proposal TA.pdf"));
        }

        $data = [
            'mahasiswa_id'          => Auth::user()->id,
            'dosen_pembimbing_1_id' => $request->dosen_pembimbing_1,
            'dosen_pembimbing_2_id' => $request->dosen_pembimbing_2,
            'dosen_pembimbing_luar' => $request->dosen_pembimbing_luar,
            'rmk_id'                => $request->rmk,
            'status'                => 0,
            'judul'                 => $request->judul,
            'bidang_ilmu'           => $request->bidang_ilmu,
            'metodologi'            => $request->metodologi,
            'abstrak'               => $request->abstrak,
            'file'                  => $file,
            'created_at'            => date("Y-m-d"),
        ];

        Proposal::create($data);

        return redirect('proposal')->with('success', 'Berhasil mengunggah proposal');
    }

    public function updateProposal(PostRequest $request)
    {
        if (isset($request->upload)) {
            $file = str_replace("public", "storage", $request->upload->storeAs('public/file', Auth::user()->nip . "-" . Auth::user()->nama . "-Proposal TA.pdf"));
        }

        $data = [
            'dosen_pembimbing_1_id' => $request->dosen_pembimbing_1,
            'dosen_pembimbing_2_id' => $request->dosen_pembimbing_2,
            'dosen_pembimbing_luar' => $request->dosen_pembimbing_luar,
            'rmk_id'                => $request->rmk,
            'judul'                 => $request->judul,
            'bidang_ilmu'           => $request->bidang_ilmu,
            'metodologi'            => $request->metodologi,
            'abstrak'               => $request->abstrak,
            'file'                  => $file,
        ];

        Proposal::where('id', $request->id)->update($data);

        return redirect('proposal')->with('success', 'Berhasil mengubah proposal');
    }

    public function mahasiswa()
    {
        $data['mahasiswas'] = Proposal::with('mahasiswa')->select('mahasiswa_id', 'created_at', 'status', 'file_ta')->where('dosen_pembimbing_1_id', Auth::user()->id)->orWhere('dosen_pembimbing_2_id', Auth::user()->id)->orWhere('dosen_pembimbing_luar', Auth::user()->id)->get();
        $data['mahasiswas_uji'] = Proposal::with('mahasiswa')->select('mahasiswa_id', 'created_at', 'status', 'file_ta')->where('dosen_penguji_1_id', Auth::user()->id)->orWhere('dosen_penguji_2_id', Auth::user()->id)->get();
        
        return view('proposal.mahasiswa_all', $data);
    }

    public function proposalMahasiswa($mahasiswa_id)
    {
        $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'rmk'])->where('mahasiswa_id', $mahasiswa_id)->first();

        return view('proposal.mahasiswa', $data);
    }

    public function setujuProposal(Request $request)
    {
        $data = [
            'status' => 3,
        ];

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);

        return redirect('mahasiswa/proposal/' . $request->mahasiswa_id)->with('success', 'Berhasil menyetujui proposal');
    }
    
    public function tolakProposal(Request $request)
    {
        $data = [
            'status' => 1,
        ];

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);

        return redirect('mahasiswa/proposal/' . $request->mahasiswa_id)->with('success', 'Berhasil menolak proposal');
    }
    
    public function revisiProposal(PostRevisiRequest $request)
    {
        $proposal = Proposal::where('mahasiswa_id', $request->mahasiswa_id)->first();
        
        if ($proposal->dosen_pembimbing_1_id == Auth::user()->id) {
            $file = str_replace("public", "storage", $request->upload->storeAs('public/file', $proposal->id . " - Pembimbing 1 - Proposal Revisi TA.pdf"));
            $data = [
                'revisi_proposal_dosen_pembimbing_1' => $file,
            ];
        } else if ($proposal->dosen_pembimbing_2_id == Auth::user()->id) {
            $file = str_replace("public", "storage", $request->upload->storeAs('public/file', $proposal->id . " - Pembimbing 2 - Proposal Revisi TA.pdf"));
            $data = [
                'revisi_proposal_dosen_pembimbing_2' => $file,
            ];
        } else if ($proposal->dosen_pembimbing_luar == Auth::user()->id) {
            $file = str_replace("public", "storage", $request->upload->storeAs('public/file', $proposal->id . " - Pembimbing Luar - Proposal Revisi TA.pdf"));
            $data = [
                'revisi_proposal_dosen_luar' => $file,
            ];
        } else if ($proposal->dosen_penguji_1_id == Auth::user()->id) {
            $file = str_replace("public", "storage", $request->upload->storeAs('public/file', $proposal->id . " - Penguji 1 - Proposal Revisi TA.pdf"));
            $data = [
                'revisi_proposal_dosen_penguji_1' => $file,
            ];
        } else if ($proposal->dosen_penguji_2_id == Auth::user()->id) {
            $file = str_replace("public", "storage", $request->upload->storeAs('public/file', $proposal->id . " - Penguji 2 - Proposal Revisi TA.pdf"));
            $data = [
                'revisi_proposal_dosen_penguji_2' => $file,
            ];
        }

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);

        $user = User::where('id', $request->mahasiswa_id)->first()->email;

        $details = [
            'title'     => 'Notifikasi Revisi Proposal',
            'body'     => 'Segera lihat website geofonta.ac.id untuk melihat file revisi anda',
        ];

        \Mail::to($user)->send(new \App\Mail\SendNotifikasi($details));

        return redirect('mahasiswa/proposal/' . $request->mahasiswa_id)->with('success', 'Berhasil mengubah status proposal');
    }
}
