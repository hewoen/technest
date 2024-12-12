<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
