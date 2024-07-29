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
                'password' => bcrypt('a'),
                'avatar' => 'https://example.com/avatar1.jpg',
                'description' => 'Software engineer with 5 years of experience',
                'role' => 'Admin',
            ],
        ]);

        DB::table('timesheets')->insert([
            [
                'date' => '2024-06-05',
                'user_id' => 1,
                'difficulties' => 'Encountered some technical issues with the server',
                'next_day_plans' => 'Plan to resolve the server issues',
            ],
            [
                'date' => '2024-06-07',
                'user_id' => 1,
                'difficulties' => 'Worked on optimizing database queries',
                'next_day_plans' => 'Plan to test the performance improvements',
            ],
        ]);

        DB::table('tasks')->insert([
            [
                'timesheet_id' => 1,
                'content' => 'Implemented new authentication feature',
                'start_time' => '2024-06-05 09:00:00',
                'end_time' => '2024-06-05 11:00:00',
            ]
          
        ]);
    }
}
