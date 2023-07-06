@extends('layouts.app')
    <title>Create Category</title>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create Ingredient Category</h1>
                <form action="{{ route('categories_ingredients.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <label for="description">Description:</label>
                        <textarea type="text" name="description" id="description" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>

@endsection