<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
            ['name' => 'HR'],
            ['name' => 'Engineering'],
            ['name' => 'Marketing'],
        ]);
    }
}
