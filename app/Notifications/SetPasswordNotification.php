<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        if($this->user->activated_at === null)
        {
            $link = url('password/reset', $this->token). '?email=' . urlencode($this->user->email);
            return (new MailMessage)->view(
                'emails.setPassword', ['link' => $link, 'user' => $this->user]
            )->subject('Passwort setzen');
        }
        $link = url('password/reset', $this->token) . '?email=' . urlencode($this->user->email);
        return (new MailMessage)->view(
            'emails.resetPassword', ['link' => $link, 'user' => $this->user]
        )->subject('Passwort zurücksetzen');
    }
}
