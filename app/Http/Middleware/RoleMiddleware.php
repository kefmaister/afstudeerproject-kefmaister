<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Ensure the user is authenticated.
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Check if the authenticated user's role is one of the allowed roles.
        $userRole = Auth::user()->role;
        if (!in_array($userRole, $roles)) {
            // Redirect based on user role
            switch ($userRole) {
                case 'student':
                    return redirect()->route('student.home');
                case 'coordinator':
                    return redirect()->route('coordinator.home');
                case 'company':
                    return redirect()->route('company.home');
                default:
                    abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }
}
