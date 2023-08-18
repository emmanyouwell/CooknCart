@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Ingredients</h2>
        <div class="mb-3">
            <a href="{{ route('ingredients.create') }}" class="btn btn-primary">Add Ingredient</a>
        </div>
        <div class="btn-group mb-3" role="group" aria-label="Basic outlined example">
            <a href="{{ route('ingredients.import') }}" class="btn btn-outline-primary">Upload</a>
            <a href="{{ route('ingredients.export') }}" class="btn btn-outline-primary">Export</a>
        </div>
        <br />
        <table class="table table-bordered" id="ingredient_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@section('scriptFoot')
    <script>
        $(document).ready(function() {
            $('#ingredient_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ingredients.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data) {
                            return '<img src="' + data + '" height="50" />';
                        }
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'category',
                        name: 'category.name',
                        render: function(data) {
                            return data.name; // Access the nested property 'name'
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
