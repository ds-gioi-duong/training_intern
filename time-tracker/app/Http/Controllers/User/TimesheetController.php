<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Gate;
use App\Models\Timesheet;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTimesheetRequest;
use App\Http\Requests\UpdateTimesheetRequest;
use App\Services\TimesheetService;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
class TimesheetController extends Controller
{
    protected $timesheetService;
    public function __construct(TimesheetService $timesheetService)
    {
        $this->timesheetService = $timesheetService;
    }
    public function index(): Response
    {
        $user = auth()->user(); 
        $timesheets= $this->timesheetService->all($user);
        return inertia('ListTimesheet', ['timesheets' => $timesheets]); 
    } 
    public function show(Timesheet $timesheet): Response
    {
        Gate::authorize('view', $timesheet);  
        $timesheetDetail = $this->timesheetService->show($timesheet);
        return Inertia::render('TimesheetDetail', [
            'timesheet' => $timesheetDetail,
            'tasks' => $timesheetDetail->tasks,
        ]); 
    }
    public function store(StoreTimesheetRequest $request): RedirectResponse
    {
        $this->timesheetService->create($request);
        return redirect(route('timesheets.index'));
    }
    public function update(Timesheet $timesheet,UpdateTimesheetRequest $request): RedirectResponse
    {
        Gate::authorize('update', $timesheet);
        $this->timesheetService->update($request, $timesheet);
        return redirect(route('timesheets.index'));      
    } 
    public function destroy(Timesheet $timesheet): RedirectResponse
    { 
        Gate::authorize('delete', $timesheet);
        $this->timesheetService->delete($timesheet); 
        return redirect(route('timesheets.index'));
    }
    public function showToday(): Response 
    {
        $user = auth()->user(); 
        $timesheet = $this->timesheetService->showTodayTimesheet($user);
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
