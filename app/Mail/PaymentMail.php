<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $transaction_detail, $status, $customer_detail, $item_details;

    public function __construct($transaction_detail, $status, $customer_detail, $item_details)
    {
        $this->transaction_detail = $transaction_detail;
        $this->status = $status;
        $this->customer_detail = $customer_detail;
        $this->item_details = $item_details;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->status == 'waiting' ? 'Waiting For Payment' : 'Payment Successful',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'components.mail.payment',
            with: [
                'transaction_detail' => $this->transaction_detail,
                'status' => $this->status,
                'customer_detail' => $this->customer_detail,
                'item_details' => $this->item_details
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
        return [];
    }
}
