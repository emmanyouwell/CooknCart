@extends('layouts.app')

@section('css')
    <style>
    </style>
@endsection
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
                            <a href="{{ url('user/my-orders') }}" class="btn btn-warning text-white float-end">Back</a>
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
                                <label for="">Mode of Payment</label>
                                <div class="border">
                                    @if ($orders->MOP == 1)
                                        COD
                                    @elseif ($orders->MOP == 2)
                                        gcash
                                    @elseif ($orders->MOP == 3)
                                        paypal
                                    @else
                                        Unknown
                                    @endif
                                </div>
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
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->price }}</td>
                                                {{-- <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top img-fluid"
                                alt="Ingredient Image"> --}}
                                                <td>
                                                    {{-- <img src="{{ asset('storage/' . $item->image) }}" width="50px"
                                                        alt="Product Image"> --}}
                                                    <img src="{{ asset('storage/' . $item->ingredient->image) }}"
                                                        width="50px" alt="Ingredient Image">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <h4>Grand Total: ₱ <span class="float-end">{{ $orders->total_price }}</span> </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
