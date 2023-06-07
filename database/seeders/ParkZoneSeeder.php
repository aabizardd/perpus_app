<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParkZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('park_zone')->insert([
            [
                'zone' => "Merah",
                'land_amount' => 0,

            ],
            [
                'zone' => "Kuning",
                'land_amount' => 0,

            ],
            [
                'zone' => "Hijau",
                'land_amount' => 0,
            ],

        ]
        );
    }
}
