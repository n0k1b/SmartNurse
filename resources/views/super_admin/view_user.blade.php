@extends('super_admin.app')

@section('title')

<h2 class="header-title">Form Layouts</h2>

@endsection

@section('content')

<div class="modal fade bd-example-modal" id="update_role_modal">
    <input type ="hidden" id ="user_id_role" >
    <div class="modal-dialog">
        <div class="modal-content" style="overflow-x: auto;">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">


                <div class="card" style="overflow-x: auto;">

                    <div class="card-body" style="overflow-x: auto;">


                        <div class="m-t-25">
                         <div class="form-row">

                        <div class="form-group col-md-9">
                            <label for="inputEmail4">User Role</label>
                           <div>
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
                        <div class="form-group col-md-3">

                            <button type="button" id = "update_role" style="float:right" class="btn btn-primary m-t-15">Update</button>

                        </div>

                         </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal" id="update_password_modal">
    <input type ="hidden" id ="user_id_password" >
    <div class="modal-dialog">
        <div class="modal-content" style="overflow-x: auto;">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">


                <div class="card" style="overflow-x: auto;">

                    <div class="card-body" style="overflow-x: auto;">


                        <div class="m-t-25">
                         <div class="form-row">

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

                        <div class="form-group col-md-3">

                            <button type="button" id = "update_password" style="float:right" class="btn btn-primary m-t-15">Update</button>

                        </div>

                         </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4>User List</h4>

        <div class="m-t-25">
            <table id="data-table" class="table table-bordred">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="user_data_super_admin">

                </tbody>

            </table>
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
    <script src="{{asset('assets')}}/js/custom/view_user_data.js"></script>

    <script>
            $( document ).ajaxStart(function() {
                $( ".preload" ).show();
            });

            $( document ).ajaxStop(function() {
                $( ".preload" ).hide();
            });



            $('#data-table').DataTable({
                'paging' : true,
                'lengthChange': true,
                'searching' : true,
                'ordering' : false,
                'info' : false,
                'autoWidth' : false
            })




    </script>





@endsection


