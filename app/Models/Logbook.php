<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
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
        'status',
        'topik',
        'komentar',
        'created_at',
    ];

    public function mahasiswa()
    {
        return $this->hasOne(User::class, 'id', 'mahasiswa_id');
    }
}
