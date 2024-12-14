<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\StripePayment;
use App\Models\OrderHistory;
use Illuminate\Http\Request;
use App\Mail\PaymentReceivedMail;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller
{


    function createCheckoutSession()
    {

      $cart = session()->get('cart');

      if(count($cart)==0)
      {
        abort(404);
      }

      $lineItems = [];
      foreach ($cart as $product_id => $amount) {
          $product = Product::find($product_id);
          $lineItems[] = [
            'price_data' => [
              'currency' => 'eur',
              'product_data' => [
                'name' => $product->name,
              ],
              'unit_amount' => $product->price*100,
            ],
            'quantity' => $amount,
          ];
      } 

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_PRIVATE_KEY')
        );


        $checkout_session = $stripe->checkout->sessions->create([
          'line_items' => $lineItems,
          'mode' => 'payment',
          'ui_mode' => 'embedded',
          'return_url' => str_replace("CHECKOUT_SESSION_ID","{CHECKOUT_SESSION_ID}",route('stripe.return', 'CHECKOUT_SESSION_ID'))
        ]);

        $stripe_payment = StripePayment::where('order_id', session()->get('order_id'));
        if($stripe_payment!=null){
          $stripe_payment->delete();
        }
                
        $stripe_payment = new StripePayment();
        $stripe_payment->stripe_session_id = $checkout_session->id;
        $stripe_payment->order_id = session()->get('order_id');
        $stripe_payment->save();
        return response()->json(array('clientSecret' => $checkout_session->client_secret));
    }

    function paymentReturn($session_id){
     

    
      $stripe = new \Stripe\StripeClient(
        env('STRIPE_PRIVATE_KEY')
    );
      $session = $stripe->checkout->sessions->retrieve($session_id);
      $payment_status = $session->payment_status;
      $amount_total = $session->amount_total;
      
      $stripe_payment = StripePayment::where('stripe_session_id', $session_id)->first();
      
      if($stripe_payment==null and $session!=null or $stripe_payment->order->payment_status!="pending"){
        $stripe_payment = new StripePayment();
        $stripe_payment->stripe_session_id = $session_id;
        $stripe_payment->payment_object = json_encode($session);
      }
      else{
        $stripe_payment->payment_object = json_encode($session);
      }

      if($stripe_payment==null or $payment_status != "paid" or $amount_total !=  $stripe_payment->order->total*100){
        $stripe_payment->order->payment_status = "failed";
        $stripe_payment->order->save();
        $stripe_payment->save();
        return view('pages.order.payment-error',["stripe_session_id" => $session_id]);
      }

      $stripe_payment->order->payment_status = "paid";
      $stripe_payment->order->order_status = "paid";
      $stripe_payment->order->save();
      $orderHistory = new OrderHistory();
      $orderHistory->order_id = $stripe_payment->order_id;
      $orderHistory->status = 'paid';
      $orderHistory->save();

      $customerInformation = json_decode($stripe_payment->order->delivery_address);
      Mail::to($customerInformation->email)->queue(new PaymentReceivedMail($stripe_payment->order));
      return redirect()->route('order.confirmation');
      
    }
}
