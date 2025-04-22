<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
});


// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', function () { 
        $user = Auth::user();  // Get the authenticated user
        return view('dashboard', ['user' => $user]);

    })->name('dashboard');
});
// Manager routes
Route::prefix('manager')->middleware(['auth', 'role:manager'])->name('manager.')->group(function () {
    Route::get('/dashboard', function () { 
        $user = Auth::user();  // Get the authenticated user
        return view('dashboard', ['user' => $user]);

    })->name('dashboard');
});


require __DIR__.'/auth.php';
