@extends('Admin.index')
@section('content')
<title>Create Ingredient Category</title>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Create Ingredient Category</h1>
      <form action="{{ route('categories_ingredients.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
      </form>
    </div>
  </div>
</div>
@endsection