@extends('layouts.app')
@section('content')
    {{-- ===========================================================================CREATE============================================================================================ --}}

    <!--  Modal for create a new category -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Category</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Create  form 'name' and 'description' -->
                    <form id="createCategoryForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" id="create_name" class="form-control" required>
                            <span id="name_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="create_description" class="form-control mb-3" required></textarea>
                            <span id="description_error" class="text-danger"></span>
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
    {{-- ================================================================================================================================================================================== --}}

    {{-- ===============================================================================TABLE======================================================================================= --}}
    <!-- Table to display the categories list -->
    <div class="container">
        <!-- Button creatine a new category -->
        <h2>Recipe Categories</h2>
        
        <div class="mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                Create Category
            </button>
        </div>
        <div class="btn-group mb-3" role="group" aria-label="Basic outlined example">
            <a href="{{ route('categories.import') }}" class="btn btn-outline-primary">Upload</a>
            <a href="{{ route('categories.export') }}" class="btn btn-outline-primary">Export</a>
        </div>
            <table class="table-bordered" id="categoriesTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <!-- Button to edit a category -->
                                <button type="button" class="btn btn-primary edit-btn" data-toggle="modal"
                                    data-target="#editModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                    data-description="{{ $category->description }}">
                                    Edit
                                </button>
                                <!-- Form to delete a category -->
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    {{-- ================================================================================================================================================================================== --}}

    {{-- ==========================================================================EDIT=========================================================================================== --}}
    <!--  Modal edit category -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                        {{-- <span aria-hidden="true">&times;</span> --}}

                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <!-- update 'name' and 'description' -->
                    <form id="editCategoryForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_name">Category Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                            <span id="edit_name_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Description</label>
                            <textarea name="description" id="edit_description" class="form-control" required></textarea>
                            <span id="edit_description_error" class="text-danger"></span>
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
    {{-- ================================================================================================================================================================================== --}}
@endsection

@section('scriptFoot')
<script>
    $(document).ready(function() {
        // datatables
        $('#categoriesTable').DataTable();

        // Create Category - Click event
        $("#createCategoryBtn").on("click", function() {
            const form = $("#createCategoryForm");
            const categoryName = $("#create_name").val();
            const categoryDescription = $("#create_description").val();

            // Basic validation
            if (!categoryName) {
                $("#name_error").text("Category name is required.");
                return;
            } else {
                $("#name_error").text("");
            }

            if (!categoryDescription) {
                $("#description_error").text("Description is required.");
                return;
            } else {
                $("#description_error").text("");
            }

            // Perform AJAX request if validation passes
            $.ajax({
                type: "POST",
                url: "{{ route('categories.store') }}",
                data: form.serialize(),
                success: function(response) {
                    console.log("Category created successfully!");
                    $("#createModal").modal("hide");
                    location.reload();
                },
                error: function(error) {
                    console.error("Error creating category:", error);
                },
            });
        });

        // Edit Category - Click event
        $("#updateCategoryBtn").on("click", function() {
            const form = $("#editCategoryForm");
            const categoryId = $("#editModal").data('id');
            const url = `{{ route('categories.update', ':id') }}`.replace(':id', categoryId);

            // Basic validation
            const editCategoryName = $("#edit_name").val();
            const editCategoryDescription = $("#edit_description").val();

            if (!editCategoryName) {
                $("#edit_name_error").text("Category name is required.");
                return;
            } else {
                $("#edit_name_error").text("");
            }

            if (!editCategoryDescription) {
                $("#edit_description_error").text("Description is required.");
                return;
            } else {
                $("#edit_description_error").text("");
            }

            // Perform AJAX request if validation passes
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(response) {
                    console.log("Category updated successfully!");
                    $("#editModal").modal("hide");
                    location.reload();
                },
                error: function(error) {
                    console.error("Error updating category:", error);
                },
            });
        });

        // Populate data for edit modal
        $(".edit-btn").on("click", function() {
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
