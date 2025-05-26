<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Todo;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $users = User::with('role')->get(); // Load users with their roles
        return view('admin.dashboard', compact('users'));
    }

    /**
     * Display tasks for a specific user.
     */
    public function userTasks($id)
    {
        $user = User::with('todos', 'role')->findOrFail($id); // Load user with their tasks and role
        return view('admin.usertasks', compact('user'));
    }

    /**
     * Deactivate a user.
     */
    public function deactivateUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['active' => false]);

        return redirect()->route('admin.dashboard')->with('success', 'User deactivated successfully.');
    }

    /**
     * Show the form for editing permissions for a user.
     */
    public function editPermissions($id)
    {
        $user = User::findOrFail($id);
        $permissions = RolePermission::all(); // Fetch all available permissions
        return view('admin.edit-permissions', compact('user', 'permissions'));
    }

    /**
     * Update permissions for a user.
     */
    public function updatePermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate the incoming permissions
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:role_permissions,permission_id',
        ]);

        // Sync the user's permissions
        $user->role->permissions()->sync($request->permissions);

        return redirect()->route('admin.dashboard')->with('success', 'Permissions updated successfully.');
    }
}