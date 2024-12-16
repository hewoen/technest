<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StripePayment extends Model
{
    function order()
    {
        return $this->hasOne(Order::class,'id','order_id');
        // return $this->hasOne(Order::class);
    }
}
