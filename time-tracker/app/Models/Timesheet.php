<?php

namespace App\Models;

use App\Events\TimesheetCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'difficulties',
        'next_day_plans',
    ];

    // Define the relationship with User
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with Task
    public function tasks():HasMany
    {
        return $this->hasMany(Task::class);
    }

    protected $dispatchesEvents = [
        'created' => TimesheetCreated::class,
    ];
}