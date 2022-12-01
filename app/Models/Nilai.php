<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
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
        'geologi',
        'geofisika_dasar',
        'petrofisika',
        'geofisika_terapan',
        'geofisika_komputasi',
        'geolog_1',
        'geolog_2',
        'geolog_3',
        'geolog_4',
        'geofisika_dasar_1',
        'geofisika_dasar_2',
        'geofisika_dasar_3',
        'geofisika_dasar_4',
        'petrofisika_1',
        'petrofisika_2',
        'petrofisika_3',
        'petrofisika_4',
        'geofisika_terapan_1',
        'geofisika_terapan_2',
        'geofisika_terapan_3',
        'geofisika_terapan_4',
        'geofisika_komputasi_1',
        'geofisika_komputasi_2',
        'geofisika_komputasi_3',
        'geofisika_komputasi_4',
        'penguasaan_materi_1',
        'penguasaan_materi_2',
        'penguasaan_materi_3',
        'penguasaan_materi_4',
        'cara_komunikasi_1',
        'cara_komunikasi_2',
        'cara_komunikasi_3',
        'cara_komunikasi_4',
        'materi_ppt_1',
        'materi_ppt_2',
        'materi_ppt_3',
        'materi_ppt_4',
        'laporan_1',
        'laporan_2',
        'laporan_3',
        'laporan_4',
        'nilai_pembimbing_1',
        'nilai_pembimbing_2',
    ];

    public function mahasiswa()
    {
        return $this->hasOne(User::class, 'id', 'mahasiswa_id');
    }
    
    public function soal_geologi()
    {
        return $this->hasOne(Soal::class, 'id', 'geologi');
    }
    
    public function soal_geofisika_dasar()
    {
        return $this->hasOne(Soal::class, 'id', 'geofisika_dasar');
    }
    
    public function soal_petrofisika()
    {
        return $this->hasOne(Soal::class, 'id', 'petrofisika');
    }
    
    public function soal_geofisika_terapan()
    {
        return $this->hasOne(Soal::class, 'id', 'geofisika_terapan');
    }
    
    public function soal_geofisika_komputasi()
    {
        return $this->hasOne(Soal::class, 'id', 'geofisika_komputasi');
    }
}
