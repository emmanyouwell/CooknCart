@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row featurette">
        <div class="col-md-6">
          <h1 class="display-5 fw-bold lh-1 mb-3">Hello, foodie! <i class="fa-solid fa-drumstick-bite" style="color: #c42121;"></i> </h1>
          <br>
             {{-- <h2 class="fw-bold"> Welcome to Cook n Cart!</h2> --}}
          <p class="lead" style="text-align: justify">Cook N Cart is an online grocery store that makes it easy to find the ingredients you need to cook your favorite recipes. With Cook N Cart, you can browse recipes by cuisine, course, or ingredient. Once you find a recipe you want to make, you can add the ingredients to your cart and checkout with just a few clicks.</p>
          
          <p class="lead" style="text-align: justify">Cook N Cart can automatically generate a shopping list for any recipe you add to your cart. The Cook N Cart recipe search engine makes it easy to find recipes for any occasion. </p>

          <p class="lead" style="text-align: justify">Cook N Cart has a wide variety of recipes to choose from, including recipes for all different cuisines. Get the best deal on your ingredients from us. Cook N Cart offers a delivery service in select areas, so you can have your groceries delivered right to your door.</p>

          <p class="lead" style="text-align: justify">Whether you're a beginner cook or a seasoned pro, Cook N Cart is the perfect way to get the ingredients you need to create delicious meals at home!</p>
          
        </div>
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="{{ asset('image/logofull.png') }}" alt="Logo" class="d-block mx-lg-auto img-fluid"
                alt="Bootstrap Themes" width="600" height="600" loading="lazy">
        </div>
      </div>
     
</div>

<div class="container marketing">
    <h1 class="display-5 fw-bold lh-1 mb-3"> Meet The Team <i class="fa-solid fa-users" style="color: #c42121;"></i> </h1>
      
            <div class="d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col-lg-4">
                        {{-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> --}}
                        <img src="{{ asset('image/jayson.png') }}" alt="Logo" class="d-block mx-lg-auto img-fluid"
                        alt="Bootstrap Themes" width="400" height="400" loading="lazy">
                        <h2 class="fw-bold">Jayson Dorilag</h2>
                        <p style="text-align: justify">Jayson has a passion for food and cooking, and he started Cook N Cart because he wanted to make it easier for people to enjoy delicious meals at home.</p>
                        {{-- <p><a class="btn btn-danger" href="#">View details &raquo;</a></p> --}}
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        {{-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> --}}
                        <img src="{{ asset('image/aivy.png') }}" alt="Logo" class="d-block mx-lg-auto img-fluid"
                        alt="Bootstrap Themes" width="400" height="400" loading="lazy">
                        <h2 class="fw-bold">Aivy Lazaro</h2>
                        <p style="text-align: justify">Aivy is a strong believer in the power of food to bring people together. She believes that Cook N Cart can help people connect with their loved ones and create lasting memories over a shared meal.</p>
                        {{-- <p><a class="btn btn-danger" href="#">View details &raquo;</a></p> --}}
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        {{-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> --}}
                        <img src="{{ asset('image/emmanuel.png') }}" alt="Logo" class="d-block mx-lg-auto img-fluid"
                        alt="Bootstrap Themes" width="400" height="400" loading="lazy">
                        <h2 class="fw-bold">Emmanuel Mingala</h2>
                        <p style="text-align: justify">Emmanuel is a certified chef and has a passion for teaching others how to cook.</p>
                        {{-- <p><a class="btn btn-danger" href="#">View details &raquo;</a></p> --}}
                    </div><!-- /.col-lg-4 -->
                </div><!-- /.row -->
            </div>
@endsection