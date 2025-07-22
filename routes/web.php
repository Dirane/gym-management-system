<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Models\User;

// Public Website Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/packages', [HomeController::class, 'packages'])->name('packages');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register', [HomeController::class, 'registerSubmit'])->name('register.submit');
Route::get('/test-credentials', function () {
    return view('test-credentials');
})->name('test-credentials');

// Language switching route
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Membership verification routes (for QR codes)
Route::get('/membership/verify/{card}', function($card) {
    return view('membership-verify');
})->name('membership.verify');
Route::get('/api/membership/verify/{card}', [HomeController::class, 'verifyMembership'])->name('membership.verify.api');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/membership-card', [DashboardController::class, 'membershipCard'])->name('membership.card');
    Route::get('/membership-card/download', [DashboardController::class, 'downloadMembershipCard'])->name('membership.card.download');
    Route::get('/progress', [DashboardController::class, 'progress'])->name('progress');
    Route::post('/progress', [DashboardController::class, 'storeProgress'])->name('progress.store');
    Route::get('/goals', [DashboardController::class, 'goals'])->name('goals');
    Route::post('/goals', [DashboardController::class, 'storeGoal'])->name('goals.store');
    Route::put('/goals/{goal}', [DashboardController::class, 'updateGoal'])->name('goals.update');
    Route::delete('/goals/{goal}', [DashboardController::class, 'deleteGoal'])->name('goals.delete');
});

// All admin functions are now handled by Filament at /admin
// Admin route for generating member cards
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/member/{user}/card', function (User $user) {
        $membership = $user->membership()->with('package')->first();
        
        if (!$membership || $membership->status !== 'active') {
            abort(404, 'No active membership found');
        }

        return view('dashboard.membership-card', compact('user', 'membership'));
    })->name('member.card');
});
