<?php

namespace App\Models;

// use Illuminate\Auth\Authenticatable;
// use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class Guru extends Model implements AuthenticatableContract
class Guru extends Authenticatable
    // class Guru extends Model
{
    use HasFactory;

    protected $table = 'tb_guru';

    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
        'nip',
        'jabatan_akademik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'id_agama',
        'alamat',
        'no_hp',
        'email',
        'foto',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    // Hash password before saving to database
    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($guru) {
    //         if ($guru->password) {
    //             $guru->password = Hash::make($guru->password);
    //         }
    //     });
    // }

    // Relasi ke tabel tb_agama
    public function agama()
    {
        return $this->belongsTo(Agama::class, 'id_agama');
    }

    /**
     * Relasi ke model Mapel (One-to-Many).
     * Seorang guru dapat memiliki banyak mata pelajaran (Mapel).
     */
    public function mapel()
    {
        return $this->hasMany(Mapel::class, 'id_guru');
    }

    /**
     * Mendefinisikan relasi antara Guru dan Kelas (wali kelas).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }
}
