<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan tabel hanya memiliki satu baris data
        Setting::truncate();

        // Data pengaturan default
        Setting::create([
            // Pengaturan Sekolah
            'school_name' => 'SMA Negeri 1 Contoh',
            'school_address' => 'Jl. Pendidikan No. 1, Contoh Kota',
            'school_phone' => '021-12345678',
            'school_email' => 'info@sman1contoh.sch.id',

            // Pengaturan Website
            'site_name' => 'SIAKAD SMA Negeri 1 Contoh',
            'site_description' => 'Sistem Informasi Akademik SMA Negeri 1 Contoh',
            'site_logo' => null, // Path untuk logo, bisa diupload nanti melalui form
            'site_favicon' => null, // Path untuk favicon, bisa diupload nanti melalui form
            'contact_email' => 'contact@sman1contoh.sch.id',
            'contact_phone' => '021-98765432',
            'contact_address' => 'Jl. Pendidikan No. 1, Contoh Kota',
        ]);
    }
}
