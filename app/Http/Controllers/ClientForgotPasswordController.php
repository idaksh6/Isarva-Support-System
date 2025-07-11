<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Password;


use App\Mail\ClientPasswordResetMail;
use App\Models\Backend\Client;

class ClientForgotPasswordController extends Controller
{
    //
    
    public function showLinkRequestForm()
    {
        return view('auth.passwords.client-email');
    }

    // public function sendResetLinkEmail(Request $request)
    // {
    //     //    dd($request->all());
    //     $request->validate(['email_id' => 'required|email']);

    //     $status = Password::broker('clients')->sendResetLink(  // defined in config/auth.php: passwords
    //         $request->only('email_id')
    //     );

        

    //     if (Mail::failures()) {
    //         return back()->withErrors(['email_id' => 'Failed to send email. Please contact support.']);
    //     }

    //     return $status === Password::RESET_LINK_SENT   // This looks for a client (from the clients provider) using the entered email.
    //         ? back()->with(['status' => __($status)])
    //         : back()->withErrors(['email_id' => __($status)]); // If the email is found:Laravel generates a unique password reset token.It stores this token in the password_resets table.
           
    // }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email_id' => 'required|email']);
        
        // Find client
        $client = Client::where('email_id', $request->email_id)->first();
        
        if (!$client) {
            return back()->withErrors(['email_id' => 'We could not find a client with that email address.']);
        }
        
        // Create token
        $token = Password::broker('clients')->createToken($client);
        
        // Generate reset URL
        $url = route('client.password.reset', [
            'token' => $token,
            'email' => $client->email_id
        ]);
        
        try {
            // Send email directly
            Mail::to($client->email_id)->send(new ClientPasswordResetMail($url, $client->email_id));
            
            return back()->with('status', 'We have emailed your password reset link!');
        } catch (\Exception $e) {
            \Log::error('Password reset email failed: ' . $e->getMessage());
            return back()->withErrors(['email_id' => 'Failed to send email. Please try again later.']);
        }
    }
}
