@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ingredients</h2>
        <div class="mb-3">
            <a href="{{ route('ingredients.create') }}" class="btn btn-primary">Add Ingredient</a>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#ingredient_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ingredients.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                {
                    data: 'image',
                    name: 'image',
                    render: function (data) {
                        return '<img src="' + data + '" height="50" />';
                    }
                },
                { data: 'quantity', name: 'quantity' },
                { data: 'price', name: 'price' },
                { data: 'category', name: 'category.name' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>

    

