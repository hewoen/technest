<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerInformationRequest;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderHistory;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderReceivedMail;

class OrderController extends Controller
{
    public function customerInformation()
    {
        if (!session()->has('cart') || count(session()->get('cart')) === 0) {
            return redirect()->route('home');
        }
        return view('pages.order.customer-information-form');
    }

    public function orderOverview()
    {
        if (!session()->has('cart') || count(session()->get('cart')) === 0 || !session()->has('customerInformation')) {
            return redirect()->route('home');
        }
        $cart = [];
        foreach (session()->get('cart', []) as $product_id => $amount) {
            $cart[] = [
                "product" => Product::find($product_id),
                "amount" => $amount
            ];
        }
        $customerInformation = session()->get('customerInformation');
        
        return view('pages.order.order-overview', compact('cart', 'customerInformation'));
    }

    public function processCustomerInformation(CustomerInformationRequest $request)
    {        
        $customerInformation = $request->all();
        session()->put('customerInformation', $customerInformation);
        return redirect()->route('order.overview');
    }

    public function payment()
    {
        return view('pages.order.payment');
    }

    private function getTotalPrice(){
        $cart = session()->get('cart');
        $total = 0;
        foreach ($cart as $product_id => $amount) {
            $total += Product::find($product_id)->price * $amount;
        }
        $total += Product::find($product_id)->price * $amount;
        return $total;
    }

    public function processPayment(Request $request)
    {
        $paymentMethod = $request->payment_method;
        if(!in_array($paymentMethod, ['bank_transfer', 'stripe'])){
            show_notification('error', 'Ungültige Zahlungsmethode');
            return redirect()->route('home');   
        }

        $order = new Order();   

        $order->order_status = 'pending';
        $order->payment_status = 'pending';
        $order->payment_method = $paymentMethod;
        $order->delivery_address = json_encode(session()->get('customerInformation'));
        $order->total = $this->getTotalPrice();
        $order->save();

        

        foreach (session()->get('cart') as $product_id => $amount) {
            $orderDetails = new OrderDetails();
            $orderDetails->order_id = $order->id;
            $orderDetails->product_id = $product_id;
            $orderDetails->amount = $amount;
            $orderDetails->price_total = Product::find($product_id)->price * $amount;
            $orderDetails->save();
        }

        $orderHistory = new OrderHistory();
        $orderHistory->order_id = $order->id;
        $orderHistory->status = 'order placed';
        $orderHistory->save();

        session()->forget('cart');
        session()->forget('customerInformation');

        session()->put('order_id', $order->id);
        session()->put('payment_method', $paymentMethod);

        switch ($paymentMethod) {
            case "bank_transfer";
                return redirect()->route('order.confirmation');
            case 'stripe';

                break;
        }



    }


    public function confirmation()
    {
        if(!session()->has('order_id')){
            return redirect()->route('home');
        }
        $order = Order::find(session()->get('order_id'));
        $customerInformation = json_decode($order->delivery_address);
        Mail::to($customerInformation->email)->queue(new OrderReceivedMail($order));
        $order_id = session()->pull('order_id');
        $paymentMethod = session()->pull('payment_method');
        return view('pages.order.confirmation', compact('order_id', 'paymentMethod'));
    }
}
