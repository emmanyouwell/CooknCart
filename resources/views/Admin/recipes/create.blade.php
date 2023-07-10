@extends('Admin.index')
@section('content')
<div class="container">
    <h2>Create Recipe</h2>

    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="instruction">Instruction</label>
            <textarea class="form-control" id="instruction" name="instruction" required></textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ingredients">Select Ingredients:</label><br>
            @foreach ($ingredients as $ingredient)
                <label>
                    <input type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}">
                    {{ $ingredient->name }}
                </label><br>
            @endforeach
        </div>
    
    
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
