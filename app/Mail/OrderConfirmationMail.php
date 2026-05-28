<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public \App\Models\Order $order, public string $items)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Order Confirmation #{$this->order->id}",
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'emails.order_confirmation',
            with: [
                'order' => $this->order,
                'items' => $this->items,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
