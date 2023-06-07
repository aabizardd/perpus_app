<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'name' => 'Admin A',
                'username' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('asdasd'),
                'role' => 1,
            ],
            [
                'name' => 'Warga A',
                'username' => 'warga_1',
                'email' => 'warga_1@mail.com',
                'password' => Hash::make('asdasd'),
                'role' => 2,
            ],
            [
                'name' => 'Petugas A',
                'username' => 'petugas_1',
                'email' => 'petugas_1@mail.com',
                'password' => Hash::make('asdasd'),
                'role' => 3,
            ],
            [
                'name' => 'Admin 2',
                'username' => 'admin2',
                'email' => 'admin2@mail.com',
                'password' => Hash::make('asdasd'),
                'role' => 1,
            ],

        ]
        );
    }
}