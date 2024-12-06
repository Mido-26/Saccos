<?php

namespace App\Policies;

use session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the dashboard.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response
     */
    public function viewAdminDashboard(): bool
    {
        // $role = session('role');
        $role = session('role');
        // Check if the user has a valid role (adjust according to your application's roles)
        return  $role == 'admin' || $role == 'staff'; // Example roles
    }
    
    public function switchRole(): bool
    {
        $user = Auth::user();
        dd($user);
        // Only allow role switching for admins or managers
        return in_array($user->role, ['admin', 'staff']);
    }
}
