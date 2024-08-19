<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agamaList = [
            ['agama' => 'Islam'],
            ['agama' => 'Kristen'],
            ['agama' => 'Katolik'],
            ['agama' => 'Hindu'],
            ['agama' => 'Buddha'],
            ['agama' => 'Konghucu'],
        ];

        DB::table('tb_agama')->insert($agamaList);
    }
}
