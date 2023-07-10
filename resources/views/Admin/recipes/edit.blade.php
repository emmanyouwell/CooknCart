@extends('Admin.index')
@section('content')
<div class="container">
    <h2>Edit Recipe</h2>

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $recipe->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $recipe->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="instruction">Instruction</label>
            <textarea class="form-control" id="instruction" name="instruction" required>{{ $recipe->instruction }}</textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}" {{ $recipe->category_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ingredients">Ingredients</label><br>
            @foreach ($ingredients as $id => $name)
                <input type="checkbox" name="ingredients[]" value="{{ $id }}" {{ in_array($id, $recipe->ingredients->pluck('id')->toArray()) ? 'checked' : '' }}> {{ $name }}<br>
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
