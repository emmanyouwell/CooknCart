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
<div class="container">
    <h2>Edit Recipe</h2>
    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $recipe->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" >{{ old('description', $recipe->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="preptime" class="form-label">Preparation Time</label>
            <input type="text" class="form-control @error('preptime') is-invalid @enderror" id="preptime" name="preptime" value="{{ old('preptime', $recipe->preptime) }}"></input>
            @error('preptime')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>   <div class="mb-3">
            <label for="cooktime" class="form-label">Cooking Time</label>
            <input type="text" class="form-control @error('cooktime') is-invalid @enderror" id="cooktime" name="cooktime" value="{{ old('cooktime', $recipe->cooktime) }}" ></input>
            @error('cooktime')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>   <div class="mb-3">
            <label for="servings" class="form-label">Servings</label>
            <input type="text" class="form-control @error('servings') is-invalid @enderror" id="servings" name="servings" value="{{ old('servings', $recipe->servings) }}"></input>
            @error('servings')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <table class="table table-bordered" >
                <tr>
                    <th>Instructions</th>
                    <th>Action</th>
                </tr>
                @php
                    $ins = json_decode($recipe->instruction, true);
                    $i=0;
                @endphp
                <tbody id="instructions">
                @if ($ins!=null)
                @foreach($ins as $instruction)
                <tr>
                    
                    <td><input type="text" placeholder="Enter instruction"
                            class="form-control @error('instruction') is-invalid @enderror" id="instruction"
                            name="instruction[{{$i}}][step]" value="{{ $instruction['step']}}"></input>
                    </td>
                    <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
                    
                    @php
                    $i++;
                    @endphp
                </tr>
                
                @endforeach
                @else
                <tr>
                    
                    <td><input type="text" placeholder="Enter instruction"
                            class="form-control @error('instruction') is-invalid @enderror" id="instruction"
                            name="instruction[{{$i}}][step]" value=""></input>
                    </td>
                    <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
                    
                    @php
                    $i++;
                    @endphp
                </tr>
                @endif
            </tbody>
                <tr>
                    <td colspan=2><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add
                        steps</button></td>
                </tr>
                <input type="hidden" name="count" value={{ $i-1 }} class="instruction-count">
            </table>
            
            
            @error('instruction')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                <option value="">Select Category</option>
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}" {{ old('category_id', $recipe->category_id) == $id ? 'selected' : '' }}>
                        {{ $name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Select Ingredients:</label>
            <select class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags[]" multiple="multiple">
                @foreach ($ingredients as $tag => $ingredient)
                    <option value="{{ $tag }}" {{ in_array($tag, old('tags', json_decode($recipe->tags, true) ?: [])) ? 'selected' : '' }}>
                        {{ $ingredient }}</option>
                @endforeach
            </select>
            @error('tags')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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
                var i = parseInt($('input[name="count"]').val(),10);
                $("#dynamic-ar").click(function() {
                    ++i;
                    $("#instructions").append('<tr><td><input type="text" name="instruction[' + i +
                        '][step]" placeholder="Enter instructions" class="form-control @error('instruction') is-invalid @enderror" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
                    );
                    
                });
                $(document).on('click', '.remove-input-field', function() {
                    $(this).parents('tr').remove();
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
