<?php
namespace App\Http\Controllers;

use App\Models\Timesheet;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

 class ListTimeSheetController extends Controller
 {
    public function index() : Response {
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

        return redirect(route('timesheets.index'));
    }

 }