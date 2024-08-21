<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guruAhmad = Guru::where('nama_lengkap', 'Ahmad Syarif')->first();
        $guruSiti = Guru::where('nama_lengkap', 'Siti Aminah')->first();

        Mapel::create([
            'id_guru' => $guruAhmad->id,
            'kode_mapel' => 'BIO01',
            'nama_mapel' => 'Biologi',
            'jurusan' => 'IPA',
        ]);

        Mapel::create([
            'id_guru' => $guruAhmad->id,
            'kode_mapel' => 'MAT02',
            'nama_mapel' => 'Matematika',
            'jurusan' => 'IPA',
        ]);

        Mapel::create([
            'id_guru' => $guruAhmad->id,
            'kode_mapel' => 'FIS03',
            'nama_mapel' => 'Fisika',
            'jurusan' => 'IPA',
        ]);

        Mapel::create([
            'id_guru' => $guruSiti->id,
            'kode_mapel' => 'KIM04',
            'nama_mapel' => 'Kimia',
            'jurusan' => 'IPA',
        ]);

        Mapel::create([
            'id_guru' => $guruSiti->id,
            'kode_mapel' => 'SOS05',
            'nama_mapel' => 'Sosiologi',
            'jurusan' => 'IPS',
        ]);

        Mapel::create([
            'id_guru' => $guruAhmad->id,
            'kode_mapel' => 'GEO06',
            'nama_mapel' => 'Geografi',
            'jurusan' => 'IPS',
        ]);

        Mapel::create([
            'id_guru' => $guruSiti->id,
            'kode_mapel' => 'SEJ07',
            'nama_mapel' => 'Sejarah',
            'jurusan' => 'IPS',
        ]);

        Mapel::create([
            'id_guru' => $guruAhmad->id,
            'kode_mapel' => 'EKO08',
            'nama_mapel' => 'Ekonomi',
            'jurusan' => 'IPS',
        ]);

        Mapel::create([
            'id_guru' => $guruSiti->id,
            'kode_mapel' => 'IND09',
            'nama_mapel' => 'Bahasa Indonesia',
            'jurusan' => null,
        ]);

        Mapel::create([
            'id_guru' => $guruAhmad->id,
            'kode_mapel' => 'ING10',
            'nama_mapel' => 'Bahasa Inggris',
            'jurusan' => null,
        ]);

        Mapel::create([
            'id_guru' => $guruSiti->id,
            'kode_mapel' => 'PKN11',
            'nama_mapel' => 'Pendidikan Kewarganegaraan (PKN)',
            'jurusan' => null,
        ]);

        Mapel::create([
            'id_guru' => $guruAhmad->id,
            'kode_mapel' => 'SEN12',
            'nama_mapel' => 'Seni Budaya',
            'jurusan' => null,
        ]);

        Mapel::create([
            'id_guru' => $guruAhmad->id,
            'kode_mapel' => 'PJO13',
            'nama_mapel' => 'Pendidikan Jasmani dan Olahraga',
            'jurusan' => null,
        ]);

        Mapel::create([
            'id_guru' => $guruSiti->id,
            'kode_mapel' => 'AGM14',
            'nama_mapel' => 'Pendidikan Agama',
            'jurusan' => null,
        ]);
    }
}
