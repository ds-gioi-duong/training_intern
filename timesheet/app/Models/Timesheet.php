<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}