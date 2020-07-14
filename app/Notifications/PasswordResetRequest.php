<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetRequest extends Notification
{
    use Queueable;
    protected $token;
    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this ->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $url = url('/api/password/find/'.$this->token);
        $passwordToken = $this->token;
        return (new MailMessage)
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->line('If you did not request a password reset, no further action is required.')
            ->line("Copy the following token string to reset password.")
            ->line($passwordToken);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
