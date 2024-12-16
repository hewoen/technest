<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\PaymentMethod;


class Order extends Model
{
    use SoftDeletes;

    function details(){
        return $this->hasMany(OrderDetails::class);
    }

    function history(){
        return $this->hasMany(OrderHistory::class);
    }

    public $casts = [
        'order_status' => OrderStatus::class,
        'payment_status' => PaymentStatus::class,
        'payment_method' => PaymentMethod::class,
    ];


}
