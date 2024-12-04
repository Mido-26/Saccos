<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.index');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            // dd(Auth::user());
            session(['role' => Auth::user()->role]);
            // dd(session('role'));
            return redirect()->route('dashboard');
        }

        // if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        //     return redirect()->route('dashboard');
        // }
        return redirect()->route('login')->with('error', 'Invalid email or password');
    }

    public function logout(Request $request){
        Auth::logout();  // Log out the user
        $request->session()->invalidate();  // Invalidate session data
        $request->session()->regenerateToken();  // Regenerate CSRF token
        return redirect()->route('login');  // Redirect to login page
    }
    

    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');  // Return the forgot password view
    }
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Send the reset link via email using Laravel's built-in Password broker
        $response = Password::sendResetLink(
            $request->only('email')
        );

        // Check if the reset link was sent successfully
        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('status', 'We have e-mailed your password reset link!');
        }

        // If there was an issue sending the reset link, show a failure message
        return back()->withErrors(['email' => 'Failed to send reset link. Please try again.']);
    }
}
