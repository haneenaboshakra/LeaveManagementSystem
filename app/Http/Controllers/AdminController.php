<?php

namespace App\Http\Controllers;

use App\Enums\LeaveRequestStatus;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
