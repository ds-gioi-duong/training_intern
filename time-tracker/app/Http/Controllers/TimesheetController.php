<?php
 
namespace App\Http\Controllers;
 
use App\Models\Timesheet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Diglactic\Breadcrumbs\Breadcrumbs;
 
class TimesheetController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */    
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
    public function index(): Response 
    {
        return Inertia::classrender('Timesheet', [
            //
        ]);
    }
}

