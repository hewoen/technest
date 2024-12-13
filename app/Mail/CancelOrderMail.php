<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class CancelOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerName;
    public $cancellDate;

    /**
     * Create a new message instance.
     */
    public function __construct(public Order $order)
    {
        $customerInformation = json_decode($order->delivery_address);
        $lastCancelledHistory = $order->history()->where('status', 'cancelled')->orderBy('created_at', 'desc')->first();
        $this->cancellDate = $lastCancelledHistory->created_at;
        $this->customerName = $customerInformation->prename . ' ' . $customerInformation->lastname;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Technest - Stornierung Ihrer Bestellung',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.order-cancelled',
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
