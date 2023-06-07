<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('peminjaman_buku')->insert([
            [
                'nama_peminjam' => "Asep",
                'nomor_peminjam' => "0812332822",
                'asal_instansi' => "Telkom Bandung",
                'id_buku' => 1,
                'jumlah' => 2,
                'created_at' => now(),

            ],

        ]
        );
    }
}
