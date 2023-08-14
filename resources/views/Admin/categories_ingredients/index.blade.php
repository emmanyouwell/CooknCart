@extends('layouts.app')
@section('content')

    <div class="container">
        <h2>Ingredients Categories</h2>
        <div class="mb-3">
            <a href="{{ route('categories_ingredients.create') }}" class="btn btn-primary">Add Ingredient Category</a>
        </div>
        <div class="btn-group mb-3" role="group" aria-label="Basic outlined example">
            <a href="{{ route('categories_ingredients.import') }}" class="btn btn-outline-primary">Upload</a>
            <a href="#" class="btn btn-outline-primary">Export</a>
        </div>
        <table id="categories_ingredients-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
@section('scriptFoot')
    <script>
        $(function() {
            $('#categories_ingredients-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories_ingredients.index') }}",
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
