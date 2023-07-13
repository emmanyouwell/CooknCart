@extends('Admin.index')
@section('content')
<div class="container">
    <h2>Create Ingredient</h2>
    <form action="{{ route('ingredients.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Ingredient Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" required>
      </div>
      <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" required>
      </div>
      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" required>
      </div>
      <div class="mb-3">
        <label for="ingredient_category_id" class="form-label">Category</label>
        <select class="form-control" id="ingredient_category_id" name="ingredient_category_id" required>
          <option value="">Select Category</option>
          @foreach($categories as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Create</button>
    </form>
  </div>  
@endsection
