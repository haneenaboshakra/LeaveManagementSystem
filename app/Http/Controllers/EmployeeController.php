<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
