@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="">
@endsection

@section('scriptHead')
    <script></script>
@endsection

@section('content')
<div class="container my-5">
    <div class="card shadow">
        <div class="card-body">
            @if ($wishlist->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wishlist as $item)
                            @php
                                $availableQuantity = $item->ingredient->quantity >= $item->ingredient_quantity;
                                $showAddToCart = $availableQuantity && $item->ingredient->quantity > 0;
                            @endphp
                            <tr class="ingredient_data">
                                <td>
                                    <img src="{{ asset($item->ingredient->image) }}" height="70px" alt="Image here">
                                </td>
                                <td>
                                    <h3>{{ $item->ingredient->name }}</h3>
                                </td>
                                <td>
                                    <h5>₱ {{ $item->ingredient->price }}</h5>
                                </td>
                                <td>
                                    <input type="hidden" class="ingredient_id" value="{{ $item->ingredient_id }}">
                                    @if ($availableQuantity)
                                        <div class="input-group text-center mb-3" style="width:130px;">
                                            <button class="input-group-text decrement-btn" type="button">-</button>
                                            <input type="number" name="quantity" class="form-control qty-input text-center" value="1">
                                            <button class="input-group-text increment-btn" type="button">+</button>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($availableQuantity && $item->ingredient->quantity > 0)
                                        <h6>In stock</h6>
                                    @else
                                        <h6>Out of Stock</h6>
                                    @endif
                                </td>
                                <td>
                                    @if ($showAddToCart)
                                        <button class="btn btn-primary addToCartBtn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    @else
                                        <button class="btn btn-primary addToCartBtn" disabled><i class="fa fa-shopping-cart"></i> Out of Stock</button>
                                    @endif
                                    <button class="btn btn-danger remove-wishlist-item"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h4>There are no products in your wishlist</h4>
            @endif
        </div>
    </div>
</div>

@endsection
@section('scriptFoot')
@endsection
