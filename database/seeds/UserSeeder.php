<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'Ari',
            'email'=> 'ari@gmail.com',
            'password' => bcrypt('hola'),
            'tipo'=>'1', 
            'remember_token'=>'hhh'
        ]);
    }
}
