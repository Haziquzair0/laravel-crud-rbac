<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class TwoFactorAuthController extends Controller
{
    public function sendCode(Request $request)
    {
        $user = Auth::user();

        // Generate a random 6-digit code
        $code = random_int(100000, 999999);

        // Store the code in the session
        session(['2fa_code' => $code]);

        // Send the code via email
        Mail::to($user->email)->send(new \App\Mail\TwoFactorCodeMail($code));

        return back()->with('success', 'A verification code has been sent to your email.');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        // Check if the code matches
        if ($request->code == session('2fa_code')) {
            session()->forget('2fa_code'); // Clear the code from the session
            return redirect()->intended('/dashboard')->with('success', 'Two-factor authentication successful.');
        }

        return back()->withErrors(['code' => 'The verification code is incorrect.']);
    }
}