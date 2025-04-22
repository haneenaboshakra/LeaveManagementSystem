<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            RolePermissionsSeeder::class
        ]);
        $employee = User::factory()->create([
            'name' => 'employee',
            'email' => 'employee@employee.com',
            'password' => bcrypt('password'),
        ]);
        // Assign user role to the created user
        $employeeRole = Role::where('name', 'employee')->first();
        $employee->assignRole($employeeRole);


        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        // Assign admin role to the created admin user
        $adminRole = Role::where('name', 'admin')->first();
        $admin->assignRole($adminRole);

        $manager = User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@manager.com',
            'password' => bcrypt('password'),
        ]);
        // Assign manager role to the created manager user
        $managerRole = Role::where('name', 'manager')->first();
        $manager->assignRole($managerRole);
    }
}
