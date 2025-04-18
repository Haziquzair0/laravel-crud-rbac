<?php
// filepath: d:\xampp\htdocs\laravel-crud\app\Http\Controllers\Auth\RegisterController.php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\RegisterRequest; // Import the RegisterRequest
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/todo';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Http\Requests\RegisterRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'nickname' => $request->nickname, // Save the nickname
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_no' => $request->phone_no, // Save the phone number
            'city' => $request->city,         // Save the city
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $user->save(); // Save the avatar path after user creation
        }

        // Log the user in
   
        // Redirect to the desired location
        return redirect($this->redirectTo)->with('success', 'Registration successful!');
    }
}