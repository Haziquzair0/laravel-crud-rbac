<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

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

    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath;
    }

    $user->nickname = $request->nickname;
    $user->email = $request->email;
    $user->phone_no = $request->phone_no;
    $user->city = $request->city;

    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    // Save the updated user data
    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
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