$(function() {

    $(".preload").hide();
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    })


    $("#name_error").hide();
    $("#email_error").hide();
    $("#password_error").hide();
    $("#r_password_error").hide();
    $("#user_role_error").hide();

    var error = true;



    $("#name").focusout(function() {

        name_check();

    });

    $("#email").focusout(function() {
        email_check();



    });


    $("#password").focusout(function() {

        password_check();
    });


    $("#r-password").focusout(function() {

        r_password_check();

    });


    function email_check() {

        if ($("#email").val().length == 0)

        {
            $("#email_error").html("Email field is required");
            $("#email_error").show();
            error = true;
            //alert('false1');
        } else {


            var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

            if (!pattern.test($("#email").val())) {
                $("#email_error").html("Invalid Email Address");
                $("#email_error").show();
                //return false;
                error = true;

                // alert('false2');
                //return false;
            } else {
                //$("#email_error").hide();

                var email = $("#email").val();
                var formData = new FormData();
                formData.append('email', email);
                formData.append('email_check', 'email_check');

                $.ajax({
                    processData: false,
                    contentType: false,
                    data: formData,
                    type: "post",
                    url: "check_email_validity",
                    success: function(data) {
                        var msg = $.trim(data);
                        //alert(msg);

                        if (msg == 'not_ok') {
                            $("#email_error").html("Email Already Exist! Please try with another email");
                            $("#email_error").show();
                            error = true;
                            //return false;
                            //alert('false3');
                        } else {
                            //alert('true');
                            $("#email_error").hide();
                            error = false;
                            //return true;

                        }

                    }
                });

            }
        }

    }


    function name_check() {

        if ($("#name").val().length == 0)

        {
            $("#name_error").html("name field is required");
            $("#name_error").show();
            error = true;
            // return false;
        } else {
            $("#name_error").hide();
            error = false;
            //return true;
        }

    }

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









    $("#user_creation").on('click', function() {



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


        name_check();
        email_check();
        password_check();
        r_password_check();

        var formdata = new FormData();

        formdata.append('name', $("#name").val());
        formdata.append('email', $("#email").val());
        formdata.append('password', $("#password").val());
        formdata.append('user_role', user_role);

        if (!error && user_role.length > 0) {

            $.ajax({
                processData: false,
                contentType: false,
                url: "create_user",
                type: 'POST',
                data: formdata,
                success: function(data, status) {

                    var msg = $.trim(data);
                    if (msg != "ok") {


                        alert('Some error occured. Please try again');
                    } else {
                        alert('User Create Successfully');
                        location.reload();
                    }



                },



            });

        } else {
            alert('Some error occured. Please try again');
        }






    });


})