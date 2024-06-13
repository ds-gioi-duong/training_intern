<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Timesheet;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Mail\TimesheetCreated;
use Illuminate\Support\Facades\Mail;




class TimeSheetController extends Controller
{
    public function index(): Response
    {
        $user = auth()->user();
        return Inertia::render('ListTimesheet', [
            'timesheets' => Timesheet::with('tasks')
                ->where('user_id', $user->id)
                ->get(),
        ]);
    }
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'date' => 'required',
            'user_id' => 'required',
            'difficulties' => 'required|string|max:255',
            'next_day_plans' => 'required|string|max:255',
        ]);

        $request->user()->timesheets()->create($validated);


        Mail::to('gioi.trongxuan@gmail.com')
        ->cc('gioi-duong@dimage.co.jp')
        ->bcc('gioi-duong@dimage.co.jp')
        ->send(new TimesheetCreated());
        return redirect(route('timesheets.index'));
    }
    // Update time sheet
    public function update(Request $request, Timesheet $timesheet): RedirectResponse
    {
        //
        Gate::authorize('update', $timesheet);

        $validated = $request->validate([
            'difficulties' => 'required|string|max:255',
            'next_day_plans' => 'required|string|max:255',
        ]);

        $timesheet->update($validated);

        return redirect(route('timesheets.index'));
    }
    // Delete time sheet
    public function destroy(Timesheet $timesheet): RedirectResponse
    {
        //
        Gate::authorize('delete', $timesheet);

        $timesheet->delete();

        return redirect(route('timesheets.index'));
    }
}
