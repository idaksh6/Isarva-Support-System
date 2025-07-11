<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Events\User\UserLoggedIn;
use App\Rules\Captcha;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use App\Models\Backend\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;

/**
 * Class LoginController.
 */
class LoginController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(homeRoute());
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // protected function validateLogin(Request $request)
    // {
    //     $request->validate([
    //         $this->username() => ['required', 'max:255', 'string'],
    //         'password' => array_merge(['max:100'], PasswordRules::login()),
    //         'g-recaptcha-response' => ['required_if:captcha_status,true', new Captcha],
    //     ], [
    //         'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
    //     ]);
    // }


    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => [
                'required',
                'max:255',
                'string',
                'email',
                'exists:users,email' // Check if email exists in users table
            ],
            'password' => array_merge(['required', 'max:100'], PasswordRules::login()),
            'g-recaptcha-response' => ['required_if:captcha_status,true', new Captcha],
        ], [
            $this->username().'.exists' => 'The provided email has no access',
            'password.required' => 'The password field is required.',
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ]);
    }

    /**
     * Overidden for 2FA
     * https://github.com/DarkGhostHunter/Laraguard#protecting-the-login.
     *
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        try {
            return $this->guard()->attempt(
                $this->credentials($request),
                $request->filled('remember')
            );
        } catch (HttpResponseException $exception) {
            $this->incrementLoginAttempts($request);

            throw $exception;
        }
    }

    /**
     * The user has been authenticated.
     *
     * @param  Request  $request
     * @param $user
     *
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if (! $user->isActive()) {
            auth()->logout();

            return redirect()->route('frontend.auth.login')->withFlashDanger(__('Your account has been deactivated.'));
        }

        event(new UserLoggedIn($user));

        if (config('boilerplate.access.user.single_login')) {
            auth()->logoutOtherDevices($request->password);
        }
    }

    // protected function authenticated(Request $request, $user)
    // {
    //     // Initialize session tracking
    //      Cache::put(
    //     'user_active_'.$user->id,
    //     true,
    //     now()->addMinutes(config('session.lifetime') + 1)
    // );
    
    //     // Rest of your existing logic...
    //     if (! $user->isActive()) {
    //         auth()->logout();
    //         return redirect()->route('frontend.auth.login')->withFlashDanger(__('Your account has been deactivated.'));
    //     }

    //     event(new UserLoggedIn($user));

    //     if (config('boilerplate.access.user.single_login')) {
    //         auth()->logoutOtherDevices($request->password);
    //     }
    // }

    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => 'The provided email has no access.',
                ]);
        }

        if (!\Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    'password' => 'The provided password is incorrect.',
                ]);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => 'These credentials do not match our records.',
            ]);
    }


    // protected function authenticated(Request $request, $user)
    // {
    //     $request->session()->regenerate();
    // }
 

 
//    public function logout(Request $request)
//     {
//         if (Auth::check()) {
//             Cache::forget('user_active_'.Auth::id());
//         }
        
//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();
        
//         return redirect('/login');
//     }
        

}
