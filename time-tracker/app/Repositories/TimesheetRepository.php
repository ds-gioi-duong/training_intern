<?php 
namespace App\Repositories;
use App\Models\Timesheet;
use App\Models\Task;
use App\Repositories\Interface\TimesheetRepositoryInterface;
use Inertia\Response;
use Inertia\Inertia;
class TimesheetRepository implements TimesheetRepositoryInterface
{
    public function all($user_id):Response
    {
        return Inertia::render('ListTimesheet', [
            'timesheets' => Timesheet::with('tasks')
                ->where('user_id', $user_id)
                ->get(),
        ]);
    }
    public function create(array $data)
    {
        return Timesheet::create($data);
    }
    public function update(array $data, $id)
    {
        return Timesheet::find($id)->update($data);
    }
    public function delete($id)
    {
        return Timesheet::destroy($id);
    }
    public function show($id) :Response
    {
        return Inertia::render('TimesheetDetail', [
            'timesheet' => Timesheet::with('tasks')->find($id),
            'tasks' => Task::where('timesheet_id', $id)->get(),
        ]); 
    }
    public function showTodayTimesheet($user_id):Response
    {
        $timesheet = Timesheet::where('user_id', $user_id)
        ->where('date', now()->format('Y-m-d'))
        ->first();
     if ($timesheet) {
        return Inertia::render('TimesheetDetail', [
            'timesheet' => $timesheet,
            'tasks' => $timesheet->tasks,
        ]);
    } else {
        return Inertia::render(
            'NoTimesheet'
        );
    }
    }
}