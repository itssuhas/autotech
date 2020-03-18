<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'mob'=> '1122334455',
            'gmail' => 'admin@gmail.com',
            'address'=> 'Pune Maharashtra',
            'user_type'=> 'ADMIN',
            'password' => Hash::make('password'),
        ]);
    }
}
