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

    <form action="{{ route('recipes.search', request()->query()) }}">
        <div class="input-group my-2 mb-3">
            <input type="text" name="q" id="search-input" placeholder="Search"
                class="form-control rounded-start py-1 px-2 text-sm" value="{{ $search_param }}" />
            <button type="submit" class="btn btn-primary rounded-end py-1">
                <i class="fa fa-search"></i> <!-- Font Awesome search icon -->
            </button>
        </div>
    </form>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($recipes as $recipe)
            <div class="col">
                <h5>{{ $recipe->category->name }}</h5>
                <a href="{{ route('User.recipes.view', ['recipe' => $recipe->id]) }}">
                    <div class="card text-dark position-relative">
                        <img src="{{ asset($recipe->image) }}" class="card-img-top" alt="Recipe Image" height="300px"
                            style="object-fit: cover">
                        <div class="card-img-overlay bg-dark bg-opacity-25 d-flex flex-column justify-content-end">
                            <h5 class="card-title text-light">{{ $recipe->name }}</h5>
                            <p class="card-text text-light">{{ $recipe->description }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script> --}}

{{-- //dito nagana
$(function() {
    // Initialize Bloodhound engine
    var recipes = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '{{ route('recipes.search') }}?q=%QUERY',
            wildcard: '%QUERY'
        }
    });

    // Initialize Typeahead
    $('#search-input').typeahead({
        hint: true,
        highlight: true,
        minLength: 2
    }, {
        name: 'recipes',
        display: 'name', // Change this to the field you want to display
        source: recipes
    });
}); --}}
