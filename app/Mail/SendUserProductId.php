<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendUserProductId extends Mailable
{
    use Queueable, SerializesModels;

    
    public int $productId;
    public string $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($productId, $email)
    {
        $this->productId = $productId;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cashback Product ID',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'layouts.mail.sendUserProductId',
        );
    }

    public function build()
    {
        return $this->with([
            'productId' => $this->productId,
        ])
            ->to($this->email);
    }
}
