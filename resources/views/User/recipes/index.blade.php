@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="">
    <style>
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
    </style>
@endsection

@section('scriptHead')
    <script></script>
@endsection

@section('content')
    <div class="d-flex align-items-center flex-column m-3">
        <h4>Recipe</h4>
        <h1 class="text-center"><strong>Deliciously Fresh,</strong><span class="align-items-center"> Made with Love and
                Irresistible Recipes</span></h1>

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
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach ($recipes as $recipe)
                            @if ($recipe->category_id === $category->id)
                                <div class="col">
                                    <a href="{{ route('User.recipes.view', ['recipe' => $recipe->id]) }}">
                                        <div class="card text-dark position-relative">
                                            <img src="{{ asset($recipe->image) }}" class="card-img-top" alt="Recipe Image"
                                                height="300px" style="object-fit: cover">
                                            <div
                                                class="card-img-overlay bg-dark bg-opacity-25 d-flex flex-column justify-content-end">
                                                <h5 class="card-title text-light">{{ $recipe->name }}</h5>
                                                <p class="card-text text-light">{{ $recipe->description }}</p>

                                                {{-- <p class="card-text text-light">{{ $recipe->preptime }}</p>
                                                <p class="card-text text-light">{{ $recipe->cooktime }}</p>
                                                <p class="card-text text-light">{{ $recipe->servings }}</p> --}}

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endsection

    @section('scriptFoot')
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
