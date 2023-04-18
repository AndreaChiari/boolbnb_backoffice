<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MessageSentMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Message $message;

    /**
     * Create a new message instance.
     */
    public function __construct($_message)
    {
        $this->message = $_message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'BoolBnB - Nuovo messaggio ricevuto da ' . $this->message->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $message = $this->message;
        $url =  'http://127.0.0.1:8000/admin/messages/' . $message->id;

        return new Content(
            markdown: 'admin.mails.messages.sent',
            with: compact('message', 'url')
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
