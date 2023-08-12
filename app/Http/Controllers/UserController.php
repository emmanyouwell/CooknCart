<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('status','asc')->get();
        return view('User.orders.index', compact('orders'));
    }

    public function view($id)
{
    $orders = Order::where('id', $id)->where('user_id', Auth::id())->first();
    return view('User.orders.view',compact('orders'));
}
public function cancelOrder($id)
{
    $order = Order::find($id);

    if ($order) {
        if ($order->status == '0') {
        
            $order->status = '3'; // 2 represents cancelled
            $order->save();

            return redirect()->back()->with('success', 'Order has been cancelled successfully.');
        } else {
            return redirect()->back()->with('error', 'Order can only be cancelled if it is pending.');
        }
    } else {
        return redirect()->back()->with('error', 'Invalid order ID.');
    }
}

}
