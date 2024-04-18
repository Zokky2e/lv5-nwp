<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Fetch users with their associated roles
        $usersWithRoles = User::with('role')->get();

        return view('home', compact('usersWithRoles'));
    }

    public function updateRole(Request $request, $userId)
    {
        try {
            $role_id = intval($request->role_id);
            if ($role_id == 0) {
                $role_id = null;
            }
            User::where('id', $userId)->update(['role_id' => $role_id]);
            
            return redirect()->back()->with('success', 'User role updated successfully.');
        } catch (\Exception $e) {
            dd($e);
        }
    }

}

