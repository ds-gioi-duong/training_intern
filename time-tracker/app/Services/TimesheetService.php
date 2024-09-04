<?php

namespace App\Services;

use App\Models\Timesheet;
use App\Http\Requests\StoreTimesheetRequest;
use App\Repositories\Interface\TimesheetRepositoryInterface;
use App\Http\Requests\UpdateTimesheetRequest;
class TimesheetService
{
    protected $timesheetRepository;
    public function __construct(TimesheetRepositoryInterface $timesheetRepository)
    {
        $this->timesheetRepository = $timesheetRepository;
    }
    public function all($user)
    {
        $timesheets= $this->timesheetRepository->all($user->id);
        return $timesheets;
    } 

    public function show(Timesheet $timesheet)
    {
        $timesheetDetail = $this->timesheetRepository->show($timesheet->id);
        return $timesheetDetail;
    }
    public function create(StoreTimesheetRequest $request)
    {
        $this->timesheetRepository->create($request->all());
    }
    public function update(UpdateTimesheetRequest $request,Timesheet $timesheet)
    {
        $this->timesheetRepository->update($request->all(), $timesheet->id);
    } 
    public function destroy(Timesheet $timesheet)
    { 
        $this->timesheetRepository->delete($timesheet->id); 
    }
    public function showTodayTimesheet($user)
    {
        $timesheet = $this->timesheetRepository->showTodayTimesheet($user->id);
        return $timesheet;
    }
}
