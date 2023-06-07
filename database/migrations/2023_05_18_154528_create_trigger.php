<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER add_inhabitant_manually AFTER INSERT ON `users` FOR EACH ROW
            BEGIN
            IF new.role = 2 THEN
            INSERT INTO inhabitants (`id_user`)
            VALUES (NEW.id);
            END IF;
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
        DB::unprepared('DROP TRIGGER `add_inhabitant_manually`');
    }
};
