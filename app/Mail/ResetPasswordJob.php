<?php

namespace App\Mail;

use App\Models\PasswordReset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordJob extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $url;
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         // subject: 'Moaz Reset Password Job',
    //     );
    // }

    public function build()
    {
        return $this->subject('Reset your password')
                    ->markdown('emails.reset-password');
                    // resources/views/emails/reset-password.blade.php
    }
    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         // view: '/resources/emails/verify_email.php'
    //     );
    // }

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
