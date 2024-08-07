<?php 
namespace App\Repositories;
use App\Models\Timesheet;
use App\Models\Task;
use App\Repositories\Interface\TimesheetRepositoryInterface;
class TimesheetRepository implements TimesheetRepositoryInterface
{
    public function all($user_id)
    {
           return Timesheet::with('tasks')
                ->where('user_id', $user_id)
                ->get();
        
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
    public function show($id) 
    {
        return Timesheet::with('tasks')->find($id);  
    }
    public function showTodayTimesheet($user_id)
    {
        $timesheet = Timesheet::where('user_id', $user_id)
        ->where('date', now()->format('Y-m-d'))
        ->first();
    
    }
}