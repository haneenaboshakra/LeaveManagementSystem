<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enum\UserRole;
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
            RolePermissionsSeeder::class,
            DepartmentSeeder::class,
            UserSeeder::class,
        ]);
        // $employee = User::factory()->create([
        //     'name' => 'Hanine',
        //     'email' => 'hanine@hanine.com',
        //     'password' => bcrypt('password'),
        // ]);
        // // Assign user role to the created user
        // $employeeRole = Role::where('name', UserRole::Employee)->first();
        // $employee->assignRole($employeeRole);


        // $admin = User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'password' => bcrypt('password'),
        // ]);
        // // Assign admin role to the created admin user
        // $adminRole = Role::where('name', UserRole::Admin)->first();
        // $admin->assignRole($adminRole);


        // $manager = User::factory()->create([
        //     'name' => 'manager',
        //     'email' => 'manager@manager.com',
        //     'password' => bcrypt('password'),
        // ]);
        // // Assign manager role to the created manager user
        // $managerRole = Role::where('name', UserRole::Manager)->first();
        // $manager->assignRole($managerRole);
    }
}
