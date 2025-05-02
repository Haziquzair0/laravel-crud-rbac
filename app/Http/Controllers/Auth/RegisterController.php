<?php
// filepath: d:\xampp\htdocs\laravel-crud\app\Http\Controllers\Auth\RegisterController.php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\RegisterRequest; // Import the RegisterRequest
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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
    $salt = Str::random(16); // Generate a random 16-character salt

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password . $salt), // Append the salt to the password
        'salt' => $salt,
        'nickname' => $request->nickname,
        'avatar' => $request->avatar,
        'phone_no' => $request->phone_no,
        'city' => $request->city,
    ]);

    \Illuminate\Support\Facades\Auth::login($user);

    return redirect($this->redirectTo)->with('success', 'Registration successful!');
    }
}