<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'tb_nilai_siswa';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id_siswa',
        'id_mapel',
        'nilai',
        'semester',
    ];

    /**
     * Relasi dengan model Siswa.
     * Setiap data nilai siswa akan terkait dengan satu siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    /**
     * Relasi dengan model Mapel.
     * Setiap data nilai siswa akan terkait dengan satu mata pelajaran (mapel).
     */
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }
}
