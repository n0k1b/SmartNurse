@extends('super_admin.app')

@section('title')

<h2 class="header-title">Form Layouts</h2>

@endsection

@section('content')

<div class="card">
        <div class="card-body">
            <h4>Create User Profile</h4>

            <div class="m-t-25" >
                <form>






                    <h4>Information</h4>
                    <hr>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="John">
                            <div class="invalid-feedback" id = "name_error">

                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="john@gmail.com">

                            <div class="invalid-feedback" id = "email_error">

                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="*****">
                            <div class="invalid-feedback" id = "password_error">

                            </div>

                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Re-type Password</label>
                            <input type="password" class="form-control" id="r-password" placeholder="*****">

                            <div class="invalid-feedback" id = "r_password_error">

                            </div>
                        </div>









                        <div class="form-group col-md-12">
                            <label for="inputEmail4">User Role</label>
                           <div style="padding-left:10px">


                            <label class="checkbox-container">Admin
                                <input class="user_role" type="checkbox" value="admin" >
                                <span class="checkmark"></span>
                              </label>

                              <label class="checkbox-container">Super Admin
                                <input class="user_role" type="checkbox" value="super_admin" >
                                <span class="checkmark"></span>
                              </label>

                              <label class="checkbox-container">Intaker
                                <input class="user_role" type="checkbox" value="intaker">
                                <span class="checkmark"></span>
                              </label>

                              <label class="checkbox-container">Scheduler
                                <input class="user_role" type="checkbox" value="scheduler">
                                <span class="checkmark"></span>
                              </label>


                            </div>

                            <div class="invalid-feedback" id = "user_role_error">

                            </div>


                        </div>



                    </div>


                    <button type="button" id = "user_creation" style="float:right" class="btn btn-primary">Create User</button>
                </form>
            </div>



        </div>


        </div>
    </div>
<script src="{{asset('assets')}}/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="{{asset('assets')}}/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/datatables.js"></script>

    <!-- Core JS -->
    <script src="{{asset('assets')}}/js/app.min.js"></script>
    <script src="{{asset('assets')}}/js/custom/user_creation.js"></script>


    <script>
            $( document ).ajaxStart(function() {
                $( ".preload" ).show();
            });

            $( document ).ajaxStop(function() {
                $( ".preload" ).hide();
            });


        {{-- $(function () {

            $(".preload").hide();
            $.ajaxSetup({

headers: {

    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});


        }) --}}

        $(function() {

            $(".preload").hide();
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });





        })













    </script>





@endsection


