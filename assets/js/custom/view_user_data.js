function fetch_data() {
    $.ajax({
        processData: false,
        contentType: false,
        type: "POST",
        url: "get_user_role_super_admin",

        // data: formData,
        success: function(data, status) {


            //$("#myDiv").show();
            $('#user_data_super_admin').html(data);



        },

    });

}

function update_role(user_id) {
    //alert('hello');
    $("#user_id_role").val(user_id);
    $("#update_role_modal").modal("show");

}


function update_password(user_id) {
    //alert('hello');
    $("#user_id_password").val(user_id);
    $("#update_password_modal").modal("show");

}


function delete_user(user_id) {

    var formData = new FormData();

    formData.append('user_id', user_id);


    var conf = confirm("Are you sure");
    if (conf == true) {
        $.ajax({
            processData: false,
            contentType: false,
            url: "delete_user",
            type: "POST",
            data: formData,
            success: function(data, status) {


                location.reload();



            },

        });


    }

}

$(function() {
    var error = true;

    $("#user_role_error").hide();
    $("#password_error").hide();
    $("#r_password_error").hide();

    $(".preload").hide();
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    fetch_data();




    $("#password").focusout(function() {

        password_check();
    });


    $("#r-password").focusout(function() {

        r_password_check();

    });



    function password_check() {

        if ($("#password").val().length == 0)

        {
            $("#password_error").html("password field is required");
            $("#password_error").show();
            // return false;
            error = true;
        } else {

            if ($("#password").val().length < 8) {
                $("#password_error").html("Minimum 8 character required");
                $("#password_error").show();
                error = true;
                //return false;
                //$("#pass_error").hide();
            } else {
                $("#password_error").hide();
                // return true;
                error = false;

                // var password_reg_ex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])");
                // if (!password_reg_ex.test($("#password").val())) {
                //     $("#password_error").html("password should contain One Uppercase, One lowercase,one number,one special character");
                //     $("#password_error").show();
                //     //return false;
                // } else {
                //     $("#password_error").hide();
                // }

            }



        }



    }

    function r_password_check() {
        if ($("#r-password").val().length == 0)

        {
            $("#r_password_error").html("Retype password field is required");
            $("#r_password_error").show();
            //return false;
            error = true;
        } else {
            if ($("#password").val() != $("#r-password").val()) {
                $("#r_password_error").html("Password and retype password not match");
                $("#r_password_error").show();
                //return false;
                error = true;
            } else {
                $("#r_password_error").hide();
                //return true;
                error = false;
            }
        }


    }

    $("#update_password").on('click', function() {
        password_check();
        r_password_check();
        var formdata = new FormData();
        formdata.append('user_id', $("#user_id_password").val());
        formdata.append('password', $("#password").val());


        if (!error) {

            $.ajax({
                processData: false,
                contentType: false,
                url: "update_user_password",
                type: 'POST',
                data: formdata,
                success: function(data, status) {

                    alert('Data Updated Successfully');
                    location.reload();



                },



            });

        } else {
            alert('Some error occured. Please try again');
        }





    });

    $("#update_role").on('click', function() {

        var user_id = $("#user_id_role").val();
        var user_role = [];
        $('.user_role:checked').each(function() {
            user_role.push($(this).val());
        });
        if (user_role.length == 0) {
            $("#user_role_error").html('Please check at least one role');
            $("#user_role_error").show();
        } else {
            $("#user_role_error").hide();
        }

        var formdata = new FormData();
        formdata.append('user_role', user_role);
        formdata.append('user_id', user_id);

        if (user_role.length > 0) {

            $.ajax({
                processData: false,
                contentType: false,
                url: "update_user_role",
                type: 'POST',
                data: formdata,
                success: function(data, status) {

                    alert('Data Updated Successfully');
                    location.reload();



                },



            });

        } else {
            alert('Some error occured. Please try again');
        }





    });




})