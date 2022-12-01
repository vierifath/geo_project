<?php

namespace Database\Seeders;

use App\Models\Nomor_surat;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $username = [
            [
                'email'  => 'Admin@gmail.com',
                'nip'  => 'Admin',
                'nama'  => 'Administrator',
                'password'  => Hash::make('password'),
                'role' => '0'
            ],
        ];

        for ($i=0; $i < count($username); $i++) { 
            User::create($username[$i]);
        }
    }
}
