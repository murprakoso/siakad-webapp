<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'tb_mapel'; // Nama tabel yang digunakan

    protected $fillable = [
        'id_guru',
        'kode_mapel',
        'nama_mapel',
        'jurusan',
    ];

    /**
     * Relasi ke model Guru (One-to-Many).
     * Satu mata pelajaran (Mapel) dimiliki oleh satu guru.
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
