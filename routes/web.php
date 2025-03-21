<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CoordinatorProposalController;
use App\Http\Controllers\CoordinatorInboxController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use App\Models\User;

Route::get('/', [WelcomeController::class, 'index']);

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/home', [StudentController::class, 'index'])->name('home');
    Route::get('/upload', [StudentController::class, 'showUpload'])->name('showUpload');
    Route::post('/upload', [StudentController::class, 'storeUpload'])->name('storeUpload');
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
});

//proposal routes
Route::middleware(['auth'])->group(function () {
    Route::get('/proposal', [ProposalController::class, 'show'])->name('proposal.show');
    Route::post('/proposal/create', [ProposalController::class, 'create'])->name('proposal.create');
    Route::post('/proposal/store', [ProposalController::class, 'store'])->name('proposal.store');
});

// Coordinator Routes
Route::middleware(['auth', 'role:coordinator'])->prefix('coordinator')->name('coordinator.')->group(function () {
    Route::get('/home', [CoordinatorController::class, 'index'])->name('home');
    Route::get('/student/{student}', [CoordinatorController::class, 'showStudent'])->name('student.show');
    Route::get('/student/{student}/cv', [CoordinatorController::class, 'showStudentCv'])->name('student.cv');
    Route::get('/student/{student}/proposal', [CoordinatorController::class, 'showStudentProposal'])->name('student.proposal');
    Route::put('/proposal/{proposal}', [CoordinatorController::class, 'updateProposal'])->name('proposal.update');
    Route::post('/cv/{cv}/feedback', [CoordinatorController::class, 'giveCvFeedback'])->name('cv.feedback');

    Route::prefix('inbox')->name('inbox.')->group(function () {
        Route::get('/', [CoordinatorInboxController::class, 'index'])->name('index');
        Route::get('/companies', [CoordinatorInboxController::class, 'indexCompanies'])->name('companies');
        Route::put('/companies/{company}/approve', [CoordinatorInboxController::class, 'approveCompany'])->name('approve.company');
        Route::put('/companies/{company}/deny', [CoordinatorInboxController::class, 'denyCompany'])->name('deny.company');
        Route::get('/stages', [CoordinatorInboxController::class, 'indexStages'])->name('stages');
        Route::put('/stages/{stage}/approve', [CoordinatorInboxController::class, 'approveStage'])->name('approve.stage');
        Route::put('/stages/{stage}/deny', [CoordinatorInboxController::class, 'denyStage'])->name('deny.stage');
    });
    Route::get('/approved-companies', [CoordinatorController::class, 'approvedCompanies'])->name('approved-companies');
    Route::get('/profile', [CoordinatorController::class, 'profile'])->name('profile');
    Route::put('/profile', [CoordinatorController::class, 'updateProfile'])->name('profile.update');
});

// Company Routes
Route::middleware(['auth', 'role:company'])->prefix('company')->name('company.')->group(function () {
    Route::get('/home', [CompanyController::class, 'index'])->name('home');
    Route::get('/waiting', [CompanyController::class, 'waiting'])->name('waiting');
    Route::get('/denied', [CompanyController::class, 'denied'])->name('denied');
    Route::get('/students', [CompanyController::class, 'studentList'])->name('student-list');
    Route::get('/student/{student}', [CompanyController::class, 'showStudent'])->name('student.show');
    Route::get('/stages/create', [CompanyController::class, 'create'])->name('stages.create');
    Route::post('/stages', [CompanyController::class, 'store'])->name('stages.store');
    Route::put('/stages/{stage}/activate', [CompanyController::class, 'activateStage'])->name('stages.activate');
    Route::put('/stages/{stage}/deactivate', [CompanyController::class, 'deactivateStage'])->name('stages.deactivate');
    Route::put('/stages/{stage}', [CompanyController::class, 'update'])->name('stages.update');
    Route::get('/profile', [CompanyController::class, 'profile'])->name('profile');
    Route::put('/profile', [CompanyController::class, 'updateProfile'])->name('profile.update');
});



Route::get('/magic-login/{user}', function (User $user, Request $request) {
    if (! $request->hasValidSignature()) {
        abort(401, 'Invalid or expired link.');
    }

    Auth::login($user);

    // Redirect based on role (optional)
    switch ($user->role) {
        case 'company':
            return redirect()->route('company.home');
        case 'student':
            return redirect()->route('student.home');
        case 'coordinator':
            return redirect()->route('coordinator.home');
        default:
            abort(403, 'Ongeldige rol.');
    }
})->name('magic.login');


require __DIR__.'/auth.php';
