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
                'time_spent' => '04:30:00',
            ],
            [
                'timesheet_id' => 1,
                'content' => 'Debugged and fixed database connection issue',
                'time_spent' => '02:15:00',
            ],
            [
                'timesheet_id' => 2,
                'content' => 'Designed login page UI',
                'time_spent' => '03:00:00',
            ],
            [
                'timesheet_id' => 2,
                'content' => 'Integrated API endpoints',
                'time_spent' => '05:45:00',
            ],
            
          
        ]);
    }
}
