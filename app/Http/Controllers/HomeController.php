<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch the currently logged-in user
        $user = Auth::user();

        // Check if the user is authenticated
        if ($user) {
            // Load the associated role
            $user->load('role');

            $nonAdminUsers = [];
            if ($user->role->ime_role === 'admin') {
                $nonAdminUsers = User::where(function ($query) {
                        $query->where('role_id', '!=', '1')
                        ->orWhereNull('role_id');
                    })
                ->get()
                ->load('role');
                $showRoleDropdown = [];
                return view('home', compact('user', 'nonAdminUsers', 'showRoleDropdown'));
            }
            else if ($user->role_id === 3) {
                $availableTasks = Task::whereDoesntHave('users', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->get();
                $assignedTasks = Task::whereHas('users', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->get();
                return view('home', compact('user', 'availableTasks', 'assignedTasks'));
            }
            return view('home', compact('user'));
        }
        else {
            return redirect()->route('login');
        }
    }

    public function switch($locale)
    {
        try {
            if (! in_array($locale, ['en', 'hr'])) {
                session(['language' => 'en']);
            }
        
            session(['language' => $locale]);
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
