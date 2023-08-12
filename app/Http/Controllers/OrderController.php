<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('status', '0')->get();
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
        return redirect('orders')->with('status', "Order Updated Sucessfully");
    }
    public function orderhistory()
    {
        $orders = Order::where('status','!=','0')->orderBy('status','asc')->get();
        return view('Admin.orders.history', compact('orders'));
    }
}
