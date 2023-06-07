<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inhabitant_report', function (Blueprint $table) {
            $table->id();
            $table->text('case');

            $table->unsignedBigInteger('id_inhabitant')->nullable();
            $table->foreign('id_inhabitant')->references('id')->on('inhabitants')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inhabitant_report');
    }
};
