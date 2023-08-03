@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="">
@endsection

@section('scriptHead')
    <script></script>
@endsection

@section('content')
<div class="container mt-3">
    <form action="{{ url('user/place-order') }}" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Basic Details</h6>
                        <hr>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for=""> First Name </label>
                                <input type="text" class="form-control firstname" value="{{ Auth::user()->name }}"
                                    name="fname" placeholder="Enter first Name">
                                <span id="fname_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for=""> Last Name </label>
                                <input type="text" class="form-control lastname" value="{{ Auth::user()->lname }}"
                                    name="lname" placeholder="Enter Last Name">
                                <span id="lname_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for=""> Email </label>
                                <input type="text" class="form-control email" value="{{ Auth::user()->email }}"
                                    name="email" placeholder="Enter Email">
                                <span id="email_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for=""> Phone No. </label>
                                <input type="text" class="form-control phone" value="{{ Auth::user()->phone }}"
                                    name="phone" placeholder="phone">
                                <span id="phone_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for=""> Address </label>
                                <input type="text" class="form-control address" value="{{ Auth::user()->address }}"
                                    name="address" placeholder="Enter Address">
                                <span id="address1_error" class="text-danger"></span>
                            </div>
                           
                            <div class="col-md-6 mt-3">
                                <label for=""> City </label>
                                <input type="text" class="form-control city" value="{{ Auth::user()->city }}"
                                    name="city" placeholder="Enter City">
                                <span id="city_error" class="text-danger"></span>
                            </div>
    
                            <div class="col-md-6 mt-3">
                                <label for=""> Pin Code </label>
                                <input type="text" class="form-control pincode" value="{{ Auth::user()->pincode }}"
                                    name="pincode" placeholder="Enter Pin Code">
                                <span id="pincode_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6>Order Details</h6>
                        <hr>
                        @if (count($cartitems) > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPrice = 0; // Initialize total price variable
                                    @endphp
                                
                                    @foreach ($cartitems as $item)
                                        <tr>
                                            <td>{{ $item->ingredient->name }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $item->ingredient->image) }}" alt="Product Image" class="img-fluid" style="max-width: 100px;">
                                            </td>
                                            <td>{{ $item->ingredient_quantity }}</td>
                                            <td>₱ {{ $item->ingredient->price }}</td>
                                        </tr>
                                        @php
                                            $totalPrice += $item->ingredient->price * $item->ingredient_quantity;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td>Total Price: ₱ {{ $totalPrice }}</td>
                                    </tr>
                                </tbody>
                                
                            </table>
                            <hr>
                            {{-- <h5>Choose your payment method</h5> --}}
                            <button type="submit" class="btn btn-success w-100" name="MOP" value="1"><i class="fa-solid fa-truck-fast"></i> Cash on Delivery</button>
                            <button type="submit" class="btn btn-primary w-100 mt-3" name="MOP" value="2"><i class="fa-solid fa-g"></i>cash</button>
                            <button type="submit" class="btn btn-primary w-100 mt-3" name="MOP" value="3"><i class="fa-solid fa-p"></i>aypal</button>
                        @else
                            <p>No products in the cart</p>
                        @endif
                    </div>
                </div>
            </div>
    </form>
</div>
@endsection
@section('scriptFoot')
@endsection
