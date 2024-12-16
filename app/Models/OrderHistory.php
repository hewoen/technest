<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\OrderStatus;

class OrderHistory extends Model
{
    public $casts = [
        'status' => OrderStatus::class,
    ];
}
