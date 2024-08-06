<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Timesheet;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTimesheetRequest;
use App\Repositories\Interface\TimesheetRepositoryInterface;
use App\Http\Requests\UpdateTimesheetRequest;
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
        return $this->timesheetRepository->all($user->id); 
    } 
    public function show(Timesheet $timesheet): Response
    {
        Gate::authorize('view', $timesheet);  
        return $this->timesheetRepository->show($timesheet->id);
    }
    public function store(StoreTimesheetRequest $request): RedirectResponse
    {
        $this->timesheetRepository->create($request->all());
        return redirect(route('timesheets.index'));
    }
    public function update(Timesheet $timesheet,UpdateTimesheetRequest $request): RedirectResponse
    {
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
        return $this->timesheetRepository->showTodayTimesheet($user->id); 
    }
}
