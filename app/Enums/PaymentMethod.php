<?php
namespace App\Enums;

enum PaymentMethod: string {
    case BANK_TRANSFER = 'bank_transfer';
    case STRIPE = 'stripe';

    public function label(): string {
        return match ($this) {
            self::BANK_TRANSFER => __('Banküberweisung'),
            self::STRIPE => __('Stripe')
        };
    }
    
}