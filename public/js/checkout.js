$(document).ready(function () {
    $('.validate_btn').click(function (e) { 
        e.preventDefault();

        var firstname = $('.firstname').val();
        var lastname =$('.lastname').val();
        var email =$('.email').val();
        var phone =$('.phone').val();
        var address =$('.address').val();
        var city =$('.city').val();
        var pincode =$('.pincode').val();

        var fname_error = "";
        var lname_error = "";
        var email_error = "";
        var phone_error = "";
        var city_error = "";
        var pincode_error = "";

        //firstname
        if(!firstname){
            fname_error = "First Name is required";
        }
        //lastname
        if(!lastname){
            lname_error = "Last Name is required";
        }
        //email
        if(!email){
            email_error = "Email is required";
        } else if(!validateEmail(email)){
            email_error = "Invalid email address";
        }
        //phone
        if(!phone){
            phone_error = "Phone number is required";
        } else if(!validatePhone(phone)){
            phone_error = "Invalid phone number";
        }
        //address1
        if(!address){
             address_error = "Address is required";
        }
        //city
        if(!city){
            city_error = "City is required";
        }
        //pincode
        if(!pincode){
            pincode_error = "Pincode is required";
        } else if(!validatePincode(pincode)){
            pincode_error = "Invalid pincode";
        }

        $('#fname_error').html(fname_error);
        $('#lname_error').html(lname_error);
        $('#email_error').html(email_error);
        $('#phone_error').html(phone_error);
        $('#address_error').html(address_error);
        $('#city_error').html(city_error);
        $('#pincode_error').html(pincode_error);

        if(fname_error != '' || lname_error !='' || email_error != '' || phone_error != '' || address_error != '' || city_error != ''||pincode_error != ''){
            return false;
        }
        else{

            var data = {
                'firstname':firstname,
                'lastname':lastname,
                'email':email,
                'phone':phone,
                'address':address,
                'city':city,
                'pincode':pincode
            }
            $.ajax({
                method: "POST",
                url: "/user/proceed-to-pay",
                data: data,
                success: function (response) {
                    window.location.reload();
                swal("", response.status, "success");         
                }
            });
        }

    });
});

// email validation function
function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

// phone number validation function
function validatePhone(phone) {
    var re = /^[0-9]{11}$/;
    return re.test(phone);
}

// pincode validation function
function validatePincode(pincode) {
    var re = /^[0-9]{4}$/; // Philippine postal codes have a 4-digit format
    return re.test(pincode);
}

