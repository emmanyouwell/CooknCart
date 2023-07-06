@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add Ingredient</h2>
        <form method="POST" action="{{ route('ingredients.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="ingredient_category_id">Category:</label>
                <select name="ingredient_category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
@endsection
