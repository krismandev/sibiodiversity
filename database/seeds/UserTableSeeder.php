<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('2022'),
            'role' => 0,
        ]);

        DB::table('users')->insert([
            'name' => 'member',
            'email' => 'member@gmail.com',
            'password' => Hash::make('2022'),
            'role' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'visitor',
            'email' => 'visitor@gmail.com',
            'password' => Hash::make('2022'),
            'role' => 2,
        ]);
    }
}
