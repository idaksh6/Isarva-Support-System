<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;
class ClientResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->subject('Reset Password Notification')
    //         ->line('You requested a password reset for your client account.')
    //         ->action('Reset Password', url('client/password/reset', $this->token))
    //         ->line('This link expires in 60 minutes.');
    // }
    public function toMail($notifiable)
    {
        // dd($notifiable->email_id);
    //     return (new MailMessage)
    //         ->subject('Reset Password Notification')
    //         ->line('You requested a password reset for your client account.')
    //         ->action('Reset Password', route('client.password.reset', [
    //             'token' => $this->token,
    //             'email' => $notifiable->email_id // Pass email as query parameter
    //         ]))
    //         ->line('This link expires in 60 minutes.');
    //  }



         \Log::info('Sending password reset', [
        'to' => $notifiable->email_id,
        'token' => $this->token
        ]);

        $url = route('client.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->email_id
        ]);

        \Log::info('Reset URL: ' . $url);

        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->line('You requested a password reset for your client account.')
            ->action('Reset Password', $url)
            ->line('This link expires in 60 minutes.');
        }

    
    

}