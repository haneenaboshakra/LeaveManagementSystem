<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    // create a leave request
    public function create()
    {
        return view('employee.leave-request.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:sick,vacation,emergency,other',
            'from_date' => 'required|date|after_or_equal:today',
            'to_date' => 'required|date|after_or_equal:from_date',
            'reason' => 'nullable|string|max:1000',
        ], [
            'from_date.after_or_equal' => 'The start date must be today or a future date.',
            'to_date.after_or_equal' => 'The end date must be on or after the start date.',
        ]);

        $request->user()->leaveRequests()->create([
            'type' => $request->type,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Leave request submitted successfully.');
    }

    public function history()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        // Select all old leave requests for the authenticated user
        $leaveRequests = $user->leaveRequests()->latest()->get();

        return view('employee.leave-request.history', compact('leaveRequests'));
    }
}
