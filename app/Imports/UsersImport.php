<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
  

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
        if (User::where('nip', $row[3])->first() == null && $row[3] != "NRP") {
            return User::create([
                'email' => $row[4],
                'nip' => $row[3],
                'nama' => $row[2],
                'password' => Hash::make($row[3]),
                'role' => 2,
            ]);
        }
    }
}
