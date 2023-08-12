<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderUpdated;
use App\Models\OrderItem;
use Mail;
class SendUpdateNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderUpdated $event)
    {
        $orderinfoID = $event->order->id;
        $trackingNo = $event->order->tracking_no;
        $address = $event->order->address;
        $city = $event->order->city;
        $pincode = $event->order->pincode;
        $email = $event->email;
        $phone = $event->order->phone;
        $date = $event->order->created_at;
        $orderTotal = $event->order->total_price;
        if ($event->order->status == '0'){
            $status = "Pending";
        }
        else if ($event->order->status == '1'){
            $status = "Processing";
        }
        else if ($event->order->status == '2'){
            $status = "Completed";
        }
        else{
            $status = "Cancelled";
        }
        
        $customer = $event->order->fname . ' ' . $event->order->lname;
        // $items = OrderItem::where('order_id',$orderinfoID)->get();
        $items = OrderItem::select('order_items.quantity','ingredients.price','ingredients.name')->join('ingredients', 'ingredients.id', '=', 'order_items.ingredient_id')->join('orders','orders.id','=','order_items.order_id')->where('order_items.order_id',$orderinfoID)->get();
        
        Mail::send(
            'email.invoice',
            ['order_id' => $orderinfoID, 'track'=>$trackingNo, 'address' => $address,'city' => $city, 'pincode' => $pincode, 'customer'=>$customer, 'phone'=> $phone,'date' => $date, 'total' => $orderTotal, 'items' => $items, 'status' => $status],
            function($message) use ($email, $customer){
                $message->from('admin@test.com', 'Admin');
                $message->to($email,$customer);
                $message->subject("Order Status Update");
            }
        );
    }
}
