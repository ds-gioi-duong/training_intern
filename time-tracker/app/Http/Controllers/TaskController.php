<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Task;
use App\Models\Timesheet;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Mail\TimesheetCreated;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
   
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'timesheet_id' => 'required',
            'content' => 'string|max:255',
            'time_spent' => 'required|integer|min:1',
        ]);
        $timesheet=Timesheet::find($request->timesheet_id);
        $timesheet->tasks()->create($validated);
        return redirect(route('timesheets.show',$request->timesheet_id,));
    }

    
    public function destroy(Task $task): RedirectResponse
    {
        //
        Gate::authorize('delete', $task);

        $task->delete();

        return redirect(route('', absolute: false));
    }
}