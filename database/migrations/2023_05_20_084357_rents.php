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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();

            $table->string('id_land')->nullable();
            $table->foreign('id_land')->references('land_code')->on('parking_area')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('id_inhabitant')->nullable();
            $table->foreign('id_inhabitant')->references('id')->on('inhabitants')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('book_option')->nullable();
            $table->integer('payment_total')->nullable();
            $table->integer('status')->default(0);
            $table->integer('is_expired')->default(0);

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
        Schema::dropIfExists('rents');
    }
};
