<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\ResetPassword as Notification;
use Illuminate\Notifications\Messages\MailMessage;


class ResetPassword extends Notification
{
    
    public function toMail($notifiable)
    {
        $url = url(config('app.client_url').'/password/reset/'.$this->token).
                    '?email='.urlencode($notifiable->email);
        return (new MailMessage)
                    ->line('you are receiving this email because we received a password reset request for your account')
                    ->action('Reset Password', $url)
                    ->line('If you did not request a password reset, no further action is required.');
    }

}
