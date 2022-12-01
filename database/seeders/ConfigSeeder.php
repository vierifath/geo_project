<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = [
            [
                'nama'  => 'waktu_upload_proposal',
            ],
            [
                'nama'  => 'waktu_upload_akhir',
            ],
            [
                'nama'  => 'waktu_revisi_proposal',
            ],
            [
                'nama'  => 'waktu_revisi_akhir',
            ],
            [
                'nama'  => 'waktu_sidang_proposal',
            ],
            [
                'nama'  => 'waktu_sidang_akhir',
            ],
        ];

        for ($i=0; $i < count($config); $i++) { 
            Config::create($config[$i]);
        }
    }
}
