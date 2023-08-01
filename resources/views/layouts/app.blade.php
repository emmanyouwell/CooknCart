<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cook n Cart') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @yield('css')
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('scriptHead')
</head>

<body>
    <div id="app">
        @if (Auth::check() && auth()->user()->role_as === 1)
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('storage/cookncartlogo .png') }}" alt="Logo"
                            style="width: 80px; height: auto;">
                        {{-- {{ config('app.name', 'Laravel') }} --}}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('recipes.index') }}">Recipes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ingredients.index') }}">Ingredients</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Categories
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('categories.index') }}">Recipes</a></li>
                                   
                                    <li><a class="dropdown-item"
                                            href="{{ route('categories_ingredients.index') }}">Ingredients</a></li>


                                </ul>
                            </li>

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @else
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('storage/cookncartlogo .png') }}" alt="Logo"
                            style="width: 80px; height: auto;">
                        {{-- {{ config('app.name', 'Cook n Cart') }} --}}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user-recipe.index') }}">Recipes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user-ingredient.index') }}">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact</a>
                            </li>
                            
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="#" alt="Wishlist" data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" alt="Cart" data-bs-toggle="tooltip" data-bs-placement="top" title="Cart">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </li>
                            {{-- ///////////////////////////////////////////////////////////      This is for Add to cart                      --}}
                            {{-- <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-12 main-section">
                                        <div class="dropdown">
                                            <span class="btn btn-info" data-toggle="dropdown">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                            </span>
                                            <div class="dropdown-menu">
                                                <div class="row total-header-section">
                                                    <div class="col-lg-6 col-sm-6 col-6">
                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                                    </div>
                                                    @php $total = 0 @endphp
                                                    @foreach((array) session('cart') as $id => $details)
                                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                                    @endforeach
                                                    <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                                        <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                                                    </div>
                                                </div>
                                                @if(session('cart'))
                                                    @foreach(session('cart') as $id => $details)
                                                        <div class="row cart-detail">
                                                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                                <img src="{{ $details['image'] }}" />
                                                            </div>
                                                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                                <p>{{ $details['name'] }}</p>
                                                                <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <div class="row">
                                                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                                        <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('scriptFoot')
</body>

</html>
