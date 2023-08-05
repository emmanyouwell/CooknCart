@extends('layouts.app')
@section('content')
    {{-- <div class="container">
        <h2>Categories</h2>
        <div class="mb-3">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
        </div>
        <table id="categories-table" class="table table-striped">
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
    </div> --}}
    <!-- Button to trigger the modal for creating a new category -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
        Create Category
    </button>

    <!-- The Modal for creating a new category -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add a form here to capture 'name' and 'description' -->
                    <form id="createCategoryForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="createCategoryBtn">Save Category</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table to display the categories list -->
    <table class="table" id="categoriesTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <!-- Button to trigger the modal for editing a category -->
                        <button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target="#editModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-description="{{ $category->description }}">
                            Edit
                        </button>
                        <!-- Form to delete a category -->
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- The Modal for editing a category -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add a form here to update 'name' and 'description' -->
                    <form id="editCategoryForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_name">Category Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Description</label>
                            <textarea name="description" id="edit_description" class="form-control" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateCategoryBtn">Update Category</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize DataTables
            $('#categoriesTable').DataTable();

            // Handle the form submission when clicking the "Save Category" button in create modal
            $("#createCategoryBtn").on("click", function () {
                const form = $("#createCategoryForm");
                $.ajax({
                    type: "POST",
                    url: "{{ route('categories.store') }}",
                    data: form.serialize(),
                    success: function (response) {
                        console.log("Category created successfully!");
                        $("#createModal").modal("hide");
                        location.reload();
                    },
                    error: function (error) {
                        console.error("Error creating category:", error);
                    },
                });
            });

            // Handle editing category data when clicking the "Update Category" button in edit modal
            $("#updateCategoryBtn").on("click", function () {
                const form = $("#editCategoryForm");
                const categoryId = $("#editModal").data('id');
                const url = `{{ route('categories.update', ':id') }}`.replace(':id', categoryId);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function (response) {
                        console.log("Category updated successfully!");
                        $("#editModal").modal("hide");
                        location.reload();
                    },
                    error: function (error) {
                        console.error("Error updating category:", error);
                    },
                });
            });

            // Populate data in the edit modal when it is shown
            $(".edit-btn").on("click", function () {
                const categoryId = $(this).data('id');
                const categoryName = $(this).data('name');
                const categoryDescription = $(this).data('description');

                $("#editModal").data('id', categoryId);
                $("#edit_name").val(categoryName);
                $("#edit_description").val(categoryDescription);
            });
        });
    </script>
  
@endsection

@section('scriptFoot')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            $('#categories-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.index') }}",
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
    </script> --}}
@endsection
