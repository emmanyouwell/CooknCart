<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Events\OrderUpdated;
use App\Events\OrderCancelled;

use Auth;
class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('status', '0')->orderBy('created_at','desc')->get();
        return view('Admin.orders.index', compact('orders'));
    }
    public function view($id)
    {
        $orders = Order::where('id', $id)->first();
        return view('Admin.orders.view', compact('orders'));
    }
    public function updateorder(Request $request, $id)
    {
        $orders = Order::find($id);
        $orders->status = $request->input('order_status');
        $orders->update();
        OrderUpdated::dispatch($orders, $orders->email);
        
        
        return redirect('orders')->with('status', "Order Updated Sucessfully");
    }
    public function orderhistory()
    {
        $orders = Order::where('status','!=','0')->orderBy('status','asc')->get();
        return view('Admin.orders.history', compact('orders'));
    }
}
