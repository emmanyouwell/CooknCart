@if (Auth::check() && auth()->user()->role_as === 1)
    <nav class="navbar navbar-expand-md shadow-sm bg-light navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('image/logo.png') }}" alt="Logo" style="width: 80px; height: auto;">
                {{-- {{ config('app.name', 'Laravel') }} --}}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
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
                            Orders
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('orders.index') }}">Pending Orders</a></li>

                            <li><a class="dropdown-item" href="{{ url('order-history') }}">Order Manager</a></li>
                        </ul>
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

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm" style="background-color: #c42121">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('image/logo.png') }}" alt="Logo" style="width: 80px; height: auto;">
                {{-- {{ config('app.name', 'Cook n Cart') }} --}}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    {{-- <li class="nav-item">
                                <a class="nav-link" href="{{url('/home')}}">Home</a>
                            </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('User.Frontend.about') }}">About</a>
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
                        <a class="nav-link" href="{{ url('user/wishlist') }}" alt="Wishlist"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                            <i class="fa-solid fa-bag-shopping"><span
                                    class="badge rounded-pill bg-danger wishlist-count"> 0</span></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('user/cart') }}" alt="Cart" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Cart">
                            <i class="fa-solid fa-cart-shopping"><span
                                    class="badge rounded-pill bg-danger cart-count"> 0</span></i>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ url('user/my-orders') }}" alt="Orders"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Orders">
                                    
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                </a>
                            </li> --}}

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
                                <a class="dropdown-item" href="{{ route('user.profile') }}">
                                    {{ __('Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ url('user/my-orders') }}">
                                    {{ __('My Orders') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
