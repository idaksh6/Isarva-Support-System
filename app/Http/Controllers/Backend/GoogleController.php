<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Backend\Employee;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    /**
     * Redirect to Google login page.
     */
    public function googleLogin()
    {
          // dd(config('services.google')); // Should show client_id, secret, and redirect
         // dd('hi');

        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            dd("Error in redirecting: " . $e->getMessage());
        }

        // try {
        //     dd(config('services.google')); // Should show your client_id and secret
        //     return Socialite::driver('google')->redirect();
        // } catch (\Exception $e) {
        //     dd($e->getMessage());
        // }

       
        // return Socialite::driver('google')->redirect();
    }
    

    /**
     * Handle Google callback.
     */
    // public function handleGoogleCallback()
    // {
    //     try {
    //         // Get Google user details
    //         $googleUser = Socialite::driver('google')->user();

    //         // Check if email exists in the Employee table
    //         $employee = Employee::where('email_id', $googleUser->getEmail())->first();

    //         if ($employee) {
    //             // Log in the user
    //             Auth::login($employee);

    //             // Redirect to admin dashboard
    //             return redirect()->route('admin.dashboard');
    //         } else {
    //             return redirect()->route('auth.google')->with('error', 'No access to this account.');
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->route('auth.google')->with('error', 'Something went wrong. Please try again.');
    //     }
    // }

    public function handleGoogleCallback()
        {
            try {
                // Get Google user details
                $googleUser = Socialite::driver('google')->user();

                // Check if email exists in the Employee table
                $employee = Employee::where('email_id', $googleUser->getEmail())->first();

                if (!$employee) {
                    return redirect()->route('auth.google')->with('error', 'No access to this account.');
                }

                //  Make sure password is set to null (prevents auth errors)
                $employee->password = null;
                $employee->save();

                //  Log in the user
                Auth::login($employee);

                //  Set session manually (ensures persistence)
                session(['employee_id' => $employee->id]);

                // Redirect to admin dashboard
                return redirect()->route('admin.dashboard');
            } catch (\Exception $e) {
                return redirect()->route('auth.google')->with('error', 'Something went wrong. Please try again.');
            }
        }

}

