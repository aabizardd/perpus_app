<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_menu')->insert([

            [
                'role' => 1,
                'menu' => 'Kelola Buku',
                'url' => 'kelola_buku',
                'icon' => 'bi bi-book',
            ],
            [
                'role' => 1,
                'menu' => 'Kelola Peminjaman Buku',
                'url' => 'peminjaman_buku',
                'icon' => 'bi bi-hourglass-split',
            ],
            [
                'role' => 1,
                'menu' => 'Kelola Admin',
                'url' => 'kelola_admin',
                'icon' => 'bi bi-person',
            ],

        ]
        );
    }
}
