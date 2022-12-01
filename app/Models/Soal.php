<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis',
        'soal',
        'mata_kuliah_id',
        'jawaban',
        'image'
    ];

    public function MataKuliah()
    {
        return $this->hasOne(MataKuliah::class, 'id', 'mata_kuliah_id');
    }
}
