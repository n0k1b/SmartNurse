@extends('intaker.app')

@section('title')

<h2 class="header-title">Form Layouts</h2>

@endsection

@section('content')

<div class="card">
        <div class="card-body">
            <h4>Create Nurse Profile</h4>

            <div class="m-t-25" >
                <form>






                    <h4>Nurse Information</h4>
                    <hr>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="John">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Gender</label>


                            <div>
                                <input id="gender" name="gender" type="radio" value="male">
                                <label for="radio2">Male</label>
                                <input id="gender" name="gender" type="radio" value="female">
                                <label for="radio2">Female</label>

                                <input id="gender" name="gender" type="radio" value="other">
                                <label for="radio2">Other</label>
                            </div>

                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Language</label>
                            <input type="text" class="form-control" id="language" placeholder="English">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Trained Plan</label>
                            <input type="text" class="form-control" id="trained_plan">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email Address</label>
                            <input type="text" class="form-control" id="email" placeholder="john@gmail.com">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Nurse Registration No</label>
                            <input type="text" class="form-control" id="registration_no" placeholder="1234">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Phone number</label>
                            <input type="text" class="form-control" id="phone_number" placeholder="1234">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="323 ARLINGTON AVE">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">City</label>
                            <input type="text" class="form-control" id="city" placeholder="Brooklyn">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Country</label>
                            <input type="text" class="form-control" id="country" placeholder="Kings">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="11208">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Prefered Days</label>
                           <div >
                                <input class="prefered_day" type="checkbox" value = "sunday" >
                                <label for="checkbox1">Sunday</label>

                                <input class="prefered_day" type="checkbox" value = "monday" >
                                <label for="checkbox1">Monday</label>

                                <input class="prefered_day" type="checkbox" value = "tuesday" >
                                <label for="checkbox1">Tuesday</label>

                                <input class="prefered_day" type="checkbox"value = "wednesday" >
                                <label for="checkbox1">Wednesday</label>
                                <br>

                                <input class="prefered_day" type="checkbox"value = "thursday" >
                                <label for="checkbox1">Thursday</label>

                                <input class="prefered_day" type="checkbox" value = "friday" >
                                <label for="checkbox1">Friday</label>

                                <input class="prefered_day" type="checkbox" value = "saturday">
                                <label for="checkbox1">Saturday</label>
                            </div>


                        </div>


                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Prefered Start Times</label>
                            <input type="text" class="form-control" id="start_time" placeholder="10">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Prefered End Times</label>
                            <input type="text" class="form-control" id="end_time" placeholder="15">
                        </div>


                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Prefered Notes</label>
                            <input type="text" class="form-control" id="note">
                        </div>







                    </div>










                    <button type="button" id = "nurse_information_upload" style="float:right" class="btn btn-primary">Create Account</button>
                </form>
            </div>



        </div>
        <hr>
        <h4 style="text-align:center">OR</h4>

        <div class="card">
            <div class="card-body">

                <h4>Upload the batch file</h4>

                <div class="m-t-25">
                    <form method="post" enctype="multipart/form-data" action="{{ url('nurse_file_import') }}">
                        @csrf
                    <div class="row">
                        <div class="col-md-7">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="select_file" id="customFile" multiple>

                                <label class="custom-file-label" for="customFile">Choose file</label>

                            </div>
                        </div>
                        <div class="col-md-3 file_name_shown">

                            <button type="button" id="upload" class="btn btn-primary">Upload</button>

                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl">Upload</button> --}}

                            <div class="modal fade bd-example-modal-xl" id="excel_error_modal">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content" style="overflow-x: auto;">
                                        <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal">
                                                <i class="anticon anticon-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card" style="overflow-x: auto;">
                                                <div class="card-body" style="overflow-x: auto;">
                                                    <h4>Missing Data</h4><span style="float:right" ><a href="{{ url('export') }}"><button type="button" id="export" class="btn btn-primary">Download Missing Data</button></a></span>
                                                    <p style="color:red">This record has missing data. Please fill it up and re-upload</p>
                                                    <div class="m-t-25">
                                                        <table id="data-table" class="table table-bordred">
                                                            <thead>
                                                                <tr>
                                                                    <th>Row no</th>
                                                                    <th>Name</th>
                                                                    <th>Gender</th>
                                                                    <th>Language</th>
                                                                    <th>Trained Plan</th>
                                                                    <th>Email Address</th>
                                                                    <th>Nurse Registration No</th>
                                                                    <th>Phone_number</th>
                                                                    <th>Address</th>
                                                                    <th>City</th>
                                                                    <th>Country</th>
                                                                    <th>Prefereed Days</th>
                                                                    <th>Prefered Location</th>
                                                                    <th>Prefered Start Times</th>
                                                                    <th>Prefered End Times</th>
                                                                    <th>Prefered Notes</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody id="missing_data">


                                                            </tbody>
                                                            {{-- <tfoot>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Position</th>
                                                                    <th>Office</th>
                                                                    <th>Age</th>
                                                                    <th>Start date</th>
                                                                    <th>Salary</th>
                                                                </tr>
                                                            </tfoot> --}}
                                                        </table>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('assets')}}/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="{{asset('assets')}}/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/datatables.js"></script>

    <!-- Core JS -->
    <script src="{{asset('assets')}}/js/app.min.js"></script>

    <script>
            $( document ).ajaxStart(function() {
                window.swal({
                    title: "Loading...",
                    text: "Please wait",
                    imageUrl: "{{asset('image')}}/loading_spinner.gif",

                    button: false,
                    closeOnClickOutside: false,
                      closeOnEsc: false
                  });

            });

            $( document ).ajaxStop(function() {
                swal.close();
            });


        $(function () {


            $.ajaxSetup({

headers: {

    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});


        })

        $("#nurse_information_upload").on('click',function(){
            var prefered_day = [];
        $('.prefered_day:checked').each(function(){
            prefered_day.push($(this).val().charAt(0).toUpperCase() + $(this).val().slice(1));
        });

       // alert(prefered_day);

      //var gender =   $("#gender:checked").val();
      //alert (gender);

        var formdata = new FormData();
        formdata.append("name",$("#name").val());
        formdata.append("gender",$("#gender:checked").val());
        formdata.append("language",$("#language").val());
        formdata.append("trained_plan",$("#trained_plan").val());
        formdata.append("email",$("#email").val());
        formdata.append("registration_no",$("#registration_no").val());
        formdata.append("phone_number",$("#phone_number").val());
        formdata.append("address",$("#address").val());
        formdata.append("city",$("#city").val());
        formdata.append("country",$("#country").val());
        formdata.append("zip",$("#zip").val());
        formdata.append("prefered_day",prefered_day);
        formdata.append("start_time",$("#start_time").val());
        formdata.append("end_time",$("#end_time").val());
        formdata.append("note",$("#note").val());


        $.ajax({
            processData: false,
            contentType: false,
            url:"{{url('nurse_information_upload')}}",
            type:'POST',
            data: formdata,
            success:function(data, status){

              alert('Nurse Information Uploaded Successfully');

          //  alert("Notice send successfully");
            location.reload();
        },



          });



        //alert(prefered_day);

        });

        $("#upload").on('click',function(){

               var formdata = new FormData();
               formdata.append('select_file',$('#customFile')[0].files[0]);
     $.ajax({
      processData: false,
      contentType: false,
      url:"{{url('nurse_file_import')}}",
      type:'POST',
      data: formdata,
      success:function(data, status){

        var msg = $.trim(data);
        if(msg != "ok")
        {
            {{--  $('#missing_data').html(data);
            $('#excel_error_modal').modal('show');  --}}

            alert('Data Uploaded Successfully');
        }
        else
        {
            alert('Data Uploaded Successfully');
        }


    //  alert("Notice send successfully");
    //  location.reload();
  },



    });


            //  $("#excel_error_modal").modal('show');

        });




        $('#customFile').on('change',function(){
            //get the file name
            var fileName = $(this).val().split('\\').pop();;
            //replace the "Choose a file" label
          $(".custom-file-label").html(fileName);
        });

        $('#data-table').DataTable({
    'paging' : true,
    'lengthChange': true,
    'searching' : false,
    'ordering' : false,
    'info' : false,
    'autoWidth' : true
  })




    </script>





@endsection


