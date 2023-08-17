<!--
=========================================================
* Argon Design System - v1.2.2
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-design-system
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('import/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('import/assets/img/favicon.png') }}">
    <title>
        Argon Design System by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="{{ asset('import/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('import/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('import/assets/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('import/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('import/assets/css/argon-design-system.css?v=1.2.2') }}" rel="stylesheet" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
    <script src="{{ asset('js\custom.js') }}"></script>
    <script src="{{ asset('js\checkout.js') }}"></script>

    <style>
        #add-pic {
            position: absolute;
            top: 16px;
            left: 134px;
            font-size: 2rem;
        }

        #edit-pic {
            position: absolute;
            top: 16px;
            left: 134px;
            font-size: 2rem;
        }
        .recipecard:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
    </style>
</head>

<body class="profile-page">
    <!-- Navbar -->

    @if (Auth::check() && auth()->user()->role_as === 1)
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" style="width: 150px; height: auto;">
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
                    <ul class="navbar-nav align-items-lg-center ml-lg-auto">
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
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" style="width: 80px; height: auto;">
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
                            <a class="nav-link" href="{{ url('user/cart') }}" alt="Cart"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Cart">
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

    <!-- End Navbar -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add Profile Picture</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Create  form 'name' and 'description' -->
                    <form method="POST" action="{{ route('user.saveImage') }}" enctype="multipart/form-data"
                        id="addImageForm">
                        @csrf
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}" id="userId">
                        <div class="form-group">
                            <label for="name">Image</label>
                            <input type="file" name="image" id="image" class="form-control" required>
                            <span id="name_error" class="text-danger"></span>
                        </div>
                        <button type="submit" class="btn btn-primary" id="saveImage">Save Image</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <section class="section-profile-cover section-shaped my-0">
            <!-- Circles background -->
            <img class="bg-image" src="{{ asset('import/assets/img/pages/mohamed.jpg') }}" style="width: 100%;">
            <!-- SVG separator -->
            <div class="separator separator-bottom separator-skew">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-secondary" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </section>
        <section class="section bg-light">
            <div class="container">
                <div class="card card-profile shadow mt--300">
                    <div class="px-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    @if ($user->image != null)
                                        <a href="javascript:;">
                                            <img src="{{ asset($user->image) }}" class="rounded-circle" width="160px" height="160px" style="object-fit:cover;"
                                                id="image">
                                            
                                        </a>
                                    @else
                                        <a href="#"data-toggle="modal" data-target="#createModal">
                                            <img src="{{ asset('image/gray.jpg') }}" class="rounded-circle"
                                                width="160px" height="160px" id="blank-image">
                                            <i class="fa-solid fa-plus  " id="add-pic"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                                <div class="card-profile-actions py-4 mt-lg-0">
                                    <a href="#" data-toggle="modal" data-target="#createModal"class="btn btn-sm btn-info mr-4">Edit Image</a>
                                    <a href="{{route('users.recipes.create')}}" class="btn btn-sm btn-default float-right">Add Recipe</a>
                                </div>
                            </div>
                            <div class="col-lg-4 order-lg-1">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">22</span>
                                        <span class="description">Friends</span>
                                    </div>
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">Photos</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">Comments</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <h3>{{ $user->name . ' ' . $user->lname }}</h3>
                            <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>
                                @if ($user->address == null || $user->pincode == null || $user->city == null)
                                    <a href="#" class="btn btn-sm btn-outline-primary">Add address</a>
                                @else
                                    {{ $user->address . ', ' . $user->city . ', ' . $user->pincode }}
                                @endif
                            </div>
                            <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>Solution Manager -
                                Creative Tim Officer</div>
                            <div><i class="ni education_hat mr-2"></i>University of Computer Science</div>
                        </div>
                        <div class="mt-5 py-5 border-top text-center">
                            <h1 class="mb-5">My Recipes</h1>
                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                @foreach ($recipes as $recipe)
                                    
                                        <div class="col">
                                            <a href="{{ route('User.recipes.view', ['recipe' => $recipe->id]) }}">
                                                <div class="card text-dark position-relative recipecard">
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
                                  
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- <footer class="footer">
            <div class="container">
                <div class="row row-grid align-items-center mb-5">
                    <div class="col-lg-6">
                        <h3 class="text-primary font-weight-light mb-2">Thank you for supporting us!</h3>
                        <h4 class="mb-0 font-weight-light">Let's get in touch on any of these platforms.</h4>
                    </div>
                    <div class="col-lg-6 text-lg-center btn-wrapper">
                        <button target="_blank" href="https://twitter.com/creativetim" rel="nofollow"
                            class="btn btn-icon-only btn-twitter rounded-circle" data-toggle="tooltip"
                            data-original-title="Follow us">
                            <span class="btn-inner--icon"><i class="fa fa-twitter"></i></span>
                        </button>
                        <button target="_blank" href="https://www.facebook.com/CreativeTim/" rel="nofollow"
                            class="btn-icon-only rounded-circle btn btn-facebook" data-toggle="tooltip"
                            data-original-title="Like us">
                            <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
                        </button>
                        <button target="_blank" href="https://dribbble.com/creativetim" rel="nofollow"
                            class="btn btn-icon-only btn-dribbble rounded-circle" data-toggle="tooltip"
                            data-original-title="Follow us">
                            <span class="btn-inner--icon"><i class="fa fa-dribbble"></i></span>
                        </button>
                        <button target="_blank" href="https://github.com/creativetimofficial" rel="nofollow"
                            class="btn btn-icon-only btn-github rounded-circle" data-toggle="tooltip"
                            data-original-title="Star on Github">
                            <span class="btn-inner--icon"><i class="fa fa-github"></i></span>
                        </button>
                    </div>
                </div>
                <hr>
                <div class="row align-items-center justify-content-md-between">
                    <div class="col-md-6">
                        <div class="copyright">
                            &copy; 2020 <a href="" target="_blank">Creative Tim</a>.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav nav-footer justify-content-end">
                            <li class="nav-item">
                                <a href="" class="nav-link" target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer> --}}
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('import/assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('import/assets/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('import/assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('import/assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="{{ asset('import/assets/js/plugins/bootstrap-switch.js') }}"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('import/assets/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('import/assets/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('import/assets/js/plugins/datetimepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('import/assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>
    <!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <script src="{{ asset('import/assets/js/argon-design-system.min.js?v=1.2.2') }}" type="text/javascript"></script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
        $(document).ready(function() {
            
        });
        
       
        $('#blank-image').on("mouseenter", function() {
            $('#add-pic').addClass('fa-beat');
        });
        $('#blank-image').on("mouseleave", function() {
            $('#add-pic').removeClass('fa-beat');
        });
        $('#add-pic').on("mouseenter", function() {
            $(this).addClass('fa-beat');
        });
        $('#add-pic').on("mouseleave", function() {
            $(this).removeClass('fa-beat');
        });
    </script>
    <script>
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "argon-design-system-pro"
            });
    </script>
</body>

</html>
