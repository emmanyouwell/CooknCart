@extends('layouts.app')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit Category</h1>
                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection