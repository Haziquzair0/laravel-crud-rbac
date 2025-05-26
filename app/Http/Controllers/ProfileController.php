<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nickname' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone_no' => 'nullable|string|max:15',
            'city' => 'nullable|string|max:255',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete the old avatar if it exists
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }

            // Store the new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Update user details
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->city = $request->city;

        // Update password if provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Save the updated user data
        $user->save();

        // Redirect based on user role
        $role = optional($user->role)->role_name;

        if ($role === 'Admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully.');
        }

        return redirect()->route('todo.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy()
    {
        $user = Auth::user();

        // Delete the user's avatar if it exists
        if ($user->avatar) {
            Storage::delete('public/' . $user->avatar);
        }

        // Delete the user account
        $user->delete();

        // Log the user out
        Auth::logout();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}