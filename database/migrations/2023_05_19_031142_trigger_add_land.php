<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class TriggerAddLand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER add_amount_land AFTER INSERT ON `parking_area` FOR EACH ROW
            BEGIN
            UPDATE park_zone SET land_amount = land_amount + 1 WHERE id=NEW.id_zone;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `add_amount_land`');
    }
};
