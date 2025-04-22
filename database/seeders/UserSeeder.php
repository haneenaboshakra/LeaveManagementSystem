<?php

namespace Database\Seeders;

use App\Enums\LeaveRequestStatus;
use App\Enums\UserRole;
use App\Models\Department;
use App\Models\LeaveRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch roles from the database
        $employeeRole = Role::where('name', UserRole::Employee)->first();
        $adminRole = Role::where('name', UserRole::Admin)->first();
        $managerRole = Role::where('name', UserRole::Manager)->first();

        // Create departments
        $hrDepartment = Department::where('name', 'HR')->first();
        $engDepartment = Department::where('name', 'Engineering')->first();

        // Create Admin user
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin', // You can choose to omit this since the role is assigned separately
        ]);
        $admin->assignRole($adminRole);  // Assign role to admin

        // Create Managers
        $hrManager = User::create([
            'name' => 'HR Manager',
            'email' => 'hr_manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'department_id' => $hrDepartment->id,
        ]);
        $hrManager->assignRole($managerRole);  // Assign role to HR Manager

        $engManager = User::create([
            'name' => 'Engineering Manager',
            'email' => 'eng_manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'department_id' => $engDepartment->id,
        ]);
        $engManager->assignRole($managerRole);  // Assign role to Engineering Manager

        // Create Employees for HR Manager
        $hrEmployee1 = User::create([
            'name' => 'HR Employee 1',
            'email' => 'employee1@example.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'department_id' => $hrDepartment->id,
            'manager_id' => $hrManager->id,
        ]);
        $hrEmployee1->assignRole($employeeRole);  // Assign role to Employee

        $hrEmployee2 = User::create([
            'name' => 'HR Employee 2',
            'email' => 'employee2@example.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'department_id' => $hrDepartment->id,
            'manager_id' => $hrManager->id,
        ]);
        $hrEmployee2->assignRole($employeeRole);  // Assign role to Employee

        // Create Employees for Engineering Manager
        $engEmployee1 = User::create([
            'name' => 'Eng Employee 1',
            'email' => 'employee3@example.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'department_id' => $engDepartment->id,
            'manager_id' => $engManager->id,
        ]);
        $engEmployee1->assignRole($employeeRole);  // Assign role to Employee

        // Create Leave Requests for HR Employees
        LeaveRequest::create([
            'user_id' => $hrEmployee1->id,
            'reviewed_by' => $hrManager->id,
            'type' => 'vacation',
            'status' => LeaveRequestStatus::Approved, // Approved status
            'from_date' => Carbon::today()->addDays(2), // 2 days from today
            'to_date' => Carbon::today()->addDays(5), // 5 days from today
            'reason' => 'Vacation leave',
        ]);

        LeaveRequest::create([
            'user_id' => $hrEmployee2->id,
            'reviewed_by' => $hrManager->id,
            'type' => 'sick',
            'status' => LeaveRequestStatus::Rejected, // Rejected status
            'from_date' => Carbon::today()->addDays(1), // 1 day from today
            'to_date' => Carbon::today()->addDays(3), // 3 days from today
            'reason' => 'Medical leave',
        ]);
        LeaveRequest::create([
            'user_id' => $hrEmployee2->id,
            'reviewed_by' => null,
            'type' => 'sick',
            'status' => LeaveRequestStatus::Pending, // Rejected status
            'from_date' => Carbon::today()->addDays(1), // 1 day from today
            'to_date' => Carbon::today()->addDays(3), // 3 days from today
            'reason' => 'Medical leave',
        ]);

        // Create Leave Requests for Engineering Employee
        LeaveRequest::create([
            'user_id' => $engEmployee1->id,
            'reviewed_by' => null,
            'type' => 'emergency',
            'status' => LeaveRequestStatus::Pending, // Pending status
            'from_date' => Carbon::today()->addDays(1), // 1 day from today
            'to_date' => Carbon::today()->addDays(2), // 2 days from today
            'reason' => 'Emergency leave',
        ]);
        // Create Leave Requests for Engineering Employee
        LeaveRequest::create([
            'user_id' => $engEmployee1->id,
            'reviewed_by' => null,
            'type' => 'emergency',
            'status' => LeaveRequestStatus::Pending, // Pending status
            'from_date' => Carbon::today()->addDays(1), // 1 day from today
            'to_date' => Carbon::today()->addDays(2), // 2 days from today
            'reason' => 'Emergency leave',
        ]);
        LeaveRequest::create([
            'user_id' => $engEmployee1->id,
            'reviewed_by' => $engManager->id,
            'type' => 'emergency',
            'status' => LeaveRequestStatus::Approved, // Pending status
            'from_date' => Carbon::today()->addDays(1), // 1 day from today
            'to_date' => Carbon::today()->addDays(2), // 2 days from today
            'reason' => 'Emergency leave',
        ]);
        LeaveRequest::create([
            'user_id' => $engEmployee1->id,
            'reviewed_by' => $engManager->id,
            'type' => 'emergency',
            'status' => LeaveRequestStatus::Rejected, // Pending status
            'from_date' => Carbon::today()->addDays(1), // 1 day from today
            'to_date' => Carbon::today()->addDays(2), // 2 days from today
            'reason' => 'Emergency leave',
        ]);
    }
}
