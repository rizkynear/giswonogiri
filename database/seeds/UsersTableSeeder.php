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
            [
                'nama' => 'rian',
                'email' =>'rian@gmail.com',
                'username' =>'rianbayusaputra',
                'password' => bcrypt('123456')
            ],
            [
                'nama' => 'zahrul',
                'email' =>'zahrul@gmail.com',
                'username' =>'zahrulgunawan',
                'password' => bcrypt('123456')
            ]
        ]);
    }
}
