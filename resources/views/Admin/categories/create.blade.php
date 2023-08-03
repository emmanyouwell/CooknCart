@extends('layouts.app')

@section('content')
<title>Create Category</title>
<div class="container">
    <h2>Create Category</h2>
    <form action="{{ route('categories.store') }}" method="POST" id="createCategoryForm">
        @csrf
        <div class="cmd-3">
            <label for="name"> Name </label>
            <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name" placeholder="Enter name">
            <span id="name_error" class="text-danger"></span>
        </div>
        <div class="md-3">
            <label for="description"> Description </label>
            <input type="text" class="form-control" id="description" value="{{ old('description') }}" name="description" placeholder="Enter description">
            <span id="description_error" class="text-danger"></span>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection

