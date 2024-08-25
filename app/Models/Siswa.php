<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
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

    // Relasi ke model Keuangan
    public function keuangan()
    {
        return $this->hasMany(Keuangan::class, 'id_siswa');
    }

    // Relationship with PendaftaranSiswaBaru
    public function siswaBaru()
    {
        return $this->hasOne(PendaftaranSiswa::class, 'id_siswa');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_siswa');
    }
}
