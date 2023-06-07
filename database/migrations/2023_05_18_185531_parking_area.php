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
        Schema::create('parking_area', function (Blueprint $table) {
            $table->string('land_code')->primary();
            $table->string('qr_code')->nullable();
            $table->text('address');
            $table->integer('price');
            $table->integer('capacity');
            $table->integer('status')->default(0);
            $table->text('information')->nullable();

            $table->unsignedBigInteger('id_zone')->nullable();
            $table->foreign('id_zone')->references('id')->on('park_zone')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('parking_area');
    }
};
