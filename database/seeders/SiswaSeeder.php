<?php

namespace Database\Seeders;

use App\Models\Siswa;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswaData = [
            [
                'id_agama' => 1, // Agama misalnya Islam
                'nisn' => '0034218765',
                'nama_lengkap' => 'Budi Santoso',
                'password' => bcrypt('password'),
                'tanggal_masuk' => now()->subYears(2), // Masuk 2 tahun yang lalu
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2007-05-10',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'no_hp' => '081234567890',
                'email' => 'budi.santoso@example.com',
                'foto' => 'default.jpg', // Foto default
                'asal_sekolah' => 'SMP Negeri 1 Jakarta',
                'jurusan' => 'IPA',
                'status' => 'aktif',
            ],
            [
                'id_agama' => 2, // Agama misalnya Kristen
                'nisn' => '0034218766',
                'nama_lengkap' => 'Maria Indah Sari',
                'password' => bcrypt('password'),
                'tanggal_masuk' => now()->subYears(1),
                'jenis_kelamin' => 'perempuan',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2006-08-12',
                'alamat' => 'Jl. Soekarno-Hatta No. 22, Bandung',
                'no_hp' => '082345678901',
                'email' => 'maria.sari@example.com',
                'foto' => 'default.jpg',
                'asal_sekolah' => 'SMP Negeri 2 Bandung',
                'jurusan' => 'IPS',
                'status' => 'aktif',
            ],
            [
                'id_agama' => 3, // Agama misalnya Hindu
                'nisn' => '0034218767',
                'nama_lengkap' => 'Dewi Ananda',
                'password' => bcrypt('password'),
                'tanggal_masuk' => now()->subYears(3),
                'jenis_kelamin' => 'perempuan',
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => '2005-11-25',
                'alamat' => 'Jl. Raya Uluwatu No. 5, Denpasar',
                'no_hp' => '083456789012',
                'email' => 'dewi.ananda@example.com',
                'foto' => 'default.jpg',
                'asal_sekolah' => 'SMP Negeri 3 Denpasar',
                'jurusan' => 'IPA',
                'status' => 'aktif',
            ],
            [
                'id_agama' => 1, // Agama Islam
                'nisn' => '0034218768',
                'nama_lengkap' => 'Ahmad Rizky Putra',
                'password' => bcrypt('password'),
                'tanggal_masuk' => now()->subYears(2),
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2007-02-14',
                'alamat' => 'Jl. Pemuda No. 7, Surabaya',
                'no_hp' => '081987654321',
                'email' => 'rizky.putra@example.com',
                'foto' => 'default.jpg',
                'asal_sekolah' => 'SMP Negeri 4 Surabaya',
                'jurusan' => 'IPS',
                'status' => 'aktif',
            ],
        ];

        // Insert data ke dalam tabel tb_siswa
        // DB::table('tb_siswa')->insert($siswaData);
        Siswa::insert($siswaData);
    }
}
