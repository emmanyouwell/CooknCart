@extends('layouts.app')

@section('css')
<style>
</style>
@endsection

@section('scriptHead')
<!-- Add any scripts related to the carousel if needed -->
@endsection

@section('content')
<div class="carousel-container mt-3">
    <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset($recipe->image) }}" class="d-block w-100" alt="Recipe Image">
                <div class="carousel-caption">
                    <h1>{{ $recipe ->name }}</h1>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#recipeCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
</div>

<div class="row">
    <h3>Ingredients:</h3>
    @php
        $ingredientIds = json_decode($recipe->tags);
    @endphp

    @foreach ($ingredientIds as $ingredientId)
        @php
            $ingredient = \App\Models\Ingredient::find($ingredientId);
        @endphp
        @if ($ingredient)
            <div class="col-md-3 mb-4">
                <a href="{{ route('User.ingredients.view', ['ingredient' => $ingredient->id]) }}" style="text-decoration: none;">
                    <div class="card" style="width: 18rem;">
                        <div class="square-image-container">
                            <img src="{{ asset('storage/' . $ingredient->image) }}" class="card-img-top square-image"
                                alt="Ingredient Image">
                        </div>
                        <div class="card-body ingredient_data">
                            <input type="hidden" value="{{ $ingredient->id }}" class="ingredient_id">
                            <h5 class="card-title">{{ $ingredient->name }} <span
                                    class="card-title top-0 start-100 translate-rigth badge rounded-pill bg-primary">
                                    <i class="fas fa-star"></i> 0.5
                                </span>
                            </h5>
                            <h6 class="card-title">₱{{ $ingredient->price }}</h6>
                            <p class="card-text">{{ $ingredient->description }}</p>
                            <div class="input-group text-center mb-3" style="width:130px;">
                                <button class="input-group-text decrement-btn">-</button>
                                <input type="text" name="quantity" class="form-control qty-input text-center" value="1">
                                <button class="input-group-text increment-btn">+</button>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary addToCartBtn">Add to Cart <i
                                        class="fa fa-shopping-cart"></i></button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif
    @endforeach
</div>

@endsection

@section('scriptFoot')
<!-- Add any additional scripts related to the carousel if needed -->
@endsection
