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
use Faker\Provider\ar_EG\Payment;
use App\Enums\PaymentMethod;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;

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
        return $total;
    }


    public function processPayment(Request $request)
    {
        $paymentMethod = $request->payment_method;
        if(!PaymentMethod::tryFrom($paymentMethod)){
            show_notification('error', 'Ungültige Zahlungsmethode');
            return redirect()->route('home');   
        }

        $order = new Order();   

        $order->order_status = OrderStatus::PENDING;
        $order->payment_status = PaymentStatus::PENDING;
        $order->payment_method = PaymentMethod::tryFrom($paymentMethod);
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
        $orderHistory->status = OrderStatus::PENDING;
        $orderHistory->save();



        session()->put('order_id', $order->id);
        session()->put('payment_method', $paymentMethod);


        switch ($paymentMethod) {
            case "bank_transfer";
                return redirect()->route('order.confirmation');
            case 'stripe';
                return view('pages.order.payment-stripe');
                break;
        }



    }


    public function confirmation()
    {
        if(!session()->has('order_id')){
            return redirect()->route('home');
        }

        session()->forget('customerInformation');
        session()->forget('cart');

        $order_id = session()->pull('order_id');
        $order = Order::find($order_id);
        $paymentMethod = session()->pull('payment_method');
        $customerInformation = json_decode($order->delivery_address);
        Mail::to($customerInformation->email)->queue(new OrderReceivedMail($order));
        return view('pages.order.confirmation', compact('order_id', 'paymentMethod'));
    }
}
