<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $role = session('role');        
        return view('dashboard.dashboard', compact('user', 'role'));
    }

    public function switchUser(Request $request){
        $user = Auth::user();
        // dd($request->all());
        if($request->role !== null){
            session(['role' => $request->role]);
            $role = session('role');
        }else{
            $role = session('role');
        }
        

        return view('dashboard.dashboard', compact('user', 'role'));
        // return view('dashboard.reset');
    }
}
