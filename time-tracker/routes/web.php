<?php
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::resource('timesheets', TimesheetController::class)
    ->only(['index', 'store','update','destroy','showCurrent'])
    ->middleware(['auth', 'verified']);
require __DIR__.'/auth.php';


Route::get('timesheets/today', [TimesheetController::class, 'showToday'])
    ->middleware(['auth', 'verified'])
    ->name('timesheets.showToday');
// Route::get('timesheets', [TimesheetController::class,'showCurrent'])
//     ->middleware(['auth', 'verified'])->name('timesheets.showCurrent');

Route::get('timesheets/{timesheet}', [TimesheetController::class, 'show'])
->middleware(['auth', 'verified'])->name('timesheets.show');

Route::get('timesheets/null', function () {
    return Inertia::render('NoTimesheet');
})->middleware(['auth', 'verified'])->name('timesheets.null');

Route::resource('timesheets/{timesheet}/tasks', TaskController::class)
    ->only(['store','destroy'])
    ->middleware(['auth', 'verified']);
require __DIR__.'/auth.php';
