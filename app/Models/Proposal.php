<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'mahasiswa_id',
        'dosen_pembimbing_1_id',
        'dosen_pembimbing_2_id',
        'dosen_pembimbing_luar',
        'dosen_penguji_1_id',
        'dosen_penguji_2_id',
        'rmk_id',
        'status_soal',
        'status',
        'status_teks',
        'judul',
        'bidang_ilmu',
        'abstrak',
        'metodologi',
        'file',
        'file_ta',
        'pomits',
        'jurnal',
        'status_pomits',
        'status_jurnal',
        'status_revisi_ta',
        'revisi_dosen_pembimbing_1',
        'revisi_dosen_pembimbing_2',
        'revisi_dosen_luar',
        'revisi_dosen_penguji_1',
        'revisi_dosen_penguji_2',
        'revisi_proposal_dosen_pembimbing_1',
        'revisi_proposal_dosen_pembimbing_2',
        'revisi_proposal_dosen_luar',
        'revisi_proposal_dosen_penguji_1',
        'revisi_proposal_dosen_penguji_2',
        'lokasi_sidang_proposal',
        'lokasi_sidang_ta',
        'tanggal_sidang_proposal',
        'tanggal_sidang_ta',
        'created_at',
    ];

    public function mahasiswa()
    {
        return $this->hasOne(User::class, 'id', 'mahasiswa_id');
    }
    
    public function dosen_pembimbing_1()
    {
        return $this->hasOne(User::class, 'id', 'dosen_pembimbing_1_id');
    }
    
    public function dosen_pembimbing_2()
    {
        return $this->hasOne(User::class, 'id', 'dosen_pembimbing_2_id');
    }
    
    public function dosen_pembimbing_luar_id()
    {
        return $this->hasOne(User::class, 'id', 'dosen_pembimbing_luar');
    }
    
    public function dosen_penguji_1()
    {
        return $this->hasOne(User::class, 'id', 'dosen_penguji_1_id');
    }
    
    public function dosen_penguji_2()
    {
        return $this->hasOne(User::class, 'id', 'dosen_penguji_2_id');
    }
    
    public function dosen_penguji_3()
    {
        return $this->hasOne(User::class, 'id', 'dosen_penguji_3_id');
    }
    
    public function dosen_penguji_4()
    {
        return $this->hasOne(User::class, 'id', 'dosen_penguji_4_id');
    }

    public function RMK()
    {
        return $this->hasOne(Rmk::class, 'id', 'rmk_id');
    }
    
    public function logbook()
    {
        return $this->hasOne(Logbook::class, 'mahasiswa_id', 'mahasiswa_id');
    }
}
