<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EndScreenFeedback extends Mailable
{
    use Queueable, SerializesModels;

    protected $meeting;

    protected $roleName;

    protected $rating;

    protected $messageText;

    /**
     * Create a new message instance.
     */
    public function __construct($meeting, $roleName, $rating, $message)
    {
        $this->meeting = $meeting;
        $this->roleName = $roleName;
        $this->rating = $rating;
        $this->messageText = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ein Meeting wurde bewertet - ' . $this->meeting->name_display,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.endscreen',
            with: [
                'meeting' => $this->meeting,
                'roleName' => $this->roleName,
                'rating' => $this->rating,
                'messageText' => $this->messageText,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
