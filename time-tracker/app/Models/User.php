<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
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
    public function timesheets():HasMany
    {
        return $this->hasMany(Timesheet::class);
    }
}
