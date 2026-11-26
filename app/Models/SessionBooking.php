<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionBooking extends Model
{
    protected $fillable = [
        'name',
        'email',
        'program',
        'timing',
        'message',
        'status',
    ];
}
