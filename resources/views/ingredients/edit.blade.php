@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Ingredient</h2>
    <form action="{{ route('ingredients.update', $ingredient->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{ $ingredient->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" required>{{ $ingredient->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" name="image">
            <img src="{{ asset('storage/' . $ingredient->image) }}" alt="Ingredient Image" width="100">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" name="quantity" value="{{ $ingredient->quantity }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" name="price" value="{{ $ingredient->price }}" required>
        </div>
        <div class="form-group">
            <label for="ingredient_category_id">Category:</label>
            <select class="form-control" name="ingredient_category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" {{ $ingredient->ingredient_category_id == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
