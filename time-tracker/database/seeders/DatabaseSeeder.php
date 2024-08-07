<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'gioi',
                'name' => 'Gioi Duong',
                'email' => 'gioi.trongxuan@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('a'),
                'avatar' => 'https://example.com/avatar1.jpg',
                'description' => 'Software engineer with 5 years of experience',
                'role' => 'Admin',
                'updated_at' => now(),
            ],
        ]);

        
    }
}
