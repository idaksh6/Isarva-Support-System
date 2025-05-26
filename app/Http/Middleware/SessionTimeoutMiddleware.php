<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class SessionTimeoutMiddleware
{
     protected $timeout = 60; // 5 minutes = 300 seconds
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
       public function handle($request, Closure $next)
        {
            if (Auth::check()) {
                $timeout = 1800; // 60 seconds

                $lastActivity = Session::get('lastActivityTime');
                $currentTime = now()->timestamp;

                if ($lastActivity && ($currentTime - $lastActivity > $timeout)) {
                    Auth::logout();
                    Session::flush();
                    return redirect('/login')->with('message', 'You have been logged out due to inactivity.');
                }

                Session::put('lastActivityTime', $currentTime);
            }

            return $next($request);
        }
    }
