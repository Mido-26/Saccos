<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $role = session('role'); 
        $members = User::count();       
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

//     public function switchUser(Request $request)
// {
//     $user = Auth::user();

//     // Ensure the user can switch roles based on the policy
//     if ($request->role !== null) {
//         if ($user->can('switchRole', [$user, $request->role])) {
//             session(['role' => $request->role]);
//             $role = session('role');
//         } else {
//             abort(403, 'Unauthorized to switch roles.');
//         }
//     } else {
//         $role = session('role');
//     }

//     return view('dashboard.dashboard', compact('user', 'role'));
// }

}
