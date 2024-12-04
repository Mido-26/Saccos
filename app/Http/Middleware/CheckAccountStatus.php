<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Ensure the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the user's status is 'inactive'
            if ($user->status === 'inactive') {
                // Redirect to a custom inactive account page
                return redirect()->route('inactive');
            }
        }

        return $next($request);
    }
}
