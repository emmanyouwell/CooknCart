@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="">
@endsection

@section('scriptHead')
    <script></script>
@endsection

@section('content')
    <div class="d-flex align-items-center flex-column m-3">
        <h4>Products</h4>
        <h1 class="text-center"><strong>Fresh, Affordable,</strong><span class="align-items-center"> And High Quality
                Ingredients</span></h1>
    </div>
    <div class="container">
        <nav>
            <div class="nav nav-tabs flex-column flex-sm-row" id="nav-tab" role="tablist">
                @foreach ($categories as $category)
                    @if ($loop->first)
                        <button class="flex-sm-fill text-sm-center nav-link active" id="nav-{{ $category->id }}-tab"
                            data-bs-toggle="tab" data-bs-target="#category-{{ $category->id }}" type="button"
                            role="tab" aria-controls="nav-{{ $category->id }}"
                            aria-selected="true">{{ $category->name }}</button>
                    @else
                        <button class="flex-sm-fill text-sm-center nav-link" id="nav-{{ $category->id }}-tab"
                            data-bs-toggle="tab" data-bs-target="#category-{{ $category->id }}" type="button"
                            role="tab" aria-controls="nav-{{ $category->id }}"
                            aria-selected="false">{{ $category->name }}</button>
                    @endif
                @endforeach
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            @foreach ($categories as $category)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="category-{{ $category->id }}"
                    role="tabpanel" aria-labelledby="nav-{{ $category->id }}-tab">
                    <div class="d-flex align-items-center flex-column m-3">
                        <h2>{{ $category->name }}</h2>
                    </div>
                    <div class="row row-cols-1 row-cols-md-4">
                        @foreach ($category->ingredients as $ingredient)
                            <div class="col-md-3 mb-4">
                                <a href="{{ route('User.ingredients.view', ['ingredient' => $ingredient->id]) }}"
                                    style="text-decoration: none;">
                                    <div class="card" style="width: 18rem;">
                                        <div class="square-image-container">
                                            <img src="{{ asset('storage/' . $ingredient->image) }}"
                                                class="card-img-top square-image" alt="Ingredient Image">
                                        </div>
                                        <div class="card-body ingredient_data">
                                            <input type="hidden" value="{{ $ingredient->id }}" class="ingredient_id">
                                            <h5 class="card-title">{{ $ingredient->name }} <span
                                                class="card-title top-0 start-100 translate-rigth badge rounded-pill bg-primary">
                                                <i class="fas fa-star"></i> 0.5
                                            </span></h5>
                                            <h6 class="card-title">₱{{ $ingredient->price }}</h6>
                                            <p class="card-text">{{ $ingredient->description }}</p>
                                            {{-- <h9 class="card-title"><i class="fa-solid fa-star"
                                                    style="color: #ffc800;"></i><i class="fa-solid fa-star"
                                                    style="color: #ffc800;"></i><i class="fa-solid fa-star"
                                                    style="color: #ffc800;"></i><i class="fa-solid fa-star"
                                                    style="color: #ffc800;"></i><i class="fa-solid fa-star"
                                                    style="color: #ffc800;"></i> 5.0</h9> --}}
                                            <div class="input-group text-center mb-3" style="width:130px;">
                                                <button class="input-group-text decrement-btn">-</button>
                                                <input type="text" name="quantity"
                                                    class="form-control qty-input text-center" value="1">
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
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scriptFoot')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Collapse other categories when one is opened
            $('#nav-tabContent .tab-pane').on('show.bs.tab', function(e) {
                $('#nav-tabContent .tab-pane.show').removeClass('show active');
                $(this).addClass('show active');
            });
        });
    </script>
@endsection
