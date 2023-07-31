@extends('layouts.app')

@section('css')
    {{-- <link rel="stylesheet" href="">
    <style>
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
    </style> --}}
@endsection

@section('scriptHead')
    <script></script>
@endsection

@section('content')

    <div class="container">
        <div class="d-flex align-items-center flex-column m-3">
            <h4>Recipes</h4>
            <h2><strong>Tried, Tested,</strong><span class="orange"> And Truly Delicious</span></h2>
        </div>



        <nav>
            <div class="nav nav-tabs flex-column flex-sm-row" id="nav-tab" role="tablist">
                @foreach ($categories as $category)
                    @if ($category->id == 1)
                        <button class="flex-sm-fill text-sm-center nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#{{ $category->name }}" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">{{ $category->name }}</button>
                    @else
                        <button class="flex-sm-fill text-sm-center nav-link" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#{{ $category->name }}" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">{{ $category->name }}</button>
                    @endif
                @endforeach
            </div>
        </nav>

        {{-- <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                @foreach ($categories as $category)
                    @if ($category->id == 1)
                        <li class="nav-item active" role="presentation"><a class="nav-link active" data-bs-toggle="tab"
                                href="#{{ $category->name }}">{{ $category->name }}</a></li>
                    @else
                        <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab"
                                href="#{{ $category->name }}">{{ $category->name }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div> --}}


        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="{{ $categories[0]->name }}" role="tabpanel"
                aria-labelledby="nav-home-tab">

                <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">

                    @foreach ($recipes as $recipe)
                        @if ($recipe->category_id == $categories[0]->id)
                            <div class="col">
                                <div class="card h-100">
                                    <img src="{{ asset($recipe->image) }}" class="card-img-top" alt="..."
                                        height="300px" style="object-fit:cover">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $recipe->name }}</h5>
                                        <p class="card-text">{{ $recipe->description }}</p>
                                        <p class="card-title">Ingredients</p>

                                        <ol class="list-group list-group-flush">
                                            @foreach($ingredients as $ing)
                                                @if(in_array($ing->id,json_decode($recipe->tags,true)))
                                                    <li class="list-group-item">• {{$ing->name}}</li>
                                                @endif
                                                
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
            @for ($i = 1; $i < $categories->count(); $i++)
                <div class="tab-pane fade show" id="{{ $categories[$i]->name }}" role="tabpanel"
                    aria-labelledby="nav-home-tab">

                    <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">

                        @foreach ($recipes as $recipe)
                            @if ($recipe->category_id == $categories[$i]->id)
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="/storage{{ $recipe->image }}" class="card-img-top" alt="..."
                                            height="300px" style="object-fit:cover">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $recipe->name }}</h5>
                                            <p class="card-text">{{ $recipe->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            @endfor
        </div>
        {{-- <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach ($recipes as $recipe)
                <div class="col">
                    <div class="card text-dark position-relative">
                        <img src="{{ asset($recipe->image) }}" class="card-img-top" alt="Recipe Image" height="300px" style="object-fit: cover">
                        <div class="card-img-overlay bg-dark bg-opacity-25 d-flex flex-column justify-content-end">
                            <h5 class="card-title text-light">{{ $recipe->name }}</h5>
                            <p class="card-text text-light">{{ $recipe->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>               --}}
    </div>
@endsection

@section('scriptFoot')
    <script></script>
@endsection
