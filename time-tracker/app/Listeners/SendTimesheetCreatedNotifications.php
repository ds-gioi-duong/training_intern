<?php

namespace App\Listeners;

use App\Events\TimesheetCreated;
use App\Models\Timesheet;
use App\Models\User;
use App\Notifications\NewTimesheet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTimesheetCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TimesheetCreated $event): void
    {
        //
        foreach(User::all() as $user) {
            $user->notify(new NewTimesheet($event->timesheet));
        }
    }
}
