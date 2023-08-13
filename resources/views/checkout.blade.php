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
                                <span id="address_error" class="text-danger"></span>
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
                            <button type="submit" class="btn btn-primary w-100 validate_btn" name="MOP" value="1"><i class="fa-solid fa-truck-fast"></i> Cash on Delivery</button>
                            <button type="submit" class="btn btn-primary w-100 mt-3 validate_btn" name="MOP" value="2"><i class="fa-solid fa-g"></i>cash</button>
                            <button type="submit" class="btn btn-primary w-100 mt-3 validate_btn" name="MOP" value="3"><i class="fa-solid fa-p"></i>aypal</button>
                            <input type="hidden" name="MOP" id="paymentMethod" value="">
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
<script>
    $(document).ready(function () {
        $('.validate_btn').click(function (e) {
            e.preventDefault();

            var firstname = $('.firstname').val();
            var lastname = $('.lastname').val();
            var email = $('.email').val();
            var phone = $('.phone').val();
            var address = $('.address').val();
            var city = $('.city').val();
            var pincode = $('.pincode').val();

            var fname_error = "";
            var lname_error = "";
            var email_error = "";
            var phone_error = "";
            var address_error = "";
            var city_error = "";
            var pincode_error = "";

            // First Name validation
            if (!firstname) {
                fname_error = "First Name is required";
            }

            // Last Name validation
            if (!lastname) {
                lname_error = "Last Name is required";
            }

            // Email validation
            if (!email) {
                email_error = "Email is required";
            } else if (!validateEmail(email)) {
                email_error = "Invalid email address";
            }

            // Phone validation
            if (!phone) {
                phone_error = "Phone number is required";
            } else if (!validatePhone(phone)) {
                phone_error = "Invalid phone number";
            }

            // Address validation
            if (!address) {
                address_error = "Address is required";
            }

            // City validation
            if (!city) {
                city_error = "City is required";
            }

            // Pin Code validation
            if (!pincode) {
                pincode_error = "Pincode is required";
            } else if (!validatePincode(pincode)) {
                pincode_error = "Invalid pincode";
            }

            $('#fname_error').text(fname_error);
            $('#lname_error').text(lname_error);
            $('#email_error').text(email_error);
            $('#phone_error').text(phone_error);
            $('#address_error').text(address_error);
            $('#city_error').text(city_error);
            $('#pincode_error').text(pincode_error);

            if (fname_error || lname_error || email_error || phone_error || address_error || city_error || pincode_error) {
                return false;
            } else {
                // Set the payment method value before form submission
                $('#paymentMethod').val($(this).val());

                // Proceed with form submission
                $(this).closest('form').submit();
            }
        });

        // Email validation function
        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        // Phone number validation function
        function validatePhone(phone) {
            var re = /^[0-9]{11}$/;
            return re.test(phone);
        }

        // Pincode validation function
        function validatePincode(pincode) {
            var re = /^[0-9]{4}$/;
            return re.test(pincode);
        }
    });
</script>
@endsection
