<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'timesheet_id',
        'content',
        'start_time',
        'end_time'
    ];

    // Define the relationship with Timesheet
    public function timesheet():BelongsTo
    {
        return $this->belongsTo(Timesheet::class);
    }
}
