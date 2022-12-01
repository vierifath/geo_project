<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $data['config']['waktu_upload_proposal'] = Config::where('nama', 'waktu_upload_proposal')->first()->value;
        $data['config']['waktu_upload_akhir'] = Config::where('nama', 'waktu_upload_akhir')->first()->value;
        $data['config']['waktu_revisi_proposal'] = Config::where('nama', 'waktu_revisi_proposal')->first()->value;
        $data['config']['waktu_revisi_akhir'] = Config::where('nama', 'waktu_revisi_akhir')->first()->value;
        $data['config']['waktu_sidang_proposal'] = Config::where('nama', 'waktu_sidang_proposal')->first()->value;
        $data['config']['waktu_sidang_akhir'] = Config::where('nama', 'waktu_sidang_akhir')->first()->value;

        return view('schedule.index', $data);
    }

    public function update(Request $request)
    {
        $old_month = ['January ', 'February ', 'March ', 'April ', 'May ', 'June ', 'July ', 'August ', 'September ', 'October ', 'November ', 'December '];
        $new_month = ['01/', '02/', '03/', '04/', '05/', '06/', '07/', '08/', '09/', '10/', '11/', '12/'];

        $waktu_upload_proposal = explode(" ", $request->waktu_upload_proposal);
        $request->waktu_upload_proposal = $waktu_upload_proposal[1] . " " . $waktu_upload_proposal[0] . "/" . $waktu_upload_proposal[2] . " " . $waktu_upload_proposal[3] . " " . $waktu_upload_proposal[5] . " " . $waktu_upload_proposal[4] . "/" . $waktu_upload_proposal[6];
        $waktu_upload_akhir = explode(" ", $request->waktu_upload_akhir);
        $request->waktu_upload_akhir = $waktu_upload_akhir[1] . " " . $waktu_upload_akhir[0] . "/" . $waktu_upload_akhir[2] . " " . $waktu_upload_akhir[3] . " " . $waktu_upload_akhir[5] . " " . $waktu_upload_akhir[4] . "/" . $waktu_upload_akhir[6];
        $waktu_revisi_proposal = explode(" ", $request->waktu_revisi_proposal);
        $request->waktu_revisi_proposal = $waktu_revisi_proposal[1] . " " . $waktu_revisi_proposal[0] . "/" . $waktu_revisi_proposal[2] . " " . $waktu_revisi_proposal[3] . " " . $waktu_revisi_proposal[5] . " " . $waktu_revisi_proposal[4] . "/" . $waktu_revisi_proposal[6];
        $waktu_revisi_akhir = explode(" ", $request->waktu_revisi_akhir);
        $request->waktu_revisi_akhir = $waktu_revisi_akhir[1] . " " . $waktu_revisi_akhir[0] . "/" . $waktu_revisi_akhir[2] . " " . $waktu_revisi_akhir[3] . " " . $waktu_revisi_akhir[5] . " " . $waktu_revisi_akhir[4] . "/" . $waktu_revisi_akhir[6];
        $waktu_sidang_proposal = explode(" ", $request->waktu_sidang_proposal);
        $request->waktu_sidang_proposal = $waktu_sidang_proposal[1] . " " . $waktu_sidang_proposal[0] . "/" . $waktu_sidang_proposal[2] . " " . $waktu_sidang_proposal[3] . " " . $waktu_sidang_proposal[5] . " " . $waktu_sidang_proposal[4] . "/" . $waktu_sidang_proposal[6];
        $waktu_sidang_akhir = explode(" ", $request->waktu_sidang_akhir);
        $request->waktu_sidang_akhir = $waktu_sidang_akhir[1] . " " . $waktu_sidang_akhir[0] . "/" . $waktu_sidang_akhir[2] . " " . $waktu_sidang_akhir[3] . " " . $waktu_sidang_akhir[5] . " " . $waktu_sidang_akhir[4] . "/" . $waktu_sidang_akhir[6];

        for ($i=0; $i < 12; $i++) { 
            $request->waktu_upload_proposal = str_replace($old_month[$i], $new_month[$i], $request->waktu_upload_proposal);
            $request->waktu_upload_akhir = str_replace($old_month[$i], $new_month[$i], $request->waktu_upload_akhir);
            $request->waktu_revisi_proposal = str_replace($old_month[$i], $new_month[$i], $request->waktu_revisi_proposal);
            $request->waktu_revisi_akhir = str_replace($old_month[$i], $new_month[$i], $request->waktu_revisi_akhir);
            $request->waktu_sidang_proposal = str_replace($old_month[$i], $new_month[$i], $request->waktu_sidang_proposal);
            $request->waktu_sidang_akhir = str_replace($old_month[$i], $new_month[$i], $request->waktu_sidang_akhir);
        }
    
        Config::where('nama', 'waktu_upload_proposal')->update(['value' => $request->waktu_upload_proposal]);
        Config::where('nama', 'waktu_upload_akhir')->update(['value' => $request->waktu_upload_akhir]);
        Config::where('nama', 'waktu_revisi_proposal')->update(['value' => $request->waktu_revisi_proposal]);
        Config::where('nama', 'waktu_revisi_akhir')->update(['value' => $request->waktu_revisi_akhir]);
        Config::where('nama', 'waktu_sidang_proposal')->update(['value' => $request->waktu_sidang_proposal]);
        Config::where('nama', 'waktu_sidang_akhir')->update(['value' => $request->waktu_sidang_akhir]);

        return redirect('schedule')->with('success', 'Success to Change Schedule');
    }
}
