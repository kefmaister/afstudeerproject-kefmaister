<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\CoordinatorProposalController;
use Illuminate\Support\Facades\Route;

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

// Student Routes
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/home', [StudentController::class, 'index'])->name('home');
    Route::get('/upload', [StudentController::class, 'showUpload'])->name('showUpload');
    Route::post('/upload', [StudentController::class, 'storeUpload'])->name('storeUpload');

    // Proposal Routes for Students:
    // The proposal form view where the student can fill out or view their proposal.
    Route::get('/proposal', [ProposalController::class, 'show'])->name('proposal.show');
    // Handle form submission (sending the proposal)
    Route::post('/proposal', [ProposalController::class, 'store'])->name('proposal.store');
});

// Coordinator Routes
Route::middleware(['auth'])->prefix('coordinator')->name('coordinator.')->group(function () {
    Route::get('/home', [CoordinatorController::class, 'index'])->name('home');
    Route::get('/student/{student}', [CoordinatorController::class, 'showStudent'])->name('student.show');
    Route::get('/student/{student}/cv', [CoordinatorController::class, 'showStudentCv'])->name('student.cv');
    Route::get('/student/{student}/proposal', [CoordinatorController::class, 'showStudentProposal'])->name('student.proposal');
    Route::put('/proposal/{proposal}', [CoordinatorController::class, 'updateProposal'])->name('proposal.update');
    Route::post('/cv/{cv}/feedback', [CoordinatorController::class, 'giveCvFeedback'])->name('cv.feedback');
});
// Company Routes
Route::middleware(['auth'])->prefix('company')->name('company.')->group(function () {
    Route::get('/home', [CompanyController::class, 'index'])->name('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
