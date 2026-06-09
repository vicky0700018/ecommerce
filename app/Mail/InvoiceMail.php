<?php

namespace App\Mail;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class InvoiceMail extends Mailable
{
    public function __construct(
        public Order $order,
        public Invoice $invoice
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Invoice #{$this->invoice->invoice_number} - ShopSphere",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice',
            with: [
                'order' => $this->order,
                'invoice' => $this->invoice,
            ],
        );
    }
}
