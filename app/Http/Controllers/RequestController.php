<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    /**
     * Display a listing of the requests.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = Request::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('requests.index', compact('requests'));
    }

    /**
     * Store a newly created request in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HttpRequest $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:schedule,announcement',
            'priority' => 'required|in:low,medium,high',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create the request
            $newRequest = Request::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'priority' => $request->priority,
                'status' => 'pending'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Request created successfully',
                'request' => $newRequest
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while creating the request'
            ], 500);
        }
    }

    /**
     * Display the specified request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = Request::findOrFail($id);
        
        // Check if the user owns this request
        if ($request->user_id !== Auth::id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ], 403);
        }

        return view('requests.show', compact('request'));
    }

    /**
     * Update the specified request in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HttpRequest $request, $id)
    {
        $existingRequest = Request::findOrFail($id);

        // Check if the user owns this request
        if ($existingRequest->user_id !== Auth::id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'type' => 'sometimes|required|in:schedule,announcement',
            'priority' => 'sometimes|required|in:low,medium,high',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $existingRequest->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Request updated successfully',
                'request' => $existingRequest
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the request'
            ], 500);
        }
    }

    /**
     * Remove the specified request from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = Request::findOrFail($id);

        // Check if the user owns this request
        if ($request->user_id !== Auth::id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ], 403);
        }

        try {
            $request->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Request deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while deleting the request'
            ], 500);
        }
    }
}