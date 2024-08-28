<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Timesheet;
class DashboardController extends Controller {
    public function index(): Response
    {
        $user = Auth::user();
        $timesheets = Timesheet::where('user_id', $user->id)->get();

        $tasks = Task::whereHas('timesheet', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        $totalTimesheets = $timesheets->count();
        $totalTasks = $tasks->count();
        // $totalTasksTime = $tasks->sum('end-time'- 'start-time');`

        $data = [
            'timesheets' => $timesheets,
            'tasks' => $tasks,
        ];
        //Test data
        // dd($data);
        return Inertia::render('Dashboard', [
            'data' => $data
        ]);
    }

}