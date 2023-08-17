@extends('layouts.app')

@section('css')
    <style>
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        /* Additional styles for the autocomplete results */
        .autocomplete-results {
            position: absolute;
            width: 100%;
            max-height: 300px;
            overflow-y: auto;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .autocomplete-result {
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .autocomplete-result:hover {
            background-color: #f5f5f5;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex align-items-center flex-column m-3">
        <h4>Recipe</h4>
    </div>

    <h1 class="text-center"><strong>Deliciously Fresh,</strong><span class="align-items-center"> Made with Love and
            Irresistible Recipes</span></h1>

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
        {{-- <div id="search-results" class="autocomplete-results"></div> --}}


        <nav>
            <div class="nav nav-tabs flex-column flex-sm-row" id="nav-tab" role="tablist">
                @foreach ($categories as $category)
                    <button class="flex-sm-fill text-sm-center nav-link {{$loop->first ? 'active' : ''}}" id="nav-{{ $category->id }}-tab"
                        data-bs-toggle="tab" data-bs-target="#category-{{ $category->id }}" type="button" role="tab"
                        aria-controls="nav-{{ $category->id }}" aria-selected="false">{{ $category->name }}</button>
                @endforeach
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            @foreach ($categories as $category)
            
                <div class="tab-pane fade {{$loop->first ? 'show active' : ''}}" id="category-{{ $category->id }}" role="tabpanel"
                    aria-labelledby="nav-{{ $category->id }}-tab">
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
    </div>
@endsection

@section('scriptFoot')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
