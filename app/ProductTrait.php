<?php

namespace App;

use App\Models\Product;
use App\Models\ReservedProducts;
use App\Models\Order;

trait ProductTrait
{

    public function reserveProduct($order_id,$product_id, $amount)
    {
        $reservedProduct = ReservedProducts::where('order_id', $order_id)->where('product_id', $product_id)->first();
        if ($reservedProduct) {
            $reservedProduct->amount = $amount;
            $reservedProduct->save();
        } else {
            ReservedProducts::create([
                'order_id' => $order_id,
                'product_id' => $product_id,
                'amount' => $amount
            ]);
        }
    }

    public function clearReservations($order_id)
    {
        ReservedProducts::where('order_id', $order_id)->delete();
    }

    public function updateProductStockAfterCompletedOrder(Order $order){
        foreach($order->details as $detail){
            $detail->product->stock -= $detail->amount;
            $detail->product->save();
          }
    }


    public function getAvailableStockOfProduct(Product $product)
    {
        $stock = $product->stock;
        if($product->reservations){
            foreach($product->reservations as $reservation){
                $stock -= $reservation->amount;
            }
        }
        return $stock;
    }

}
