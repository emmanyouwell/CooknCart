<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartitems = Cart::where('user_id', Auth::id())->get();
        foreach($old_cartitems as $item)
        {
            if(!Ingredient::where('id', $item->ingredient_id)->where('quantity','>=',$item->ingredient_quantity)->exists())
            {
                $removeItem = Cart::where('user_id',Auth::id())->where('ingredient_id', $item->ingredient_id)->first();
                $removeItem->delete();

            }
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('checkout', compact('cartitems'));
    }

//Place order===================================================
    public function placeorder(Request $request)
{
    $order = new Order();
    $order->user_id= Auth::id();
    $order->fname = $request->input('fname');
    $order->lname = $request->input('lname');
    $order->email = $request->input('email');
    $order->phone = $request->input('phone');
    $order->address = $request->input('address');
    $order->city = $request->input('city');
    $order->MOP = $request->MOP;
    $order->pincode = $request->input('pincode');
    if ($request->MOP == 1){
        $order->status = 0;
    }
    else if ($request->MOP == 2 || $request->MOP == 3){
        $order->status = 1;
    }
    //Calculate total price
    $total = 0;
    $cartitems = Cart::where('user_id', Auth::id())->get();
    foreach($cartitems as $item)
    {
        $total += $item->ingredient->price * $item->ingredient_quantity;
    }

    $order -> total_price = $total;

    $order->tracking_no = 'Cookncart' . rand(1111, 9999);
    $order->save();

    foreach ($cartitems as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'ingredient_id' => $item->ingredient_id,
            'quantity' => $item->ingredient_quantity,
            'price' => $item->ingredient->price,
        ]);
        $ingredient = Ingredient::where('id', $item->ingredient_id)->first();
        $ingredient->quantity = $ingredient->quantity - $item->ingredient_quantity;
        $ingredient->update();
    }

    if (Auth::user()->address == NULL) {
        $user = User::where('id', Auth::id())->first();
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->city = $request->input('city');
            $user->pincode = $request->input('pincode');
            $user->update();
    }
    Cart::where('user_id', Auth::id())->delete();
    
    OrderCreated::dispatch($order, Auth::user()->email);
    return redirect('/')->with('status', "Order Placed Successfully");
}
}
