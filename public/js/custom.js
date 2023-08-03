$(document).ready(function () {
    loadcart();
    loadwishlist();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //============================================== count cart
    function loadcart() {
        $.ajax({
            type: "GET",
            url: "/user/load-cart-data",
            success: function (response) {
                $(".cart-count").html("");
                $(".cart-count").html(response.count);
                // console.log(response.count)
            },
        });
    }
    //=================================================== count wishlist
    function loadwishlist()
    {
        $.ajax({
            type: "GET",
            url: "/user/load-wishlist-data",
            success: function (response) {
                $('.wishlist-count').html("");
                $('.wishlist-count').html(response.count);
            }
        });
    }
    //=========================================================== add to cart
    $(".addToCartBtn").click(function (e) {
        e.preventDefault();

        var ingredient_id = $(this)
            .closest(".ingredient_data")
            .find(".ingredient_id")
            .val();
        var ingredient_quantity = $(this)
            .closest(".ingredient_data")
            .find(".qty-input")
            .val();
        // alert(ingredient_id);
        // alert(ingredient_quantity);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "/user/add-to-cart",
            data: {
                ingredient_id: ingredient_id,
                ingredient_quantity: ingredient_quantity,
            },
            success: function (response) {
                swal({
                    title: "sucess",
                    text: response.status,
                    type: "success",
                });
                loadcart();
            },
        });
    });
    //============================================ Increment and decrement quantity buttons
    $(".increment-btn").click(function (e) {
        e.preventDefault();

        var qty_input = $(this).closest(".ingredient_data").find(".qty-input");
        var value = parseInt(qty_input.val(), 10);
        value = isNaN(value) ? 0 : value;

        if (value < 10) {
            value++;
            $(this).closest(".ingredient_data").find(".qty-input").val(value);
        }
    });

    $(".decrement-btn").click(function (e) {
        e.preventDefault();

        var qty_input = $(this).closest(".ingredient_data").find(".qty-input");
        var value = parseInt(qty_input.val(), 10);
        value = isNaN(value) ? 0 : value;

        if (value > 1) {
            value--;
            $(this).closest(".ingredient_data").find(".qty-input").val(value);
        }
    });

    //============================================== Remove product from cart
    $(".delete-cart-item").click(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var ingredient_id = $(this)
            .closest(".ingredient_data")
            .find(".ingredient_id")
            .val();
        $.ajax({
            method: "POST",
            url: "/user/delete-cart-item",
            data: {
                ingredient_id: ingredient_id,
            },
            success: function (response) {
                swal("Success", response.status, "success");
                window.location.reload();
            },
        });
    });
    //======================================================================= Update cart when Chnaging quantity

    $(".changeQuantity").click(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var ingredient_id = $(this)
            .closest(".ingredient_data")
            .find(".ingredient_id")
            .val();
        var ingredient_quantity = $(this)
            .closest(".ingredient_data")
            .find(".qty-input")
            .val();
        data = {
            ingredient_id: ingredient_id,
            ingredient_quantity: ingredient_quantity,
        };
        $.ajax({
            type: "POST",
            url: "/user/update-cart",
            data: data,
            success: function (response) {
                swal("Success", response.status, "success");
                loadcart();
                window.location.reload();
            },
        });
    });

    //======================================================================================== add to wishlist
    $(".addToWishlist").click(function (e) {
        e.preventDefault();

        
        var ingredient_id = $(this)
            .closest(".ingredient_data")
            .find(".ingredient_id")
            .val();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

        $.ajax({
            method: "POST",
            url: "/user/add-to-wishlist",
            data: {
                ingredient_id: ingredient_id,
            },
            success: function (response) {
                swal(response.status);
                loadwishlist();
            },
        });
    });
//================================================= delete from wishlist
$('.remove-wishlist-item').click(function (e) { 
    e.preventDefault();
    var ingredient_id = $(this).closest('.ingredient_data').find('.ingredient_id').val();

    $.ajax({
        method: "POST",
        url: "/user/delete-wishlist-item",
        data:
        {
            'ingredient_id':ingredient_id,
        },
        success: function(response){
            window.location.reload();
            swal("", response.status, "success");
            // alert(ingredient_id);
        }
    });
});

});
