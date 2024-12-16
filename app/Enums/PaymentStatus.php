<?php
namespace App\Enums;
enum PaymentStatus: string {
    case PENDING = 'pending';
    case SHIPPED = 'shipped';
    case PAID = 'paid';
    case FAILED = 'failed';

    public function label(): string {
        return match ($this) {
            self::PENDING => __('aussthehend'),
            self::SHIPPED => __('versendet'),
            self::PAID => __('bezahlt'),
            self::FAILED => __('fehlgeschlagen')
        };
    }
}