@component('mail::message')
# Password Reset Request

You requested a password reset for your client account at {{ config('app.name') }}.

Click the button below to reset your password:

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

This link expires in 60 minutes.

If you didn't request this, please ignore this email.  
**Do not share this link with anyone.**

<small style="color: #666;">
For security reasons, this email was sent to {{ $email }}.  
© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
</small>
@endcomponent