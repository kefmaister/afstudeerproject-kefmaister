<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\CompanyController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        if ($role === 'student') {
            return redirect()->route('student.home');
        } elseif ($role === 'coordinator') {
            return redirect()->route('coordinator.home');
        } elseif ($role === 'company') {
            return redirect()->route('company.home');
        }
    }
    return view('welcome');
});



Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/home', [StudentController::class, 'index'])->name('student.home');
});

Route::middleware(['auth', 'role:coordinator'])->group(function () {
    Route::get('/coordinator/home', [CoordinatorController::class, 'index'])->name('coordinator.home');
});

Route::middleware(['auth', 'role:company'])->group(function () {
    Route::get('/company/home', [CompanyController::class, 'index'])->name('company.home');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
