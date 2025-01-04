<?php

namespace App\Mail;

use App\Models\appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DoctorMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public appointment $appointment)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Appointment',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.doctor',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
