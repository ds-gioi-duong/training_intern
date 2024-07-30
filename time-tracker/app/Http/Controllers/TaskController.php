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

    public function store(StoreTaskRequest $request,Timesheet $timesheet) :RedirectResponse
    {

        $validated = $request->validated();
        $timesheet->tasks()->create($validated);
        return redirect(route('timesheets.show', $validated['timesheet_id']));
    }

    public function destroy(Timesheet $timesheet, Task $task)
    {
        if ($task) {
            $task->delete();
            return response()->json(['message' => 'Task deleted successfully']);
        } else {
            return response()->json(['message' => 'Task not found'], 404);
        }
    }
}
