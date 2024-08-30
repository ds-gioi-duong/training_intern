<?php

use App\Http\Controllers\User\TimesheetController;
use App\Http\Controllers\User\TaskController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Inertia\Inertia;
use App\Models\Timesheet;
use App\Http\Controllers\User\UserController; // Import the UserController class

Route::get('/', function () {
    return Inertia::render('User/Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'breadcrumbs' => Breadcrumbs::generate('home'),
    ]);
});

Route::patch('task/{task}', [TaskController::class, 'update'])
    ->name('tasks.update');

Route::get('/home', function () {
    return Inertia::render('User/Dashboard');
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
    // ->middleware(['auth', 'verified'])
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



Route::delete('tasks/{task}', [TaskController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('tasks.destroy');


Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
require __DIR__ . '/auth.php';
