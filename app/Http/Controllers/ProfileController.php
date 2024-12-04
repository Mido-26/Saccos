<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    
    public function index(){

        $user = Auth::user();
        // dd($user);
        return view('profile.profile', compact('user'));
    }

    public function updateProfile(Request $request, User $user){
    // Validate the request data (you can add more validation as needed)
    $request->validate([
        'first_name' => 'required|string|min:2|max:50',
        'last_name' => 'required|string|min:2|max:50',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone_number' => 'required|string|min:10|max:15',
        'date_of_birth' => ['required','date','before:' . now()->subYears(18)->format('Y-m-d')],
        'Address' => 'required|string',
    ],  [
        'date_of_birth.before' => 'You must be at least 18 years old.',
    ]);

    // Update the user information
    $user->update($request->only('first_name', 'last_name', 'email', 'phone_number', 'Date_OF_Birth', 'Address'));

    // Redirect back with a success message
    return redirect()->back()->with('success1','Profile updated successfully!' ,);
    }   


    public function updatePassword(Request $request, User $user)
{
    // Validate the request data
    $request->validate([
        'CurrentPassword' => 'required',
        'NewPassword' => 'required|min:8|confirmed',  // 'confirmed' expects a matching 'NewPassword_confirmation' field
    ]);

    // Check if the current password matches the user's password
    if (!Hash::check($request->CurrentPassword, $user->password)) {
        return back()->withErrors(['CurrentPassword' => 'The current password is incorrect.']);
    }

    // Update the password
    $user->update([
        'password' => Hash::make($request->NewPassword),
    ]);

    return back()->with('success2', 'Password updated successfully!');
}
}
