<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavingsController;
use App\Http\Middleware\CheckAccountStatus;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify', function(){
    return view('auth.email-verification');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard'); 
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification email sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware(['auth','verified', CheckAccountStatus::class])->group(function () {
    // logout route
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    
    // Authenticated routes
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('profile/{user}', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::patch('profile/{user}/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::Post('dashboard', [DashboardController::class, 'switchUser'])->name('dashboard');
   Route::resource('transactions', TransactionsController::class);

    Route::middleware([RoleMiddleware::class . ':admin,staff'])->group( function () : void {
        Route::resource('savings', SavingsController::class);
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/{todo}', [UserController::class, 'update'])->name('users.updateAction'); 
        // Route::resource('loan-categories', LoansCartController::class);   
    });

    // Route::get('/loans', [LoansController::class, 'index'])->name('loans.index');
    // Route::get('/loans/pending', [LoansController::class, 'pending'])->name('loans.pending');
    // Route::get('/loans/approved', [LoansController::class, 'approved'])->name('loans.approved');
    // Route::resource('loans', LoansController::class);
    // Route::patch('/loans/{loan}/change-status', [LoansController::class, 'changeStatus'])->name('loans.changeStatus');

    Route::get('/unauthorized', function () {
        return view('403');
    })->name('unauthorized');
    // Route for the Settings page (GET request)

// // Route for handling form submissions or other actions (POST request)
Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

//     // Monthly Reports
// Route::get('/reports/monthly', [ReportsController::class, 'monthlyReports'])->name('reports.monthly');

// // Annual Reports
// Route::get('/reports/annual', [ReportsController::class, 'annualReports'])->name('reports.annual');

// // Custom Reports
// Route::get('/reports/custom', [ReportsController::class, 'customReports'])->name('reports.custom');
Route::get('/development-not-available', function() {
    return view('inprogress');
})->name('inprogress');
});
Route::middleware('auth')->group( function(){
    Route::get('/inactive', function () {
        return view('inactive');
    })->name('inactive');
    
    Route::get('/support', function () {
        return view('support');
    })->name('support');
    
});
// Login routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('forgot-password', [LoginController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [LoginController::class, 'sendResetLinkEmail'])->name('password.reset');
Route::post('/settings/store', [SettingsController::class, 'store'])->name('settings.store');
Route::get('config' ,function(){
    return view('config.index');
});
Route::get('config/create' ,function(){
    return view('config.create');
});