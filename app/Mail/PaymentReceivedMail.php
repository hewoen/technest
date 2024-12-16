<?php

namespace App\Mail;

use App\Enums\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class PaymentReceivedMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $customerName;
    public $paidDate;

    /**
     * Create a new message instance.
     */
    public function __construct(public Order $order)
    {
        $customerInformation = json_decode($order->delivery_address);
        $lastPaidHistory = $order->history()->where('status', OrderStatus::PROCESSING)->orderBy('created_at', 'desc')->first();
        $this->paidDate = $lastPaidHistory->created_at;
        $this->customerName = $customerInformation->prename . ' ' . $customerInformation->lastname;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Technest - Bestätigung Ihrer Zahlung'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.payment-received',
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
