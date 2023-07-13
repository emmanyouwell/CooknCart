@extends('Admin.index')
@section('content')
<title>Create Category</title>
<div class="container">
  <h2>Create Category</h2>
  <form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Category Name</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
</div>
@endsection