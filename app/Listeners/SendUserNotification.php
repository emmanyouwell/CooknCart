<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderCreated;
use App\Models\OrderItem;
use Mail;
use DB;
class SendUserNotification
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
    public function handle(OrderCreated $event)
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
        $customer = $event->order->fname . ' ' . $event->order->lname;
        // $items = OrderItem::where('order_id',$orderinfoID)->get();
        $items = OrderItem::select('order_items.quantity','ingredients.price','ingredients.name')->join('ingredients', 'ingredients.id', '=', 'order_items.ingredient_id')->join('orders','orders.id','=','order_items.order_id')->where('order_items.order_id',$orderinfoID)->get();
        
        Mail::send(
            'email.invoice',
            ['order_id' => $orderinfoID, 'track'=>$trackingNo, 'address' => $address,'city' => $city, 'pincode' => $pincode, 'customer'=>$customer, 'phone'=> $phone,'date' => $date, 'total' => $orderTotal, 'items' => $items],
            function($message) use ($email, $customer){
                $message->from('admin@test.com', 'Admin');
                $message->to($email,$customer);
                $message->subject("Thank you! {$customer}");
            }
        );
        // dd($orderinfo);
    }
}
