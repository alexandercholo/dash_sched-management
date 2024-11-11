<?php
// app/Models/ScheduleRequest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleRequest extends Model
{
    protected $fillable = [
        'event_title',
        'event_date',
        'location',
        'start_time',
        'end_time',
        'program',
        'email',
        'description'
    ];
}