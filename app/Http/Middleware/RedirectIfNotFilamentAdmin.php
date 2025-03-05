<?php

namespace App\Http\Middleware;

use Filament\Facades\Filament;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Http\Request;

class RedirectIfNotFilamentAdmin extends Middleware
{
    /**
     * Handle an incoming request to Filament.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  array<string>  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
{
    $auth = Filament::auth();

    // 1) If not logged in => redirect to welcome (or '/')
    if (! $auth->check()) {
        return redirect('/');
    }

    // Use Filament's authentication guard
    $this->auth->shouldUse(Filament::getAuthGuard());
    $user = $auth->user();

    // 2) If the user is not a coordinator => redirect them to their home
    if ($user->role !== 'coordinator') {
        switch ($user->role) {
            case 'student':
                return redirect()->route('student.home');
            case 'company':
                return redirect()->route('company.home');
            default:
                return redirect('/');
        }
    }

    // If the user is coordinator, allow access
    return $next($request);
}

    /**
     * The default redirect if someone is unauthenticated
     * (not used in this example because we do a custom redirect above).
     */
    protected function redirectTo($request): ?string
    {
        // Could return a Filament login URL, but here we do custom logic above
        return Filament::getLoginUrl();
    }
}
