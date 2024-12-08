<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:15|unique:users,phone_number',
            'password' => 'password',
            'Date_OF_Birth' => ['required','date','before:' . now()->subYears(18)->format('Y-m-d')],
            'Address' => 'required|string',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'Date_OF_Birth' => $request->Date_OF_Birth,
            'Address' => $request->Address,
            'password' => Hash::make($request->password),
            'status' => 'active',
        ]);

        // Auth::login($user);

        return redirect()->route('users.create')->with('success', 'User registered successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show' , compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // dd($request->route('todo'));
        $todo = $request->route('todo');
    
        if ($todo === 'status') {
            $user->status = $user->status === 'active' ? 'inactive' : 'active';
            $user->save();
            return redirect()->route('users.edit', $user->id)->with('success', 'Account status changed successfully!');
        }
    
        if ($todo === 'reset') {
            $user->password = Hash::make('password');
            $user->save();
            return redirect()->route('users.edit', $user->id)->with('success', 'Password reset successfully!');
        }
    
        // Standard update logic for other fields
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'Date_OF_Birth' => 'required|date',
            'Address' => 'required|string',
        ]);
    
        $user->update($data);
    
        return redirect()->route('users.edit', $user->id)->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
