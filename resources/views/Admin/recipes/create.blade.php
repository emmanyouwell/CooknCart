 @extends('layouts.app')

 @section('scriptHead')
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
         integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg=="
         crossorigin="anonymous" referrerpolicy="no-referrer" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
         integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
         integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
         crossorigin="anonymous" referrerpolicy="no-referrer" />
 @endsection


 @section('content')
     <div class="container card p-3 bg-light">
         <h2>Create Recipe</h2>
         <form action="{{(auth()->user()->role_as == 1) ? route('recipes.store') : route('user.recipes.store')}}" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="row row-cols-1 row-cols-md-3 g-4">
                 <div class="col-md-6 mb-4">
                     <div class="mb-3">
                         <label for="name" class="form-label">Name</label>
                         <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                             name="name" value="{{ old('name') }}">
                         @error('name')
                             <div class="invalid-feedback">{{ $message }}</div>
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
                         <label for="preptime" class="form-label">Preparation Time</label>
                         <input type="text" class="form-control @error('preptime') is-invalid @enderror" id="preptime"
                             name="preptime">{{ old('preptime') }}</input>
                         @error('preptime')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
                     <div class="mb-3">
                         <label for="cooktime" class="form-label">Cooking Time</label>
                         <input type="name" class="form-control @error('cooktime') is-invalid @enderror" id="cooktime"
                             name="cooktime">{{ old('cooktime') }}</input>
                         @error('cooktime')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
                     <div class="mb-3">
                         <label for="servings" class="form-label">Servings</label>
                         <input type="text" class="form-control @error('servings') is-invalid @enderror" id="servings"
                             name="servings">{{ old('servings') }}</input>
                         @error('servings')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
                 </div>
             </div>
             <div class="mb-3">
                 <table class="table table-bordered">
                 <table class="table table-bordered">
                     <tr>
                         <th>Instructions</th>
                         <th>Action</th>
                     </tr>
                     @php
                         $i = 0;
                         $i = 0;
                     @endphp
                     <tbody id="instructions">
                         <tr>

                             <td><input type="text" placeholder="Enter instruction"
                                     class="form-control @error('instruction') is-invalid @enderror" id="instruction"
                                     name="instruction[{{ $i }}][step]" value=""></input>
                             </td>
                             <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
                             </td>

                             @php
                                 $i++;
                             @endphp
                         </tr>
                     </tbody>
                     <tr>
                         <td colspan=2><button type="button" name="add" id="dynamic-ar"
                                 class="btn btn-outline-primary">Add
                                 steps</button></td>
                     </tr>
                 </table>


             </div>
             <div class="row row-cols-1 row-cols-md-3 g-4">
                 <div class="col-md-6 mb-4">
                     <div class="mb-3">
                         <label for="category_id" class="form-label">Category</label>
                         <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                             name="category_id">
                             <option value="">Select Category</option>
                             @foreach ($categories as $id => $name)
                                 <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>
                                     {{ $name }}</option>
                             @endforeach
                         </select>
                         @error('category_id')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
                 </div>
                 <div class="col-md-6 mb-4">
                     <div class="mb-3">
                         <label for="tags" class="form-label">Select Ingredients:</label>
                         <select class="tags form-control @error('tags') is-invalid @enderror" id="tags" name="tags[]"
                             multiple="multiple">
                             @foreach ($ingredients as $ingredient)
                                 <option value="{{ $ingredient->id }}"
                                     {{ in_array($ingredient->id, old('tags', [])) ? 'selected' : '' }}>
                                     {{ $ingredient->name }}
                                 </option>
                             @endforeach
                         </select>
                         @error('tags')
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
             <button type="submit" class="btn btn-primary">Submit</button>
         </form>
     </div>
 @endsection
 @section('scriptFoot')
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
     <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
         integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script type="text/javascript">
         var i = 0;
         $(document).ready(function(){
            $('#back').hide();
         });
         $("#dynamic-ar").click(function() {
             ++i;
             $("#instructions").append('<tr><td><input type="text" name="instruction[' + i +
                 '][step]" placeholder="Enter instructions" class="form-control @error('instruction') is-invalid @enderror" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
             );

         });

         $(document).on('click', '.remove-input-field', function() {
             $(this).parents('tr').remove();
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
     <script>
         $(document).ready(function() {
             $('.tags').select2({
                 placeholder: 'select',
                 allowClear: true,
             });
             $("#tags").select2({
                 ajax: {
                     url: "{{ route('get-ingredient') }}",
                     type: "post",
                     delay: 250,
                     dataType: 'json',
                     data: function(params) {
                         return {
                             name: params.term,
                             "_token": "{{ csrf_token() }}",
                         };
                     },
                     processResults: function(data) {
                         return {
                             results: $.map(data, function(item) {
                                 return {
                                     id: item.id,
                                     text: item.name,
                                 }
                             })
                         }
                     },
                 },
             });
         });
     </script>
 @endsection
 {{-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.2/css/bootstrap.min.css" integrity="sha512-CpIKUSyh9QX2+zSdfGP+eWLx23C8Dj9/XmHjZY2uDtfkdLGo0uY12jgcnkX9vXOgYajEKb/jiw67EYm+kBf+6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="container">
        <h2>Create Recipe</h2>

        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="instruction">Instruction</label>
                <textarea class="form-control" id="instruction" name="instruction" required></textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 offset-md-3 form-group">
                {{-- <label for="ingredients">Select Ingredients:</label><br>
            @foreach ($ingredients as $ingredient)
                <label>
                    <input type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}">
                    {{ $ingredient->name }}
                </label><br>
            @endforeach 
                <label for="ingredients">Select Ingredients:</label><br>
                <select class="tags form-control" id="tags" name="tags[]" multiple="multiple"></select>
                @error('tags')
                    <label for="" class="text-danger">{{ $message }}</label>
                @enderror
            </div>


            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
   
    <script>
        $(document).ready(function() {
            $('.tags').select2({
                placeholder: 'select',
                allowClear: true,
            });
            $("#tags").select2({
                ajax: {
                    url: "{{ route('get-ingredient') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.name,
                                }
                            })
                        }
                    },
                },
            });
        });
    </script>
   
</body>

</html> --}}
