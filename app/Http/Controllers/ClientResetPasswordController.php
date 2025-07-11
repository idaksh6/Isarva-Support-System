<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ClientResetPasswordController extends Controller
{
    //
    
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.client-reset')->with(
            ['token' => $token, 'email_id' => $request->email ]
        );
    }

    public function reset(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'token' => 'required',
            'email_id' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::broker('clients')->reset(
            $request->only('email_id', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('client.login.form')->with('status', __($status))
            : back()->withErrors(['email_id' => [__($status)]]);
    }
}
