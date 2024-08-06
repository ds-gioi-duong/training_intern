<?php

use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Inertia\Inertia;
use App\Models\Timesheet;
use App\Http\Controllers\UserController; // Import the UserController class

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'breadcrumbs' => Breadcrumbs::generate('home'),
    ]);
});


Route::get('/home', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('home');


Route::get('/timesheet', function () {
    return Inertia::render('Timesheet');
})->middleware(['auth', 'verified'])->name('timesheet');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('users', UserController::class);


//Timesheet
Route::get('timesheets/current', [TimesheetController::class, 'showCurrent'])
    ->middleware(['auth', 'verified'])
    ->name('timesheets.showCurrent');
Route::get('timesheets', [TimesheetController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('timesheets.index');
Route::patch('timesheets/{timesheet}', [TimesheetController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('timesheets.update');
Route::delete('timesheets/{timesheet}', [TimesheetController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('timesheets.destroy');
Route::post('timesheets', [TimesheetController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('timesheets.store');

Route::get('timesheets/today', [TimesheetController::class, 'showToday'])
    ->middleware(['auth', 'verified'])
    ->name('timesheets.showToday');

Route::get('timesheets/{timesheet}', [TimesheetController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('timesheets.show');

Route::get('timesheets/null', function () {
    return Inertia::render('NoTimesheet');
})->middleware(['auth', 'verified'])->name('timesheets.null');


//Task
Route::post('timesheets/{timesheet}/tasks', [TaskController::class, 'store'])
    ->middleware(['auth'])
    ->name('tasks.store');
Route::patch('tasks/{task}', [TaskController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('tasks.update');
Route::delete('tasks/{task}', [TaskController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('tasks.destroy');


Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.index');
require __DIR__ . '/auth.php';
