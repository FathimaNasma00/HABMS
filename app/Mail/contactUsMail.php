<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class contactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $name, public $email, public $message)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Us',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-us',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
