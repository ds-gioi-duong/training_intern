<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'timesheet_id',
        'content',
        'time_spent',
    ];

    // Define the relationship with Timesheet
    public function timesheet()
    {
        return $this->belongsTo(Timesheet::class);
    }
}
