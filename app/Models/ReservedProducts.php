<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ReservedProducts extends Model
{
    protected $fillable = ['order_id', 'product_id', 'amount'];
    
    protected static function booted()
    {
        $reservationTime = env('RESERVATION_TIME', 15);
        DB::table('reserved_products')->where('updated_at', '<', now()->subMinutes($reservationTime))->delete();  
    }
    
}
