<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start',
        'end',
        'type',
        'progress',
        'timesheet_id',
        'dependencies',
        'priority',
        'isDisabled',
        'styles',
        'hideChildren',
    ];

    // Define the relationship with Timesheet
    public function timesheet():BelongsTo
    {
        return $this->belongsTo(Timesheet::class);
    }
}