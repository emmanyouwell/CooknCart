@extends('layouts.app')
@section('content')
    <div class="container card bg-light p-3">
        <h2>Create Ingredient</h2>
        <form action="{{ route('ingredients.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col-md-6 mb-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Ingredient Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                            name="quantity" value="{{ old('quantity') }}">
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" value="{{ old('price') }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="ingredient_category_id" class="form-label">Category</label>
                        <select class="form-control @error('ingredient_category_id') is-invalid @enderror"
                            id="ingredient_category_id" name="ingredient_category_id">
                            <option value="">Select Category</option>
                            @foreach ($categories as $id => $name)
                                <option value="{{ $id }}"
                                    {{ old('ingredient_category_id') == $id ? 'selected' : '' }}>{{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ingredient_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>




            <div class="mb-3" id="image-div">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <a href="#image-div" id="moreImage" class="text-primary">Add more images?</a>
                <a href="#image-div" id="back" class="text-primary">Nevermind.</a>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection

@section('scriptFoot')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#back').hide();
        });

        $("#moreImage").click(function() {
             $('#image-div').append('<div class="my-3 more"><label for="images">Add multiple images:</label><input type="file" class="form-control" name="images[]" id="images" multiple></div>');
             $(this).hide();
             $('#back').show();

         });

         $(document).on('click', '#back', function(){
            $('.more').remove();
            $(this).hide();
            $('#moreImage').show();
         });
    </script>
@endsection
