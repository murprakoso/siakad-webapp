<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil beberapa ID guru dari tabel tb_guru
        $waliKelasIds = Guru::pluck('id')->toArray();

        // Pastikan ada data guru untuk menghindari error jika tabel kosong
        if (empty($waliKelasIds)) {
            $this->command->error('Tidak ada data guru untuk digunakan sebagai wali kelas.');
            return;
        }

        // Data dummy untuk tabel tb_kelas
        $kelasData = [
            [
                'nama_kelas' => 'X A',
                'tingkat' => 'X',
                'wali_kelas_id' => $waliKelasIds[array_rand($waliKelasIds)],
            ],
            [
                'nama_kelas' => 'X B',
                'tingkat' => 'X',
                'wali_kelas_id' => $waliKelasIds[array_rand($waliKelasIds)],
            ],
            [
                'nama_kelas' => 'XI A',
                'tingkat' => 'XI',
                'wali_kelas_id' => $waliKelasIds[array_rand($waliKelasIds)],
            ],
            [
                'nama_kelas' => 'XI B',
                'tingkat' => 'XI',
                'wali_kelas_id' => $waliKelasIds[array_rand($waliKelasIds)],
            ],
            [
                'nama_kelas' => 'XII A',
                'tingkat' => 'XII',
                'wali_kelas_id' => $waliKelasIds[array_rand($waliKelasIds)],
            ],
            [
                'nama_kelas' => 'XII B',
                'tingkat' => 'XII',
                'wali_kelas_id' => $waliKelasIds[array_rand($waliKelasIds)],
            ],
        ];

        // Insert data ke tabel tb_kelas
        foreach ($kelasData as $kelas) {
            Kelas::create($kelas);
        }

        $this->command->info('Data kelas berhasil diisi.');
    }
}
