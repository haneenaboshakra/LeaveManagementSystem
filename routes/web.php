<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:employee'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:employee'])->name('employee.')->group(function () {
    Route::get('/leave-request/create', [EmployeeController::class, 'create'])->name('leave-request.create');
    Route::post('/leave-request', [EmployeeController::class, 'store'])->name('leave-request.store');
    Route::get('/leave-request/history', [EmployeeController::class, 'history'])->name('leave-request.history');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();  // Get the authenticated user

        return view('dashboard', ['user' => $user]);

    })->name('dashboard');
    Route::get('/employees', [AdminController::class, 'employees'])->name('employees.index');
    Route::get('/employees/new', [AdminController::class, 'create'])->name('employees.create');
    Route::post('/employee', [AdminController::class, 'store'])->name('employees.store');
    Route::get('/employee/{id}', [AdminController::class, 'show'])->name('employees.show');
    Route::put('/employee/{id}', [AdminController::class, 'update'])
        ->name('employees.update');
    Route::delete('/admin/employee/{id}', [AdminController::class, 'destroy'])
        ->name('employees.destroy');

    Route::get('/leave-requests', [AdminController::class, 'leaveRequests'])->name('employees.leaveRequests');
    Route::post('/leave-requests/{id}', [AdminController::class, 'updateStatus'])->name('employees.updateStatus');
    Route::get('/leave-requests/history', [AdminController::class, 'leaveRequestsHistory'])->name('employees.history');
});
// Manager routes
Route::prefix('manager')->middleware(['auth', 'role:manager'])->name('manager.')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();  // Get the authenticated user

        return view('dashboard', ['user' => $user]);

    })->name('dashboard');
    Route::get('/employees', [ManagerController::class, 'employees'])->name('employees.index');
    Route::get('/leave-requests', [ManagerController::class, 'leaveRequests'])->name('employees.leaveRequests');
    Route::post('/leave-requests/{id}', [ManagerController::class, 'updateStatus'])->name('employees.updateStatus');
    Route::get('/leave-requests/history', [ManagerController::class, 'leaveRequestsHistory'])->name('employees.history');
});

Route::fallback(function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';
