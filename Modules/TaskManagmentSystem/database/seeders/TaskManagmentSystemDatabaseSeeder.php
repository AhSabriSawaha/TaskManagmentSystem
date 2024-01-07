<?php

namespace Modules\TaskManagmentSystem\database\seeders;

use Illuminate\Database\Seeder;

class TaskManagmentSystemDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
