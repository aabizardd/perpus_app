<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParkingAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parking_area')->insert([
            [
                'land_code' => "LP-D45",
                'address' => "Alamat nya di blok D45",
                'price' => 300000,
                'capacity' => 2,
                'id_zone' => 3,
                // 'information'
            ],
            [
                'land_code' => "LP-A05",
                'address' => "Alamat nya di blok A45",
                'price' => 200000,
                'capacity' => 1,
                'id_zone' => 2,
                // 'information'
            ],

        ]
        );
    }
}