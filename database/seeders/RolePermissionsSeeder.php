<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $emloyeeRole = Role::create(['name' => 'employee']);
        $managerRole = Role::create(['name' => 'manager']);

    }
}
