@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Recipes</h2>
        <div align="right">
            <a href="{{ route('recipes.create') }}" class="btn btn-success btn-sm">Add Recipe</a>
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
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#recipe_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('recipes.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'instruction', name: 'instruction'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>

