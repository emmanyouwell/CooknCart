@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Ingredients</div>

                <div class="card-body">
                    <a href="{{ route('ingredients.create') }}" class="btn btn-primary mb-3">Create Ingredient</a>

                    <table id="ingredients-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    $(function () {
        $('#ingredients-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ingredients.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        if (data) {
                            return '<img src="{{ asset('storage') }}/' + data + '" alt="Ingredient Image" width="100">';
                        } else {
                            return '';
                        }
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>

