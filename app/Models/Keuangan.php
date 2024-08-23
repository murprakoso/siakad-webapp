<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $table = 'tb_keuangan';

    protected $fillable = [
        'id_siswa',
        'jumlah_pembayaran',
        'tanggal_pembayaran',
        'status_pembayaran',
    ];


    // Fungsi untuk mendapatkan opsi status pembayaran
    public static function getStatusOptions()
    {
        return [
            'belum_bayar' => 'Belum Bayar',
            'lunas' => 'Lunas',
            'menunggak' => 'Menunggak'
        ];
    }

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
