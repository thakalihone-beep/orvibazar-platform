<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VendorApprovedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;

    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($vendor, $password)
    {
        $this->vendor = $vendor;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vendor Approved Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.vendor-approval',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
