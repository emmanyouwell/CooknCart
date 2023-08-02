
$(document).ready(function() {

loadcart();
//============================================== count cart
function loadcart() {
    $.ajax({
        type: "GET",
        url: "/user/load-cart-data",
        success: function(response) {
            $('.cart-count').html('');
            $('.cart-count').html(response.count);
            // console.log(response.count)
        }
    });
}
//=========================================================== add to cart
$('.addToCartBtn').click(function(e) {
    e.preventDefault();

    var ingredient_id = $(this).closest('.ingredient_data').find('.ingredient_id').val();
    var ingredient_quantity = $(this).closest('.ingredient_data').find('.qty-input').val();
    // alert(ingredient_id);
    // alert(ingredient_quantity);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: "/user/add-to-cart",
        data: {
            'ingredient_id': ingredient_id,
            'ingredient_quantity': ingredient_quantity,
        },
        success: function(response) {
            swal({
                title:"sucess",
                text: response.status,
                type: "success"
            });
            loadcart();
        }
    });
    
});
//============================================ Increment and decrement quantity buttons
$('.increment-btn').click(function(e) {
    e.preventDefault();

    var qty_input = $(this).closest('.ingredient_data').find('.qty-input');
    var value = parseInt(qty_input.val(), 10);
    value = isNaN(value) ? 0 : value;

    if (value < 10) {
        value++;
        $(this).closest('.ingredient_data').find('.qty-input').val(value);
    }
});

$('.decrement-btn').click(function(e) {
    e.preventDefault();

    var qty_input = $(this).closest('.ingredient_data').find('.qty-input');
    var value = parseInt(qty_input.val(), 10);
    value = isNaN(value) ? 0 : value;

    if (value > 1) {
        value--;
        $(this).closest('.ingredient_data').find('.qty-input').val(value);
    }
});

// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

//============================================== Remove product from cart
$('.delete-cart-item').click(function(e){
    e.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var ingredient_id = $(this).closest('.ingredient_data').find('.ingredient_id').val();
    $.ajax({
        method: "POST",
        url: "/user/delete-cart-item",
        data:
        {
            'ingredient_id':ingredient_id,
        },
        success: function(response){
        window.location.reload();
        swal("Success", response.status, "success");
        //alert(ingredient_id);

        }
    });
});
//======================================================================= Update cart

$('.changeQuantity').click(function (e) { 
    e.preventDefault();   

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var ingredient_id = $(this).closest('.ingredient_data').find('.ingredient_id').val();
    var ingredient_quantity = $(this).closest('.ingredient_data').find('.qty-input').val();
    data = {
        'ingredient_id' : ingredient_id,
        'ingredient_quantity' : ingredient_quantity,
    }
    $.ajax({
        type: "POST",
        url: "/user/update-cart",
        data: data,
        
        success: function (response) {
             window.location.reload(); 
        swal("Success", response.status, "success");
              
        }
    });
});
});
