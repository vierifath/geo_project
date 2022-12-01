<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Berita;
use App\Models\Config;
use App\Models\Proposal;
use App\Models\Rmk;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
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
        $data['beritas'] = Berita::all();

        return view('layouts.dashboard', $data);
    }

    public function login(Request $request)
    {
        $user = User::where('nip', $request->nip)->first();
        if ($user && Hash::check($request->input('password'), $user->password)) {
            Auth::loginUsingId($user->id, TRUE);
            return redirect('/home');
        } else {
            return redirect('/')->withErrors('Username atau Password salah!');
        }
    }

    public function home()
    {
        try {
            switch (Auth::user()->role) {
                case 0:
                    $bulan   = date('m');
                    $tahun   = date('Y');

                    if ($bulan > 6) {
                        $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'dosen_penguji_3', 'dosen_penguji_4', 'rmk'])->whereMonth("created_at",">", 6)->whereYear('created_at', $tahun)->get();
                        $data['tahun_ajaran'] = 'gasal';
                        $data['tahun_ini'] = $tahun;
                        $data['tahun'] = $tahun;
                    } else {
                        $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'dosen_penguji_3', 'dosen_penguji_4', 'rmk'])->whereMonth("created_at","<", 7)->whereYear('created_at', $tahun + 1)->get();
                        $data['tahun_ajaran'] = 'genap';
                        $data['tahun_ini'] = $tahun;
                        $data['tahun'] = $tahun;
                    }

                    $data['dosens'] = User::where('role', 1)->get();
                    $data['rmks'] = Rmk::all();

                    return view('layouts.dashboard_auth_admin', $data);
                    break;
                case 1:
                    $data['proposal_total']     = Proposal::where('dosen_pembimbing_1_id', Auth::user()->id)->orWhere('dosen_pembimbing_2_id', Auth::user()->id)->count();
                    $data['proposal_direvisi']  = Proposal::where('status', 2)->where('dosen_pembimbing_1_id', Auth::user()->id)->orWhere('dosen_pembimbing_2_id', Auth::user()->id)->count();
                    $data['proposal_ditolak']   = Proposal::where('status', 1)->where('dosen_pembimbing_1_id', Auth::user()->id)->orWhere('dosen_pembimbing_2_id', Auth::user()->id)->count();
                    $data['proposal_disetujui'] = Proposal::where('status', '>=', 3)->where('dosen_pembimbing_1_id', Auth::user()->id)->orWhere('dosen_pembimbing_2_id', Auth::user()->id)->count();
                    $data['proposal_ulasan']    = Proposal::where('status', 0)->where('dosen_pembimbing_1_id', Auth::user()->id)->orWhere('dosen_pembimbing_2_id', Auth::user()->id)->count();
                    
                    return view('layouts.dashboard_auth_dosen', $data);
                    break;
                case 2:
                    $data = $this->getStatus();
                    $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'dosen_penguji_3', 'dosen_penguji_4', 'rmk'])->where('mahasiswa_id', Auth::user()->id)->first();
                    if ($data['proposal'] != null) {
                        if ($data['proposal']->status == 7) {
                            $data['status'] = 6;
                        } elseif ($data['proposal']->status == 1 || $data['proposal']->status == 5) {
                            $data['status'] = 5;
                        }
                    }
                    return view('layouts.dashboard_auth_mahasiswa', $data);
                    break;
                default:
                    Auth::logout();
                    return redirect('/')->with('error', 'user tidak dikenali');
            }
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function postHome(Request $request)
    {
        if ($request->bulan == 'gasal') {
            $bulan   = 11;
        } else {
            $bulan  = 1;
        }
        $tahun   = $request->tahun;

        if ($bulan > 6) {
            if ($request->dosen_pembimbing == null && $request->rmk == null) {
                $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'dosen_penguji_3', 'dosen_penguji_4', 'rmk'])->whereMonth("created_at",">", 6)->whereYear('created_at', $tahun)->get();
            } elseif ($request->dosen_pembimbing != null && $request->rmk == null) {
                $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'dosen_penguji_3', 'dosen_penguji_4', 'rmk'])->whereMonth("created_at",">", 6)->whereYear('created_at', $tahun)->where('dosen_pembimbing_1_id', $request->dosen_pembimbing)->where('dosen_pembimbing_2_id', $request->dosen_pembimbing)->where('dosen_pembimbing_luar', $request->dosen_pembimbing)->get();
            } elseif ($request->dosen_pembimbing == null && $request->rmk != null) {
                $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'dosen_penguji_3', 'dosen_penguji_4', 'rmk'])->whereMonth("created_at",">", 6)->whereYear('created_at', $tahun)->where('rmk_id', $request->rmk)->get();
            } else {
                $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'dosen_penguji_3', 'dosen_penguji_4', 'rmk'])->whereMonth("created_at",">", 6)->whereYear('created_at', $tahun)->where('rmk_id', $request->rmk)->where('dosen_pembimbing_1_id', $request->dosen_pembimbing)->where('dosen_pembimbing_2_id', $request->dosen_pembimbing)->where('dosen_pembimbing_luar', $request->dosen_pembimbing)->get();
            }
            $data['tahun_ajaran'] = 'gasal';
            $data['tahun_ini'] = date('Y');
            $data['tahun'] = $tahun;
        } else {
            if ($request->dosen_pembimbing == null && $request->rmk == null) {
                $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'dosen_penguji_3', 'dosen_penguji_4', 'rmk'])->whereMonth("created_at","<", 7)->whereYear('created_at', $tahun + 1)->get();
            } elseif ($request->dosen_pembimbing != null && $request->rmk == null) {
                $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'dosen_penguji_3', 'dosen_penguji_4', 'rmk'])->whereMonth("created_at","<", 7)->whereYear('created_at', $tahun + 1)->where('dosen_pembimbing_1_id', $request->dosen_pembimbing)->where('dosen_pembimbing_2_id', $request->dosen_pembimbing)->where('dosen_pembimbing_luar', $request->dosen_pembimbing)->get();
            } elseif ($request->dosen_pembimbing == null && $request->rmk != null) {
                $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'dosen_penguji_3', 'dosen_penguji_4', 'rmk'])->whereMonth("created_at","<", 7)->whereYear('created_at', $tahun + 1)->where('rmk_id', $request->rmk)->get();
            } else {
                $data['proposal'] = Proposal::with(['mahasiswa', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_pembimbing_luar_id', 'dosen_penguji_1', 'dosen_penguji_2', 'dosen_penguji_3', 'dosen_penguji_4', 'rmk'])->whereMonth("created_at","<", 7)->whereYear('created_at', $tahun + 1)->where('rmk_id', $request->rmk)->where('dosen_pembimbing_1_id', $request->dosen_pembimbing)->where('dosen_pembimbing_2_id', $request->dosen_pembimbing)->where('dosen_pembimbing_luar', $request->dosen_pembimbing)->get();
            }
            $data['tahun_ajaran'] = 'genap';
            $data['tahun_ini'] = date('Y');
            $data['tahun'] = $tahun;
        }

        $data['dosens'] = User::where('role', 1)->get();
        $data['rmks'] = Rmk::all();

        return view('layouts.dashboard_auth_admin', $data);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Logout berhasil');
    }

    public function profile()
    {
        $data['user'] = User::with(['RMK'])->where('id', Auth::user()->id)->first();

        return view('account.profile', $data);
    }

    public function updatePassword(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if (Hash::check($request->password_lama, $user->password)) {
            $password = [
                'password' => Hash::make($request->password_baru)
            ];

            User::where('id', $request->id)->update($password);

            return redirect('profile')->with('success', 'Berhasil mengubah password');
        } else {
            return redirect('profile')->withErrors('Password lama salah!');
        }
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user->role == 1) {
            $role = 'dosen';
        } else {
            $role = 'mahasiswa';
        }

        $password = [
            'password' => Hash::make($user->nip)
        ];

        User::where('id', $request->id)->update($password);

        return redirect('account/' . $role)->with('success', 'Berhasil reset password');
    }
}
