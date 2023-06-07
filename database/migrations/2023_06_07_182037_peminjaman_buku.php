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
        Schema::create('peminjaman_buku', function (Blueprint $table) {
            $table->id();
            // $table->integer('id_buku');

            $table->string('nama_peminjam')->nullable();
            $table->string('nomor_peminjam')->nullable();
            $table->string('asal_instansi')->nullable();

            $table->unsignedBigInteger('id_buku')->nullable();
            $table->foreign('id_buku')->references('id')->on('books')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('jumlah')->nullable();
            $table->dateTime('tanggal_pengembalian')->nullable();
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
        Schema::dropIfExists('peminjaman_buku');
    }
};
