<?php

namespace App\Http\Controllers;

use App\Enums\LeaveRequestStatus;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function employees()
    {
        // Get the authenticated manager
        $manager = Auth::user();

        // Get all employees related to the authenticated manager
        $employees = User::where('role', 'employee')->where('manager_id', $manager->id)->get();

        return view('manager.employees.index', compact('employees'));
    }

    public function leaveRequests()
    {
        // Get employees assigned to the current manager
        $employees = User::where('role', 'employee')
            ->where('manager_id', Auth::user()->id)
            ->get();

        // Get the leave requests only for these employees and with 'Pending' status
        $leaveRequests = LeaveRequest::where('status', LeaveRequestStatus::Pending)
            ->whereIn('user_id', $employees->pluck('id')) // Only get leave requests from these employees
            ->get();

        // Pass the leave requests to the view
        return view('manager.employees.leaveRequests', compact('leaveRequests'));
    }

    public function updateStatus(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::find($id);
        $leaveRequest->status = $request->input('status');
        $leaveRequest->reviewed_by = Auth::id();
        $leaveRequest->save();

        return redirect()->back()->with('success', 'User status updated successfully.');
    }

    public function leaveRequestsHistory()
    {
        // Get employees assigned to the current manager
        $employees = User::where('role', 'employee')
            ->where('manager_id', Auth::user()->id)
            ->get();

        $leaveRequests = LeaveRequest::whereIn('status', [LeaveRequestStatus::Approved, LeaveRequestStatus::Rejected])
            ->whereIn('user_id', $employees->pluck('id'))
            ->get();

        return view('manager.employees.history', compact('leaveRequests'));
    }
}
