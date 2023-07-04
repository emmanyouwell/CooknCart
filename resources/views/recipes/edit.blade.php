@extends('layouts.app')
    <title>Edit Recipe</title>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit Recipe</h1>
                <form action="{{ route('recipes.update', $recipe->recipe_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $recipe->title }}">
                    </div>
                    <div class="form-group">
                        <label for="ingredients">Ingredients</label>
                        <textarea name="ingredients" id="ingredients" class="form-control">{{ $recipe->ingredients }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="instructions">Instructions</label>
                        <textarea name="instructions" id="instructions" class="form-control">{{ $recipe->instructions }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        @if ($recipe->image)
                            <img src="{{ Storage::url($recipe->image) }}" width="100">
                        @endif
                        <input type="file" name="image" id="image" class="form-control-file">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection

