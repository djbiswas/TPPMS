<?php

namespace App\Mail;

use App\Models\TenantRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestReceivedConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public TenantRequest $tenantRequest) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'We received your request',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.request-received',
        );
    }
}
