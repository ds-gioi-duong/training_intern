<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AdminAuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
Route::middleware('admin-login')->group(function () {
    Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AdminAuthenticatedSessionController::class, 'store']);
});

Route::get('/', function () {
    return Inertia::render('Admin/Dashboard', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware(['auth', 'role:Admin'])->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
});
