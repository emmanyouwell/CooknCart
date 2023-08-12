@extends('layouts.app')
@section('title')
    Order View
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Order View
                            @if ($orders->status != '0')
                            <a href="{{ url('order-history') }}" class="btn btn-warning text-white float-end">Back</a>
                            @else
                            <a href="{{ url('orders') }}" class="btn btn-warning text-white float-end">Back</a>
                            @endif
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <h4>Shipping Details</h4>
                                <hr>
                                <label for="">First Name</label>
                                <div class="border ">{{ $orders->fname }}</div>
                                <label for="">Last Name</label>
                                <div class="border ">{{ $orders->lname }}</div>
                                <label for="">Email</label>
                                <div class="border ">{{ $orders->email }}</div>
                                <label for="">Phone no.</label>
                                <div class="border ">{{ $orders->phone }}</div>
                                <label for="">Shipping Address</label>
                                <div class="border ">
                                    {{ $orders->address }},
                                    {{ $orders->city }},
                                </div>
                                <label for="">Zip Code</label>
                                <div class="border">{{ $orders->pincode }}</div>
                            </div>
                            <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderitems as $item)
                                            <tr>
                                                <td>{{ $item->ingredient->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $item->ingredient->image) }}"
                                                        width="50px" alt="Product Image">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4>Grand Total: ₱ <span class="float-center">{{ $orders->total_price }}</span> </h4>
                                @if ($orders->status == '3')
                                <h3 class="text-danger">Cancelled</h3>
                                
                                @elseif($orders->status == '2')
                                <h3 class="text-success">Completed</h3>
                                @else
                                <div class="mt-5 px-2">
                                    <label for="">Order Status</label>
                                    <form action="{{ url('update-order/'.$orders->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <select class="form-select" name="order_status" aria-label="Default select example">
                                        <option {{ $orders->status == '0' ? 'selected' : '' }} value="0">Pending
                                        </option>
                                        <option {{ $orders->status == '1' ? 'selected' : '' }} value="1">Processing
                                        </option>
                                        <option {{ $orders->status == '2' ? 'selected' : '' }} value="2">Completed
                                        </option>
                                        <option {{ $orders->status == '3' ? 'selected' : '' }} value="3">Cancelled
                                        </option>
                                        
                                    </select>
                                   
                                    <button type="submit" class="btn btn-primary float-end  mt-3">Update</button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
