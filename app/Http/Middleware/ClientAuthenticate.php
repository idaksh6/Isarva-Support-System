<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if (!session()->has('client_id')) {
        //     return redirect()->route('client.login.form'); // Authenticate/Guard the client ticket details
        // }
    
        if (!Auth::guard('client')->check()) {
            return redirect()->route('client.login.form');
        }


        return $next($request);
    }
}
