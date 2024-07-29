<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Task;
use App\Models\Timesheet;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTaskRequest;
use App\Mail\TimesheetCreated;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
   
    public function store(StoreTaskRequest $request): RedirectResponse
    {

        $validated = $request->validated();
        Task::create($validated);
        return redirect(route('timesheets.show',$request->timesheet_id));
    }

    
    public function destroy(Task $task): RedirectResponse
    {
        //
        Gate::authorize('delete', $task);

        $task->delete();

        return redirect(route('', absolute: false));
    }
}