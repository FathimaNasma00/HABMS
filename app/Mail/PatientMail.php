<?php

namespace App\Mail;

use App\Models\appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PatientMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public appointment $appointment)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Confirmation',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.patient',
            with: [
                'appointment' => $this->appointment,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
