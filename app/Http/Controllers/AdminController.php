<?php

namespace App\Http\Controllers;

use App\Enums\LeaveRequestStatus;
use App\Http\Requests\CreateEmployeeRequest;
use App\Models\Department;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Show all employees
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function employees() {
        // Get all employees
        $employees = User::where('role', 'employee')->get();
        return view('admin.employees.index', compact('employees'));
    }
    /**
     * Show pending Leave Requests
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function leaveRequests() {
        $leaveRequests = LeaveRequest::where('status', LeaveRequestStatus::Pending)->get();
        return view('admin.employees.leaveRequests', compact('leaveRequests'));
    }
    public function updateStatus(Request $request, $id) {
        $leaveRequest = LeaveRequest::find($id);
        $leaveRequest->status = $request->input('status');
        $leaveRequest->reviewed_by = Auth::id();
        $leaveRequest->save();
        return redirect()->back()->with('success', 'User status updated successfully.');
    }
    public function leaveRequestsHistory() {
        $leaveRequests = LeaveRequest::whereIn('status', [LeaveRequestStatus::Approved, LeaveRequestStatus::Rejected])->get();
        return view('admin.employees.history', compact('leaveRequests'));
    }
    /**
     * Create new Employee
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $departments = Department::all();  // Get all departments
        $managers = User::where('role', 'manager')->get();  // Get all managers

        return view('admin.employees.create', compact('departments', 'managers'));
    }
    /**
     * Store the newly created employee in the database
     * @param \App\Http\Requests\CreateEmployeeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateEmployeeRequest $request)
    {
        $validated = $request->validated();

        $employee = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'employee',
            'department_id' => $validated['department_id'],
            'manager_id' => $validated['manager_id'],
        ]);

        $employee->assignRole('employee');

        return redirect()->route('admin.employees.index')->with('success', 'Employee created successfully.');
    }
    // Show a specific user
    public function show(Request $request, $id)
    {
        // $employee = User::findOrFail($isd);
        $employee = User::findOrFail($id);
        $departments = Department::all();
        $managers = User::where('role', 'manager')->get();
        return view('admin.employees.show', compact('employee', 'departments', 'managers'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,'. $id,
            'department_id' => 'nullable|exists:departments,id',
            'manager_id' => 'nullable|exists:users,id',
        ]);
    
        $employee = User::findOrFail($id);
        $employee->update($request->only(['name', 'email', 'department_id', 'manager_id']));
    
        return redirect()->back()->with('success', 'Employee updated successfully.');
    }
    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();

        return redirect()->route('admin.employees.index')->with('success', 'Employee deleted successfully.');
    }
}
