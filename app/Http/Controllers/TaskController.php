<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role_id !== 2) {
            return redirect()->route('home')->with('failed', 'Not Allowed.');
        }

        // Validate the request data
        $validatedData = $request->validate([
            'naziv_rada' => 'required|string|max:255',
            'engleski_naziv_rada' => 'nullable|string|max:255',
            'zadatak_rada' => 'required|string',
            'tip_studija' => 'required|in:stručni,preddiplomski,diplomski',
        ]);
        $validatedData['user_id'] = Auth::id();
        // Create the task
        
        Task::create($validatedData);

        // Redirect to the home page with a success message
        return redirect()->route('home')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function assign(string $id) 
    {
        $user = Auth::user();
        $task = Task::findOrFail($id);
        if ($user->tasks->contains($task)) {
            $user->tasks()->detach($task);
            return redirect()->back()->with('success', 'Task removed from user.');
        } else {
            $user->tasks()->attach($task);
            return redirect()->back()->with('success', 'Task assigned successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
