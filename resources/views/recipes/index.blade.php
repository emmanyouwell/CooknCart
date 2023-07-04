@extends('layouts.app')
    <title>Recipes</title>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Recipes</h1>
                <a href="{{ route('recipes.create') }}" class="btn btn-success mb-2">Create Recipe</a>
                <table class="table" id="recipeTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Ingredients</th>
                            <th>Instructions</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#recipeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('recipes.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'ingredients',
                        name: 'ingredients'
                    },
                    {
                        data: 'instructions',
                        name: 'instructions'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, full, meta) {
                        return "<img src='" + "{{ asset('storage') }}/" + data + "' height='50' />";
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

