@extends('layouts.app')
    <title>Create Category</title>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create Category</h1>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>

