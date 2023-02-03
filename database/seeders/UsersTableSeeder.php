<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        \DB:: table('users')->insert([
            'name' => 'Charles Demetillo',
            'email' => 'admin',
            'password' => bcrypt('admin123'),
            'user_type' => 1,
        ]);

    }
}
