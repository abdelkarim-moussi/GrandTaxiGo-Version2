<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $qrcodePath;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $qrcodePath)
    {
        $this->data = $data;
        $this->qrcodePath = $qrcodePath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new-reservation',
            with: [
                'data' => $this->data,
                'qrcodeBase64'=>$this->qrcodePath
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
            return [
                Attachment::fromPath($this->qrcodePath)
                    ->as('qrcode.png')
                    ->withMime('image/png'),
            ];

    }
}
