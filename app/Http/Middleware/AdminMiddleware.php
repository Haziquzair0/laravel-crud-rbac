<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRole;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Retrieve the role of the authenticated user
        $role = UserRole::where('user_id', Auth::id())->first();

        // If no role is assigned, redirect to the home page with an error
        if (!$role) {
            return redirect('/')->with('error', 'No role assigned to this user.');
        }

        // If the role is not 'Admin', redirect to the home page with an error
        if ($role->role_name !== 'Admin') {
            return redirect('/')->with('error', 'Unauthorized.');
        }

        // Allow the request to proceed
        return $next($request);
    }
}