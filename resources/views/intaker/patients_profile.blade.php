@extends('intaker.app')

@section('title')

<h2 class="header-title">Form Layouts</h2>

@endsection

@section('content')

<div class="card">
        <div class="card-body">
            <h4>Create Patients Profile</h4>

            <div class="m-t-25" >
                <form>

                    <h4>Member Control</h4>
                    <hr>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Insurance Plan<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="insurance_plan" placeholder="Test">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Date Received<span style="color: red;">*</span></label>
                            {{--  <input type="text" class="form-control" id="date_received" placeholder="29.10.2019">  --}}
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input type="text" class="form-control datepicker-input" placeholder="Pick a date" id="date_received">
                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Date Need to finish<span style="color: red;">*</span></label>
                            {{--  <input type="text" class="form-control" id="date_need_to_be_finished" placeholder="05.11.2019">  --}}
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input type="text" class="form-control datepicker-input" placeholder="Pick a date" id="date_need_to_be_finished">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Assesment Type<span style="color: red;">*</span></label>
                             <select id="assesment_type" class="form-control">
                                                <option selected>Choose...</option>
                                                <option value="primary">Primary Assesment</option>
                                                <option value="re-assesment">Re Assesment</option>
                                </select>
                        </div>

                    </div>


                    <h4>Personal Information</h4>
                    <hr>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Medicaid Id</label>
                            <input type="text" class="form-control" id="medicaid_id" placeholder="p-100">
                        </div>


                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Member Id</label>
                            <input type="text" class="form-control" id="member_id" placeholder="50">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">First Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="first_name" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Last Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="last_name" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Sex<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="sex" placeholder="Male or Female">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Date of Birth<span style="color: red;">*</span></label>
                            {{--  <input type="text" class="form-control" id="date_of_birth" placeholder="02.02.2000">  --}}
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input type="text" class="form-control datepicker-input" placeholder="Pick a date" id="date_of_birth">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Primary Language</label>
                            <input type="text" class="form-control" id="primary_language" placeholder="Bangla">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Cell Phone</label>
                            <input type="text" class="form-control" id="cell_phone" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Home Phone</label>
                            <input type="text" class="form-control" id="home_phone" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Marital Status</label>
                            <input type="text" class="form-control" id="marital_status" placeholder="UM">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="xyz@gmail.com">
                        </div>

                    </div>


                    <h4>Address</h4>
                    <hr>
                    <div class="form-row">


                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Address<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="address" placeholder="test">
                        </div>



                        <div class="form-group col-md-6">
                             <label for="inputEmail4">City</label>
                            <input type="text" class="form-control" id="city" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                             <label for="inputEmail4">Select State or Region</label>
                            <input type="text" class="form-control" id="state" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                             <label for="inputEmail4">Zip Code</label>
                            <input type="text" class="form-control" id="zip_code" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                             <label for="inputEmail4">Country</label>
                            <input type="text" class="form-control" id="country" placeholder="">
                        </div>

                    </div>







                    <button type="button" id = "patient_form_submit" style="float:right" class="btn btn-primary">Create Account</button>
                </form>
            </div>



        </div>
        <hr>
        <h4 style="text-align:center">OR</h4>

        <div class="card">
            <div class="card-body">

                <h4>Upload the batch file</h4>

                <div class="m-t-25">
                    <form method="post" enctype="multipart/form-data" action="{{ url('import') }}">
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
                                                    <p style="color:red">Some record has missing data. Please fill it up and re-upload</p>
                                                    <div class="m-t-25">
                                                        <table id="data-table" class="table table-bordred">
                                                            <thead>
                                                                <tr>
                                                                    <th>Row no</th>
                                                                    <th>Insurance Plan</th>
                                                                    <th>Date of Received</th>
                                                                    <th>Date Nedd to Fiinished</th>
                                                                    <th>Medicaid Id</th>
                                                                    <th>Member Id</th>
                                                                    <th>Frst Name</th>
                                                                    <th>Last Name</th>
                                                                    <th>Sex</th>
                                                                    <th>Date of Birth</th>
                                                                    <th>Language</th>
                                                                    <th>Cell Phone</th>
                                                                    <th>Home Phone</th>
                                                                    <th>Marital Status</th>
                                                                    <th>Email</th>
                                                                    <th>Address</th>
                                                                    <th>City</th>
                                                                    <th>State</th>
                                                                    <th>Zip Code</th>
                                                                    <th>Coutry</th>
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
    <script src="{{asset('assets')}}/vendors/select2/select2.min.js"></script>
    <script src="{{asset('assets')}}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/form-elements.js"></script>
    <script src="{{asset('assets')}}/vendors/quill/quill.min.js"></script>
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

        $("#patient_form_submit").on('click',function()
        {

            var insurance_plan = $("#insurance_plan").val();
            var date_received = $("#date_received").val();
            var date_need_to_be_finished = $("#date_need_to_be_finished").val();
            var medicaid_id = $("#medicaid_id").val();
            var member_id = $("#member_id").val();
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var sex = $("#sex").val();
            var date_of_birth = $("#date_of_birth").val();
            var primary_language = $("#primary_language").val();
            var cell_phone = $("#cell_phone").val();
            var home_phone = $("#home_phone").val();
            var marital_status = $("#marital_status").val();
            var email = $("#email").val();
            var address = $("#address").val();
            var city = $("#city").val();
            var state = $("#state").val();
            var zip_code = $("#zip_code").val();
            var country = $("#country").val();
            var assesment_type = $("#assesment_type").val();
            //alert(assesment_type);

            var formdata = new FormData();
            formdata.append('insurance_plan',insurance_plan);
            formdata.append('date_received',date_received);
            formdata.append('date_need_to_be_finished',date_need_to_be_finished);
            formdata.append('medicaid_id',medicaid_id);
            formdata.append('member_id',member_id);
            formdata.append('first_name',first_name);
            formdata.append('last_name',last_name);
            formdata.append('sex',sex);
            formdata.append('date_of_birth',date_of_birth);
            formdata.append('primary_language',primary_language);
            formdata.append('cell_phone',cell_phone);
            formdata.append('home_phone',home_phone);
            formdata.append('marital_status',marital_status);
            formdata.append('email',email);
            formdata.append('address',address);
            formdata.append('city',city);
            formdata.append('state',state);
            formdata.append('zip_code',zip_code);
            formdata.append('country',country);
            formdata.append('assesment_type',assesment_type);

            $.ajax({
      processData: false,
      contentType: false,
      url:"{{url('patient_information_upload')}}",
      type:'POST',
      data: formdata,
      success:function(data, status){

        alert('Patient Information Uploaded Successfully');

    //  alert("Notice send successfully");
      location.reload();
  },



    });

            //alert(insurance_plan+" "+date_received+" "+date_need_to_be_finished+""+medicaid_id+" "+member_id+" "+first_name+" "+last_name+" "+sex+" "+date_of_birth+" "+primary_language+" "+ cell_phone+" "+home_phone+" "+marital_status+" "+email+" "+address+" "+city+" "+state+" "+zip_code+" "+country+" "+assesment_type);

        });

        $("#upload").on('click',function(){

               var formdata = new FormData();
               formdata.append('select_file',$('#customFile')[0].files[0]);
     $.ajax({
      processData: false,
      contentType: false,
      url:"{{url('import')}}",
      type:'POST',
      data: formdata,
      success:function(data, status){

        var msg = $.trim(data);
        if(msg != "ok")
        {
            $('#missing_data').html(data);
            $('#excel_error_modal').modal('show');
        }
        else
        {
            alert('Data uploaded successfully');
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


