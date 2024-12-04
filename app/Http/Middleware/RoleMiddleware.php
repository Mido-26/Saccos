<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next, ...$roles): Response
{
    if (!in_array(session('role'), $roles)) {
        // Redirect to unauthorized if the user's role is not in the allowed roles
        return redirect()->route('unauthorized'); 
    }
    
    return $next($request);
}

}
