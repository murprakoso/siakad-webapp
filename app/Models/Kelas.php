<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'tb_kelas';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'wali_kelas_id',
    ];

    /**
     * Mendefinisikan relasi antara Kelas dan Guru (wali kelas).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id');
    }
}
