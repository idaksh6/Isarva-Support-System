<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckSessionTimeout
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        $lastActivity = session('last_activity');
        $timeout = config('session.lifetime') * 60; // Convert to seconds

        if ($lastActivity && (time() - $lastActivity > $timeout)) {
            Auth::logout();
            return redirect()->route('login')->with('message', 'Your session has expired due to inactivity.');
        }

        session(['last_activity' => time()]);

        return $next($request);
    }
}