<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranSiswa extends Model
{
    use HasFactory;

    protected $table = 'tb_pendaftaran_siswa_baru';

    protected $fillable = [
        'id_siswa',
        'tanggal_pendaftaran',
        'status',
    ];

    // Relationship with Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public static function getStatusOptions()
    {
        return [
            'terdaftar' => 'Terdaftar',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak'
        ];
    }
}
