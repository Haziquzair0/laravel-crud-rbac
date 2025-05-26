<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // Ensure you have a Blade file at resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Custom login logic to handle salted passwords and rate limiting.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Rate limiting: Limit to 3 failed attempts
        $key = 'login-attempts:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->withErrors(['email' => 'Too many login attempts. Please try again later.']);
        }

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password matches
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user); // Log the user in
            RateLimiter::clear($key); // Clear rate limiter on successful login

            // Redirect based on user role
            $role = optional($user->role)->role_name; // Access the role_name from the relationship

        if ($role === 'Admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        } elseif ($role === 'User') {
            return redirect()->route('todo.index')->with('success', 'Welcome User!');
        } else {
            return redirect('/')->with('error', 'Role not assigned.');
        }
        }

        // Increment rate limiter on failed login
        RateLimiter::hit($key, 60); // 60-second decay for failed attempts

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    /**
     * Handle user logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page or home page
        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}