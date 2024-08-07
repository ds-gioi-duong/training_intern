<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Timesheet;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTimesheetRequest;
use App\Repositories\Interface\TimesheetRepositoryInterface;
use App\Http\Requests\UpdateTimesheetRequest;
use Inertia\Inertia;
class TimesheetController extends Controller
{
    protected $timesheetRepository;
    public function __construct(TimesheetRepositoryInterface $timesheetRepository)
    {
        $this->timesheetRepository = $timesheetRepository;
    }
    public function index(): Response
    {

        $user = auth()->user(); 
        $timesheets= $this->timesheetRepository->all($user->id);
        return inertia('ListTimesheet', ['timesheets' => $timesheets]); 
    } 
    public function show(Timesheet $timesheet): Response
    {
        Gate::authorize('view', $timesheet);  
        $timesheetDetail = $this->timesheetRepository->show($timesheet->id);
        return Inertia::render('TimesheetDetail', [
            'timesheet' => $timesheetDetail,
            'tasks' => $timesheetDetail->tasks,
        ]); 
    }
    public function store(StoreTimesheetRequest $request): RedirectResponse
    {
        $this->timesheetRepository->create($request->all());
        return redirect(route('timesheets.index'));
    }
    public function update(Timesheet $timesheet,UpdateTimesheetRequest $request): RedirectResponse
    {
        dd($request->all());
        Gate::authorize('update', $timesheet);
        $this->timesheetRepository->update($request->all(), $timesheet->id);
        return redirect(route('timesheets.index'));      
    } 
    public function destroy(Timesheet $timesheet): RedirectResponse
    { 
        Gate::authorize('delete', $timesheet);
        $this->timesheetRepository->delete($timesheet->id); 
        return redirect(route('timesheets.index'));
    }
    public function showToday(): Response 
    {
        $user = auth()->user();
        $timesheet = $this->timesheetRepository->showTodayTimesheet($user->id);
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
