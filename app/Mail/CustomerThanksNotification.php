<?php

namespace App\Mail;

use App\Models\ContactInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerThanksNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly ContactInquiry $inquiry
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            // Asunto que verá el cliente en su bandeja de entrada
            subject: "Thank you for your enquiry - Case dei Nobili",
        );
    }

    public function content(): Content
    {
        return new Content(
            // Una vista diferente, con un mensaje de "Gracias por escribirnos"
            view: 'emails.customer-thanks',
        );
    }
}
