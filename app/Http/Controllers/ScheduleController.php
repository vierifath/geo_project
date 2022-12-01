<?php

namespace App\Http\Controllers;

use App\Http\Requests\Proposal\UpdateRequest;
use App\Http\Requests\TugasAkhir\UpdateRequest as TugasAkhirUpdateRequest;
use App\Models\Proposal;
use App\Models\Rmk;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function proposalAll()
    {
        $data['mahasiswas'] = Proposal::with('mahasiswa')->select('mahasiswa_id', 'created_at', 'status', 'tanggal_sidang_proposal')->where('status', 0)->get();

        return view('schedule.proposal', $data);
    }

    public function proposal($mahasiswa_id)
    {
        $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_penguji_1', 'dosen_penguji_2', 'rmk'])->where('mahasiswa_id', $mahasiswa_id)->first();
        $data['rmks'] = Rmk::all();
        $data['dosens'] = User::where('role', 1)->where('institusi', null)->get();
        
        return view('schedule.proposal_mahasiswa', $data);
    }

    public function proposalUpdate(UpdateRequest $request)
    {
        $data = [
            'dosen_pembimbing_1_id' => $request->dosen_pembimbing_1,
            'dosen_pembimbing_2_id' => $request->dosen_pembimbing_2,
            'dosen_pembimbing_luar' => $request->dosen_pembimbing_luar,
            'rmk_id'                => $request->rmk,
            'judul'                 => $request->judul,
            'bidang_ilmu'           => $request->bidang_ilmu,
            'metodologi'            => $request->metodologi,
            'dosen_penguji_1_id'    => $request->dosen_penguji_1,
            'dosen_penguji_2_id'    => $request->dosen_penguji_2,
            'lokasi_sidang_proposal'=> $request->lokasi_sidang_proposal,
            'tanggal_sidang_proposal'=> $request->tanggal_sidang_proposal,
        ];

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);

        $proposal = Proposal::where('mahasiswa_id', $request->mahasiswa_id)->first();

        $mahasiswa = User::where('id', $request->mahasiswa_id)->first();

        $details = [
            'status'     => 'Seminar',
            'title'     => 'Undangan Ujian Seminar Proposal',
            'nrp'       => $mahasiswa->nip,
            'nama'      => $mahasiswa->nama,
            'judul'     => $request->judul,
            'tanggal'   => $request->tanggal_sidang_proposal,
            'lokasi'    => $request->lokasi_sidang_proposal,
        ];

        \Mail::to($mahasiswa->email)->send(new \App\Mail\SendEmail($details));

        if ($proposal->dosen_pembimbing_1_id != null) {
            $user = User::where('id', $proposal->dosen_pembimbing_1_id)->first()->email;

            \Mail::to($user)->send(new \App\Mail\SendEmail($details));
        }
        
        if ($proposal->dosen_pembimbing_2_id != null) {
            $user = User::where('id', $proposal->dosen_pembimbing_2_id)->first()->email;

            \Mail::to($user)->send(new \App\Mail\SendEmail($details));
        }
        
        if ($proposal->dosen_pembimbing_luar != null) {
            $user = User::where('id', $proposal->dosen_pembimbing_luar)->first()->email;

            \Mail::to($user)->send(new \App\Mail\SendEmail($details));
        }
        
        if ($proposal->dosen_penguji_1_id != null) {
            $user = User::where('id', $proposal->dosen_penguji_1_id)->first()->email;

            \Mail::to($user)->send(new \App\Mail\SendEmail($details));
        }
        
        if ($proposal->dosen_penguji_2_id != null) {
            $user = User::where('id', $proposal->dosen_penguji_2_id)->first()->email;

            \Mail::to($user)->send(new \App\Mail\SendEmail($details));
        }

        return redirect('sidang/proposal/' . $request->mahasiswa_id)->with('success', 'Success to Change Proposal Session Schedule');
    }
    
    public function taAll()
    {
        $data['mahasiswas'] = Proposal::with('mahasiswa')->select('mahasiswa_id', 'created_at', 'status', 'tanggal_sidang_ta')->where('status', 4)->get();

        return view('schedule.ta', $data);
    }

    public function ta($mahasiswa_id)
    {
        $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_penguji_3', 'dosen_penguji_4', 'rmk'])->where('mahasiswa_id', $mahasiswa_id)->first();
        $data['rmks'] = Rmk::all();
        $data['dosens'] = User::where('role', 1)->where('institusi', null)->get();
        
        return view('schedule.ta_mahasiswa', $data);
    }

    public function taUpdate(TugasAkhirUpdateRequest $request)
    {
        $data = [
            'dosen_pembimbing_1_id' => $request->dosen_pembimbing_1,
            'dosen_pembimbing_2_id' => $request->dosen_pembimbing_2,
            'dosen_pembimbing_luar' => $request->dosen_pembimbing_luar,
            'rmk_id'                => $request->rmk,
            'judul'                 => $request->judul,
            'bidang_ilmu'           => $request->bidang_ilmu,
            'metodologi'            => $request->metodologi,
            'abstrak'               => $request->abstrak,
            'dosen_penguji_3_id'    => $request->dosen_penguji_3,
            'dosen_penguji_4_id'    => $request->dosen_penguji_4,
            'lokasi_sidang_ta'      => $request->lokasi_sidang_ta,
            'tanggal_sidang_ta'     => $request->tanggal_sidang_ta,
        ];

        Proposal::where('mahasiswa_id', $request->mahasiswa_id)->update($data);

        $proposal = Proposal::where('mahasiswa_id', $request->mahasiswa_id)->first();
        $mahasiswa = User::where('id', $request->mahasiswa_id)->first();

        $details = [
            'status'     => 'Sidang',
            'title'     => 'Undangan Ujian Sidang Skripsi',
            'nrp'       => $mahasiswa->nip,
            'nama'      => $mahasiswa->nama,
            'judul'     => $request->judul,
            'tanggal'   => $request->tanggal_sidang_ta,
            'lokasi'    => $request->lokasi_sidang_ta,
        ];

        \Mail::to($mahasiswa->email)->send(new \App\Mail\SendEmailSkripsi($details));

        if ($proposal->dosen_pembimbing_1_id != null) {
            $user = User::where('id', $proposal->dosen_pembimbing_1_id)->first()->email;

            \Mail::to($user)->send(new \App\Mail\SendEmail($details));
        }
        
        if ($proposal->dosen_pembimbing_2_id != null) {
            $user = User::where('id', $proposal->dosen_pembimbing_2_id)->first()->email;

            \Mail::to($user)->send(new \App\Mail\SendEmail($details));
        }
        
        if ($proposal->dosen_pembimbing_luar != null) {
            $user = User::where('id', $proposal->dosen_pembimbing_luar)->first()->email;

            \Mail::to($user)->send(new \App\Mail\SendEmail($details));
        }
        
        if ($proposal->dosen_penguji_3_id != null) {
            $user = User::where('id', $proposal->dosen_penguji_3_id)->first()->email;

            \Mail::to($user)->send(new \App\Mail\SendEmail($details));
        }
        
        if ($proposal->dosen_penguji_4_id != null) {
            $user = User::where('id', $proposal->dosen_penguji_4_id)->first()->email;

            \Mail::to($user)->send(new \App\Mail\SendEmail($details));
        }

        return redirect('sidang/tugas-akhir/' . $request->mahasiswa_id)->with('success', 'Success to Change Proposal Session Schedule');
    }
}
