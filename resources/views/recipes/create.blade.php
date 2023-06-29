@extends('layouts.app')
    <title>Create Recipe</title>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create Recipe</h1>
                <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ingredients">Ingredients</label>
                        <textarea name="ingredients" id="ingredients" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="instructions">Instructions</label>
                        <textarea name="instructions" id="instructions" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>

