<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AdminAuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
Route::middleware('admin-login')->group(function () {
    Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AdminAuthenticatedSessionController::class, 'store']);
});


Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Admin/Dashboard', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'phpVersion' => PHP_VERSION,
        ]);
    });
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('messages', [AdminController::class, 'messages'])->name('messages');
    Route::get('settings', [AdminController::class, 'settings'])->name('settings');
    Route::get('user_manager', [AdminController::class, 'user_manager'])->name('user_manager');
    Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('logout');
});
