<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Display a list of all users.
     */
    public function users()
    {
        $users = User::with('role')->get();
        return view('admin.users', compact('users'));
    }

    /**
     * Display a list of all roles.
     */
    public function roles()
    {
        $roles = UserRole::all();
        return view('admin.roles', compact('roles'));
    }
}