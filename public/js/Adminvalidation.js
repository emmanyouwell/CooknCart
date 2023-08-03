$(document).ready(function () {
    $('#createCategoryForm').submit(function (e) {
        e.preventDefault();

        var name = $('#name').val().trim();
        var description = $('#description').val().trim();

        var name_error = "";
        var description_error = "";

        if (!name) {
            name_error = "Name is required";
        }

        if (!description) {
            description_error = "Description is required";
        }


        $('#name_error').text(name_error);
        $('#description_error').text(description_error);



        if (name_error || description_error) {
            return false;
        }
        $(this).off('submit').submit(); 
    });
});

