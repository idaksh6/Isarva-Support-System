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

    $now = Carbon::now();
    $lastActivity = session('last_activity');
    $sessionTimeout = env('SESSION_LIFETIME', 1) * 60;
    
    if ($lastActivity && $now->diffInSeconds($lastActivity) > $sessionTimeout) {
        Auth::logout();
        session()->flush();
        return redirect()->route('frontend.auth.login')
            ->with('error', 'Your session has expired due to inactivity.');
    }
    
    session(['last_activity' => $now]);
    return $next($request);
}
}