<?php

namespace Modules\TaskManagmentSystem\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        'first_name' => 'ahmad',
        'last_name' => 'admin',
        'email' => 'ah@gmail.com',
        'password' => 'password123',
        'role_id' => 0,
        ]);
    }
}
