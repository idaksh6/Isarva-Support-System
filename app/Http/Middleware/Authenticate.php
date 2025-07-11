<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;


use Illuminate\Support\Facades\Auth;

/**
 * Class Authenticate.
 */
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('frontend.auth.login');
        }
    }



    //   protected function authenticate($request, array $guards)
    //     {
    //         if (Auth::check()) {
    //             $isClient = \DB::table('isar_clients')
    //                         ->where('user_id', Auth::id())
    //                         ->exists();
                            
    //             if ($isClient) {
    //                 return;
    //             }
    //         }

    //         parent::authenticate($request, $guards);
    //     }
}
