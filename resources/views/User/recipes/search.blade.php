@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center flex-column m-3">
        <h4>Recipe</h4>
    </div>

    <h1 class="text-center"><strong>Deliciously Fresh,</strong><span class="align-items-center"> Made with Love and
            Irresistible Recipes</span></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/user/recipes') }}">Recipes</a></li>
            @if ($search_param)
                <li class="breadcrumb-item active" aria-current="page">Search: {{ $search_param }}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">Recipes</li>
            @endif
        </ol>
    </nav>
    {{-- <div class="mt-3 mb-4">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home
                </a> /
                <a href="{{ url('user/recipes') }}">
                    Recipes
                </a>
                @if ($search_param)
                    / Search: {{ $search_param }}
                @endif
            </h6>
        </div>
    </div> --}}

    <div class="container">
        <form action="{{ route('recipes.search') }}" method="get" class="mb-4">
            <div class="input-group my-2">
                <input type="text" name="q" id="search-input" placeholder="Search"
                    class="form-control rounded-start py-1 px-2 text-sm" value="{{ request('q') }}" />
                <button type="submit" class="btn btn-primary rounded-end py-1">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>
        <div id="search-results" class="autocomplete-results"></div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @php
            $groupedRecipes = $recipes->groupBy('category_id');
        @endphp
    
        @foreach ($groupedRecipes as $categoryId => $recipesByCategory)
            @php
                $categoryName = $recipesByCategory->first()->category->name;
            @endphp
    
            <div class="col">
                <h5>{{ $categoryName }}</h5>
    
                @foreach ($recipesByCategory as $recipe)
                    <a href="{{ route('User.recipes.view', ['recipe' => $recipe->id]) }}">
                        <div class="card text-dark position-relative mb-3">
                            <img src="{{ asset($recipe->image) }}" class="card-img-top" alt="Recipe Image" height="300px"
                                style="object-fit: cover">
                            <div class="card-img-overlay bg-dark bg-opacity-25 d-flex flex-column justify-content-end">
                                <h5 class="card-title text-light">{{ $recipe->name }}</h5>
                                <p class="card-text text-light">{{ $recipe->description }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
    
@endsection

@section('scriptFoot')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            $('#nav-tabContent .tab-pane').on('show.bs.tab', function(e) {
                $('#nav-tabContent .tab-pane.show').removeClass('show active');
                $(this).addClass('show active');
            });

            const searchInput = document.getElementById('search-input');

            $(searchInput).autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '{{ route('autocomplete.recipes') }}',
                        dataType: 'json',
                        data: {
                            q: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.name,
                                    value: item.name
                                };
                            }));
                        },
                        error: function() {
                            response([]); 
                        }
                    });
                },
                minLength: 2,
                select: function(event, ui) {
                  
                },
                messages: {
                    noResults: '',
                },
            });


        });
    </script>
@endsection
