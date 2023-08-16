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
                    <div class="name"><b>Recipe: </b>{{ $recipe->name }}</div>
                    <div class="square-image-container mb-3" style="height: 500px; overflow: hidden;">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @for ($i=0; $i<count($img); $i++)
                                @if($i==0)
                                    <div class="carousel-item active">
                                        <img src="{{ asset($img[$i]) }}"
                                            style="object-fit: cover; width: 100%; height: 100%;" class="  d-block w-100">
                                    </div>
                                    @else
                                    <div class="carousel-item">
                                        <img src="{{ asset($img[$i]) }}"
                                            style="object-fit: cover; width: 100%; height: 100%;" class="  d-block w-100">
                                    </div>
                                    @endif
                                @endfor
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                    </div>

                    <div class="post-content ">
                        <h6><b>Description: </b></h6>
                        <p>{{ $recipe->description }}</p>

                        <div>
                            <h6><b>Preparation Time: </b>{{ $recipe->preptime }}</h6>
                            <p></p>
                            <h6><b>Cooking Time: </b>{{ $recipe->cooktime }}</h6>
                            <p></p>
                            <h6><b>Servings: </b>{{ $recipe->servings }}</h6>
                            <p></p>

                        </div>

                        <h6><b>Instruction:</b></h6>
                        @php
                            $ins = json_decode($recipe->instruction, true);
                        @endphp
                        @foreach ($ins as $instruction)
                            <p>{{ $instruction['step'] }}</p>
                        @endforeach
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
                        @foreach ($reviews as $review)
                            <div class="comment-content">
                                <span class="user-name">
                                    <img src="#" width="40" class="user-avatar rounded-circle">
                                    {{ $review->user->name . ' ' . $review->user->lname }}

                                </span>
                                <small>
                                    @php
                                        $now = now();
                                        $createdAt = $review->created_at;
                                        $timeDiff = $now->diff($createdAt);
                                        
                                        if ($timeDiff->d >= 1) {
                                            echo $timeDiff->d . ' day' . ($timeDiff->d > 1 ? 's' : '') . ' ago';
                                        } elseif ($timeDiff->h >= 1) {
                                            echo $timeDiff->h . ' hour' . ($timeDiff->h > 1 ? 's' : '') . ' ago';
                                        } elseif ($timeDiff->i >= 1) {
                                            echo $timeDiff->i . ' minute' . ($timeDiff->i > 1 ? 's' : '') . ' ago';
                                        } else {
                                            echo 'Just now';
                                        }
                                    @endphp
                                </small>
                                {{-- <p>Logged-In User ID: {{ Auth::id() }}</p>
                                <p>Comment User ID: {{ $review->user_id }}</p> --}}
                                <p class="comment-text">{{ $review->user_review }}</p>

                                @if ($review->user->id === Auth::id())
                                    <div class="comment-actions">
                                        <a href="#" class="btn btn-sm btn-link" data-toggle="modal"
                                            data-target="#editModal{{ $review->id }}">Edit</a>
                                        <a href="#" class="btn btn-sm btn-link" data-toggle="modal"
                                            data-target="#deleteModal{{ $review->id }}">Delete</a>
                                    </div>
                                @elseif (Auth::check())
                                    <p>You can only edit and delete your own comments.</p>
                                @endif

                                <hr>
                            </div>
                            <div class="modal fade" id="editModal{{ $review->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editModalLabel{{ $review->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $review->id }}">Edit Comment
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('reviews.edit', ['id' => $review->id]) }}"
                                                method="post">
                                                @csrf
                                                <textarea name="user_review" class="form-control">{{ $review->user_review }}</textarea>
                                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $review->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalLabel{{ $review->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $review->id }}">Delete
                                                Comment</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this comment?</p>
                                            <form action="{{ route('reviews.delete', ['id' => $review->id]) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger mt-3">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
            <div class="col-md-6">
                <h3 class="">Ingredients:</h3>
                @php
                    $ingredientIds = json_decode($recipe->tags);
                    
                @endphp
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach ($ingredientIds as $ingredientId)
                        @php
                            $ingredient = \App\Models\Ingredient::find($ingredientId);
                            
                        @endphp

                        @if ($ingredient)
                            <div class="col">
                                <a href="{{ route('User.ingredients.view', ['ingredient' => $ingredient->id]) }}"
                                    style="text-decoration: none;">
                                    <div class="card h-100" style="width: 18rem;">
                                        <div class="square-image-container" style="height: 200px; overflow: hidden;">
                                            <img src="{{ asset($ingredient->image) }}" class="card-img-top square-image"
                                                alt="Ingredient Image"
                                                style="object-fit: cover; width: 100%; height: 100%;">
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
                                                <input type="text" name="quantity"
                                                    class="form-control qty-input text-center" value="1">
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
            </div>
        </div>
    </div>


    {{-- This the Ingredients card --}}
    {{-- <div class="row">
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
                                <img src="{{ asset($ingredient->image) }}" class="card-img-top square-image"
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
    </div> --}}
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
