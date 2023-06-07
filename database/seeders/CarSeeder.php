<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars')->insert([
            [
                'id_land' => "LP-D45",
                'license_number' => "F 1878 GZ",
                'brand' => "Mazda",
                'color' => "Merah",
                'id_inhabitant' => 1,
                // 'information'
            ],
        ]
        );
    }
}