<?php 
namespace App\Repositories;
use App\Models\Timesheet;
use App\Repositories\Interface\TimesheetRepositoryInterface;
class TimesheetRepository implements TimesheetRepositoryInterface
{
    public function all()
    {
        return Timesheet::all();
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
        return Timesheet::find($id);
    }
}