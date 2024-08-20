<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guru::create([
            'username' => 'guru001',
            'password' => bcrypt('password'), // Gunakan bcrypt untuk hashing password
            'nama_lengkap' => 'Ahmad Syarif',
            'nip' => '1234567890123456',
            'jabatan_akademik' => 'Guru Matematika',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1980-05-10',
            'id_agama' => 1, // ID referensi ke tabel tb_agama
            'alamat' => 'Jl. Merdeka No.10, Jakarta',
            'no_hp' => '08123456789',
            'email' => 'ahmad.syarif@example.com',
            'foto' => null,
            'status' => 'Aktif',
        ]);

        Guru::create([
            'username' => 'guru002',
            'password' => bcrypt('password'),
            'nama_lengkap' => 'Siti Aminah',
            'nip' => '1234567890123457',
            'jabatan_akademik' => 'Guru Bahasa Indonesia',
            'jenis_kelamin' => 'Perempuan',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1985-08-15',
            'id_agama' => 2, // ID referensi ke tabel tb_agama
            'alamat' => 'Jl. Kenangan No.22, Bandung',
            'no_hp' => '08123456790',
            'email' => 'siti.aminah@example.com',
            'foto' => null,
            'status' => 'Aktif',
        ]);

    }
}
