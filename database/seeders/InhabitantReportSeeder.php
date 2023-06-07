<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InhabitantReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inhabitant_report')->insert([
            [
                'case' => "Lahan LP-D45 pada blok D kok ada yang nempatin selain saya ya? tolong diurus ya pak",
                'id_inhabitant' => 1,
            ],

        ]
        );
    }
}
