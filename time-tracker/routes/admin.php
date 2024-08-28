<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AdminAuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AdminAuthenticatedSessionController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/login', [AdminAuthenticatedSessionController::class, 'adminLogin']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Các routes khác dành cho admin
});
