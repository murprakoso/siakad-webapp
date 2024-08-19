<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;

    protected $table = 'tb_agama';

    protected $fillable = [
        'agama',
    ];

    // Relasi dengan model Siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_agama');
    }
}
