<?php

namespace App\Http\Controllers;

use App\Mail\OrderShippedMail;
use App\Mail\CancelOrderMail;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderHistory;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentReceivedMail;
use Faker\Provider\ar_EG\Payment;
use App\Enums\PaymentStatus;
use App\Enums\OrderStatus;


class OrderProcessingController extends Controller
{
    function index(){
        return redirect()->route('order-processing.open');
    }
   
    function showOrders($state="open"){
        switch($state){
            case 'open':
                $orders = Order::all();
                break;
            case 'closed':
                $orders = Order::onlyTrashed()->get();
                break;
        }
        return view('pages.admin.order-processing.index', compact('orders','state'));
    }

    function showOrdersOpen(){
        return $this->showOrders("open");
    }

    function showOrdersClosed(){
        return $this->showOrders("closed");
    }

    function showOrderDetails($id){
        $cart=[];
        $order = Order::withTrashed()->findOrFail($id);
        $orderDetails = $order->details;
        $orderHistory = OrderHistory::where('order_id', $id)->orderByDesc('created_at')->get();
        return view('pages.admin.order-processing.details', compact('orderHistory','order', 'orderDetails'));
    }

    private function alertMessageStatusDidntChange($status){
        show_notification('error', __('Der Status wurde nicht geändert, da er bereits auf ').$status.' '.__('gesetzt ist'));
        return redirect()->back();
    }

    function updateOrder(Request $request, $id){
        
        if(!in_array($request->action,['mark_as_paid','mark_as_shipped','cancel_order']) ){
            show_notification('error', __('Ungültige Aktion'));
            return redirect()->back();
        }

        $order = Order::withTrashed()->findOrFail($id);
        $customerInformation = json_decode($order->delivery_address);


        switch($request->action){
            case 'mark_as_paid':
                if($order->payment_status == PaymentStatus::PAID){
                    return $this->alertMessageStatusDidntChange(PaymentStatus::PAID->label());
                }
                $order->payment_status = PaymentStatus::PAID;
                $order->order_status = OrderStatus::PROCESSING;
                $historyStatus = $order->order_status;
                $order->save();
                $orderHistory = new OrderHistory();
                $orderHistory->order_id = $id;
                $orderHistory->status = $historyStatus;
                $orderHistory->save();
                Mail::to($customerInformation->email)->queue(new PaymentReceivedMail($order));
                break;
            case 'mark_as_shipped':
                if($order->order_status == OrderStatus::SHIPPED){
                    return $this->alertMessageStatusDidntChange(__('versendet'));
                }
                $order->order_status = OrderStatus::SHIPPED;
                $historyStatus =  $order->order_status;
                $order->save();
                $order->delete();
                $orderHistory = new OrderHistory();
                $orderHistory->order_id = $id;
                $orderHistory->status = $historyStatus;
                $orderHistory->save();
                Mail::to($customerInformation->email)->queue(new OrderShippedMail($order));
                break;
            case 'cancel_order':
                if($order->order_status == OrderStatus::CANCELLED){
                    return $this->alertMessageStatusDidntChange(OrderStatus::CANCELLED->label());
                }
                $order->order_status = OrderStatus::CANCELLED;
                $historyStatus =  $order->order_status;
                $order->save();
                $order->delete();
                $orderHistory = new OrderHistory();
                $orderHistory->order_id = $id;
                $orderHistory->status = $historyStatus;
                $orderHistory->save();
                Mail::to($customerInformation->email)->queue(new CancelOrderMail($order));
                break;
        }

        

     

        show_notification('success', __('Bestellung aktualisiert'));
        return redirect()->back();
        
    }

    function deleteOrder($id){
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->forceDelete();
        show_notification('success', __('Bestellung gelöscht'));
        return redirect()->back();
    }
}
