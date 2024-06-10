<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'avatar',
        'description',
        'role',
    ];

    // Define the relationship with Timesheet
    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }
}
