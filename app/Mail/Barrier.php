<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Barrier extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;

    protected $desc;

    protected $url;


    /**
     * Create a new message instance.
     */
    public function __construct($email, $desc, $url)
    {
        $this->email = $email;
        $this->desc = $desc;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Es wurde eine Barriere gemeldet'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.barrier',
            with: [
                'email' => $this->email,
                'desc' => $this->desc,
                'url' => $this->url,
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
