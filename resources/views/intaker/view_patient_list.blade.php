@extends('intaker.app')

@section('title')

<h2 class="header-title">Form Layouts</h2>

@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <h4>Patients List</h4>

        <input type="hidden" id="hidden_patient_id">
        <input type="hidden" id="hidden_nurse_id">

        <div class="m-t-25">
            <table id="data-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Medicaid Id</th>
                        <th>Member Id</th>
                        <th>Primary Language</th>
                        <th>Phone Number</th>
                         <th>Email</th>
                        <th>Address</th>
                        <th>Status</th>
                        {{-- <th>Status</th> --}}

                    </tr>
                </thead>
                <tbody>
                    @foreach($patient_lists as $patient)
                    <?php $address = $patient->address.",".$patient->city.",".$patient->country;
                     if($patient->status=='assign')
                     {
                         $status = 'Assigned';
                     }
                     else
                     {
                         $status = 'Pending';
                     }
                    ?>
                    <tr>
                        <td>{{ $patient->first_name." ".$patient->last_name }}</td>
                        <td>{{ $patient->medicaid_id  }}</td>
                        <td>{{ $patient->member_id }}</td>
                        <td>{{ $patient->primary_language }}</td>
                        <td>{{ $patient->cell_phone }}</td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ $address}}</td>
                        <td>{{ $status}}</td>


                    </tr>
                    @endforeach

                </tbody>

            </table>
        </div>



    </div>

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
                                <div class="m-t-10">
                                    <div class="row">
                                        <div class="col-md-4">

                                            <div class="form-group">

                                                <div class="input-affix">
                                                    <i class="prefix-icon anticon anticon-calendar"></i>
                                                    <input type="text" class="form-control datepicker-input" id="nurse_searching_date" placeholder="Pick a date" data-date-format="dd-mm-yyyy">
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-md-2">
                                          <button class="btn btn-primary" onclick="search_nurse()">Search</button>

                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-25">
                                    <table id="data-table" class="table table-bordred nurse_data" >


                                    </table>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <div class="modal fade bd-example-modal-xl" id="select_nurse_modal">
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
                                <div class="m-t-10">
                                    <div class="row">
                                        <div class="col-md-3">

                                            <div class="form-group" style="margin:30px">


                                            <input type="text" id="start_time" placeholder="Enter Start Time" >

                                            </div>


                                        </div>
                                        <div class="col-md-3">
                                                <div class="form-group" style="margin:30px">


                                                        <input type="text" id="end_time" placeholder="Enter End Time" >

                                        </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-25">
                                    <table id="data-table" class="table table-bordred" >


                                    </table>
                                </div>

                                <button type="button" class="btn btn-primary" onclick="submit_nurse()">Submit</button>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
    </div>



<script src="{{asset('assets')}}/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="{{asset('assets')}}/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/datatables.js"></script>




    <script src="{{ asset('assets') }}/js/pages/form-elements.js"></script>



    <!-- Core JS -->
    <script src="{{asset('assets')}}/js/app.min.js"></script>

    <!-- JQuery -->

<!-- Bootstrap tooltips -->


<script src="{{ asset('assets') }}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script src="{{ asset('assets') }}/vendors/select2/select2.min.js"></script>





    <script>

        function submit_nurse()
        {
          var start_time = $("#start_time").val();
          var end_time = $("#end_time").val();
          var nurse_id = $("#hidden_nurse_id").val();
          var patient_id = $("#hidden_patient_id").val();
          var appointed_date =  $('#nurse_searching_date').val();
         var formdata = new FormData();
         formdata.append('start_time',start_time);
         formdata.append('end_time',end_time);
         formdata.append('nurse_id',nurse_id);
         formdata.append('patient_id',patient_id);
         formdata.append('appointed_date',appointed_date);

         $.ajax({
            processData: false,
            contentType: false,
            url:"{{url('submit_nurse')}}",
            type:'POST',
            data: formdata,
            success:function(data, status){

              alert('Nurse Assigned Successfully');
              location.reload();
        },



          });

        }



        function assign_nurse(patient_id)
        {
              $('#hidden_patient_id').val(patient_id);
            $('#excel_error_modal').modal('show');

           // alert(address);
             {{--  var formdata = new FormData();
            formdata.append('address',address);
            $.ajax({
                processData: false,
                contentType: false,
                url:"{{url('assign_nurse')}}",
                type:'POST',
                data: formdata,
                success:function(data, status){

                  var msg = $.trim(data);
                  alert(msg);
            },



              });   --}}




        }



        function search_nurse()
        {
        var patient_id = $("#hidden_patient_id").val();
         var nurse_searching_date = $('#nurse_searching_date').val();
         var formdata = new FormData();
         formdata.append('nurse_searching_date',nurse_searching_date);
         formdata.append('patient_id',patient_id);
         $.ajax({
            processData: false,
            contentType: false,
            url:"{{url('search_nurse')}}",
            type:'POST',
            data: formdata,
            success:function(data, status){
                $('.nurse_data').html(data);

        },



          });

        }

        function select_nurse(nurse_id)
        {
            $("#hidden_nurse_id").val(nurse_id);
            $('#select_nurse_modal').modal('show');
        }

        $(function () {

            $.ajaxSetup({

headers: {

    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});


        })





        $('#customFile').on('change',function(){
            //get the file name
            var fileName = $(this).val().split('\\').pop();;
            //replace the "Choose a file" label
          $(".custom-file-label").html(fileName);
        });

        $('#data-table').DataTable({
    'paging' : true,
    'lengthChange': true,
    'searching' : true,
    'ordering' : true,
    'info' : false,
    'autoWidth' : true
  })




    </script>





@endsection


