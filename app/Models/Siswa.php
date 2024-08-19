<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'tb_siswa';

    protected $fillable = [
        'id_agama',
        'nisn',
        'nama_lengkap',
        'password',
        'tanggal_masuk',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'email',
        'foto',
        'asal_sekolah',
        'jurusan',
        'status',
    ];

    // Relasi dengan model Agama
    public function agama()
    {
        return $this->belongsTo(Agama::class, 'id_agama');
    }
}
