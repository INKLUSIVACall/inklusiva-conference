<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationPendingNotificationForTempUser extends Notification
{
    use Queueable;

    public $tempUser;

    public $meetingLink;

    /**
     * Create a new notification instance.
     */
    public function __construct($tempUser, $meeting)
    {
        $this->tempUser = $tempUser;
        $this->meetingLink = route('lag.instantmeeting.showMeeting', ['meetinguuid' => $meeting->uuid]);
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
        if($this->tempUser->email_verified_at === null)
        {
            return (new MailMessage)->view( 'emails.registrationPendingForTempUser', ['tempUser' => $this->tempUser, 'meetingLink' => $this->meetingLink])->subject('Zugangsdaten für das Meeting');
        }
    }
}
