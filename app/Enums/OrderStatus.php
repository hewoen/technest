<?php
namespace App\Enums;
enum OrderStatus: string {
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case SHIPPED = 'shipped';
    case CANCELLED = 'cancelled';

    public function label(): string {
        return match ($this) {
            self::PENDING => __('ausstehend'),
            self::PROCESSING => __('in Bearbeitung'),
            self::SHIPPED => __('versendet'),
            self::CANCELLED => __('storniert')
        };
    }
}