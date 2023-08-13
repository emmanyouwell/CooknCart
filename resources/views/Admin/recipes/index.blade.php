@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Recipes</h2>
        <div class="mb-3">
            <a href="{{ route('recipes.create') }}" class="btn btn-primary">Add Recipe</a>
        </div>
        <br />
        <table class="table table-bordered" id="recipe_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Instruction</th>
                    {{-- <th>Ingredients</th> --}}
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@section('scriptFoot')
    <script>
        $(document).ready(function() {
            $('#recipe_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('recipes.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
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
                        data: 'instruction',
                        name: 'instruction'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data) {
                            return '<img src="' + data + '" height="50" />';
                        }
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
