<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_users')->insert([
            [
                'username' => 'admin_user',
                'password' => Hash::make('password'), // Hashing password untuk keamanan
                'nama_lengkap' => 'Admin User',
                'email' => 'admin@example.com',
                'no_hp' => '081234567890',
                'foto' => null, // Jika tidak ada foto
                'status' => 'active', // Menggunakan salah satu opsi enum
                'role' => 'admin', // Menggunakan salah satu opsi enum
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'operator_user',
                'password' => Hash::make('password'), // Hashing password untuk keamanan
                'nama_lengkap' => 'Operator User',
                'email' => 'operator@example.com',
                'no_hp' => '081234567891',
                'foto' => null, // Jika tidak ada foto
                'status' => 'active', // Menggunakan salah satu opsi enum
                'role' => 'operator', // Menggunakan salah satu opsi enum
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
