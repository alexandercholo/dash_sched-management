<?php
// app/Http/Controllers/ScheduleRequestController.php

namespace App\Http\Controllers;

use App\Models\ScheduleRequest;
use Illuminate\Http\Request;

class ScheduleRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'program' => 'required|string',
            'email' => 'required|email',
            'description' => 'nullable|string'
        ]);

        try {
            ScheduleRequest::create($validated);
            return response()->json(['message' => 'Schedule request created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating schedule request'], 500);
        }
    }
}