@extends('layouts.app')

@section('css')
    <style>
        .post-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 10px 0;
            background-color: #fff;
            box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
        }

        .post-image {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .user-name {
            font-weight: bold;
        }

        .post-content {
            margin-bottom: 10px;
        }

        .post-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .post-action {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #666;
        }

        .rating-css div {
            color: #ffe400;
            font-size: 30px;
            font-family: sans-serif;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
            padding: 20px 0;
        }

        .rating-css input {
            display: none;
        }

        .rating-css input+label {
            font-size: 60px;
            text-shadow: 1px 1px 0 #8f8420;
            cursor: pointer;
        }

        /* Updated CSS */
        .rating-css input:checked~label {
            color: #b4afaf;
        }

        /* Keep all stars visible */
        .rating-css label {
            color: #ffe400;
        }

        .rating-css label:active {
            transform: scale(0.8);
            transition: 0.3s ease;
        }
    </style>
@endsection

@section('content')
    {{-- This the Modal --}}

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('user.add-rating') }}" method="POST">
                    @csrf
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Rate: {{ $recipe->name }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                <input type="radio" value="1" name="stars_rated" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="stars_rated" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="stars_rated" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="stars_rated" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="stars_rated" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                                <!-- Add more radio inputs for other ratings -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    {{-- This the post card --}}
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card post-card">
                    <div class="user-profile">
                        <img src="https://scontent.fmnl33-1.fna.fbcdn.net/v/t39.30808-1/366181326_103255029539724_136952219169775613_n.jpg?stp=dst-jpg_p240x240&_nc_cat=101&cb=99be929b-3346023f&ccb=1-7&_nc_sid=2b6aad&_nc_eui2=AeG_eABj3_Gk9av8MNbk-bNn_Scoq1-II879JyirX4gjzlh2DiqgjUjDdNyMLgIsPUYQqdklcTA2som7q4-abeg7&_nc_ohc=2_xIkz5rsv0AX_hKv7C&_nc_pt=1&_nc_ht=scontent.fmnl33-1.fna&oh=00_AfB6f4Dqia6BadyUgOiU_HSqKirtoIhI_JoQO24etxD3JQ&oe=64DC1DA8"
                            width="40" class="user-avatar rounded-circle">
                        <div>
                            <span class="user-name">{{ $recipe->user->name }}</span>
                            <!-- Add timestamp here -->
                        </div>
                    </div>
                    <div class="name"><b>Recipe:</b>{{ $recipe->name }}</div>
                    <img src="{{ asset($recipe->image) }}" class="img-fluid post-image">
                    <div class="post-content">
                        <h6><b>Description:</b></h6>
                        <p>{{ $recipe->description }}</p>
                        <h6><b>Instruction:</b></h6>
                        <p>{{ $recipe->instruction }}</p>

                        <h6><b>Rating:</b></h6>
                        @if ($recipe->ratings->count() > 0)
                            <?php
                            $totalRating = 0;
                            foreach ($recipe->ratings as $rating) {
                                $totalRating += $rating->stars_rated;
                            }
                            $averageRating = $totalRating / $recipe->ratings->count();
                            ?>
                            <p>{{ number_format($averageRating, 1) }} <i class="fa-solid fa-star"
                                    style="color: #fff700;"></i></p>
                        @else
                            <p>No ratings yet</p>
                        @endif
                    </div>

                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Rate<i class="fa-solid fa-star"></i>
                        </button>
                        <form action="{{ route('user.add-review') }}" method="POST">
                            @csrf
                            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="user_review" placeholder="Add comment"
                                    aria-label="Add comment" aria-describedby="button-addon2">
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Submit</button>
                            </div>
                        </form>

                    </div>
                    <hr>
                    <div class="comments">
                        @foreach ($recipe->reviews as $review)
                            <div class="comment-content">
                                <p class="comment-text">{{ $review->user_review }}</p>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                    
                    
            
                    
                </div>
            </div>
        </div>
    </div>


    {{-- This the Ingredients card --}}
    <div class="row">
        <h3>Ingredients:</h3>
        @php
            $ingredientIds = json_decode($recipe->tags);
        @endphp

        @foreach ($ingredientIds as $ingredientId)
            @php
                $ingredient = \App\Models\Ingredient::find($ingredientId);
            @endphp
            @if ($ingredient)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('User.ingredients.view', ['ingredient' => $ingredient->id]) }}"
                        style="text-decoration: none;">
                        <div class="card" style="width: 18rem;">
                            <div class="square-image-container" style="height: 200px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $ingredient->image) }}" class="card-img-top square-image"
                                    alt="Ingredient Image" style="object-fit: cover; width: 100%; height: 100%;">
                            </div>

                            <div class="card-body ingredient_data">
                                <input type="hidden" value="{{ $ingredient->id }}" class="ingredient_id">
                                <h5 class="card-title">{{ $ingredient->name }} <span
                                        class="card-title top-0 start-100 translate-rigth badge rounded-pill bg-primary">
                                        <i class="fas fa-star"></i> 0.5
                                    </span>
                                </h5>
                                <h6 class="card-title">₱{{ $ingredient->price }}</h6>
                                <p class="card-text">
                                    {{ \Illuminate\Support\Str::limit($ingredient->description, 100, $end = '...') }}
                                </p>
                                <div class="input-group text-center mb-3" style="width:130px;">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" class="form-control qty-input text-center"
                                        value="1">
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
            @endif
        @endforeach
    </div>
@endsection

@section('scriptFoot')
    <script>
        $(document).ready(function() {
            $('.rating-css input').on('change', function() {
                $('.rating-css label').removeClass('fa-star fa-solid').addClass('fa-star-o fa-regular');
                $(this).nextAll().addBack().prevAll().addClass('fa-star fa-solid').removeClass(
                    'fa-star-o fa-regular');
            });

            $('#ratingForm').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    success: function(response) {
                        // Handle success, if needed
                        console.log(response);
                        // Close the modal
                        $('#staticBackdrop').modal('hide');
                    },
                    error: function(error) {
                        // Handle error, if needed
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
