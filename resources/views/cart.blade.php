@extends('layouts.app')

@section('css')
@endsection

@section('scriptHead')
    <script></script>
@endsection

@section('content')

    <div class="container my-5">
        @if ($cartItems->count() > 0)
            <div class="card shadow product_data">
                <div class="card-body">
                    @php $total = 0; @endphp
                    @foreach ($cartItems as $item)
                        <div class="row ingredient_data">
                            <div class="col-md-2">
                                <img src="{{ asset('storage/' . $item->ingredient->image) }}" height="70px" alt="Image here">
                            </div>
                            <div class="col-md-2 my-auto">
                                <h3>{{ $item->ingredient->name }}</h3>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h5>₱ {{ $item->ingredient->price }}</h5>
                            </div>
                            <div class="col-md-3">
                                <input type="hidden" class="ingredient_id" value="{{ $item->ingredient_id }}">
                                @if ($item->ingredient->quantity >= $item->ingredient_quantity)
                                    <label for="quantity">Quantity</label>
                                    <div class="input-group text-center mb-3" style="width:130px;">
                                        <button class="input-group-text changeQuantity decrement-btn" type="button">-</button>
                                        <input type="text" name="quantity" class="form-control qty-input text-center" value="{{ $item->ingredient_quantity }}" min="1">
                                        <button class="input-group-text changeQuantity increment-btn" type="button">+</button>
                                    </div>
                                    @php $total += $item->ingredient->price * $item->ingredient_quantity; @endphp
                                @else
                                    <h6>Out of Stock</h6>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger delete-cart-item"><i class="fa fa-trash"></i> Remove</button>
                            </div>
                        </div>
                        @php $total += $item->ingredient->price * $item->quantity; @endphp
                    @endforeach
                </div>
                <div class="card-footer">
                    <h6>Total Price: ₱ {{ $total }}</h6>
                    <a href="{{ url('checkout') }}" class="btn btn-outline-success float-end">Proceed to Checkout</a>
                </div>
            </div>
        @else
            <div class="card-body text-center">
                <h2>Your <i class="fa fa-shopping-cart"></i> Cart is Empty</h2>
                <a href="{{ url('category') }}" class="btn btn-outline-primary float-end"> Continue Shopping</a>
            </div>
        @endif
    </div>
@endsection


@section('scriptFoot')
    </script>
@endsection
