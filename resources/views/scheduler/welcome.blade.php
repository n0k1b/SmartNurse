

<!DOCTYPE html>
<html lang="en">



<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="cache-control" content="no-store" />
<meta http-equiv="cache-control" content="must-revalidate" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <meta name="csrf-token" content="{{ csrf_token() }}">


<link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates&display=swap" rel="stylesheet">
<link href="{{ asset('assets')}}/css/app.min.css?{{time()}}"rel="stylesheet">

    <title>Smart Nurse</title>

    <!-- Favicon -->


    <link rel="shortcut icon" href="{{asset('assets')}}/images/logo/favicon.png">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.css">





    <!-- page css -->
<link href="{{asset('assets')}}/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">


    <!-- Core css -->

    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />-->

     <link rel="stylesheet" href="{{asset('assets')}}/css/fullcalendar.css?{{time()}}" />


  <style>
        .fc-time-grid-event .fc-time {
           display: none;
        }




  </style>

</head>

<body style="overflow-x:auto;background: linear-gradient(to right, #ccffcc 1%, #cc99ff 100%);">
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="{{url('/')}}">
                        <img src="{{ asset('image') }}/logo1.jpg" alt="Logo">
                        <img class="logo-fold" src="assets/images/logo/logo-fold11.png" alt="Logo">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href= "{{url('/')}}">
                        <img src="assets/images/logo/logo-white.png" alt="Logo">
                        <img class="logo-fold" src="assets/images/logo/logo-fold-white1.png" alt="Logo">
                    </a>
                </div>

                <div class="nav-wrap">
                     @include('header');
                    <ul class="nav-right">

                        <li class="dropdown dropdown-animated scale-left">
                            <a href="{{ url('log_out') }}">
                                Log Out
                            </a>
                        </li>

                    </ul>
                </div>

            </div>
            <!-- Header END -->

            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <div style="background-color:black;height:50px;text-align:center; margin-right:60px;margin-left:1px" >
                       <p style="margin-left:15px;padding-top:15px;color:white;font-size:18px;font-weight:500;" >Pending patient: {{ $pending_patient }}</p>
                    </div>


<input type="hidden" id="hidden_patient_id" value="all">
                    <ul class="side-nav-menu scrollable">
                        <h5 style="margin-left:15px;padding-top:15px;color:black">Patient in Queue</h5>

                       <div>
                        <li class="nav-item dropdown">

                                <div class="accordion" id="accordion-default">
                                    @foreach ( $patient_list as $patient )


                                        @if($patient->cancel == 'yes')
                                         <div class="card">
                                            <div class="card-header" >
                                                <h5 class="card-title" onclick="call_full_calendar({{ $patient->id }})">

                                                    <a class="collapsed" data-toggle="collapse" href="#collapseOneDefault{{ $patient->id }}" style="background:red">
                                                        <span >{{ $patient->first_name." ".$patient->last_name}}</span>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseOneDefault{{ $patient->id }}" class="collapse" data-parent="#accordion-default">
                                                <div class="card-body">
                                                    <p style="color:black">Name:<span>{{ $patient->first_name." ".$patient->last_name}}</span> </p>
                                                    <p style="color:black">Medicaid Id:<span>{{ $patient->medicaid_id }}</span> </p>
                                                    <p style="color:black">DOB: <span>{{ $patient->date_of_birth }}</span></p>
                                                    <p style="color:black">Address:<span>{{ $patient->address.",".$patient->city }}</span> </p>
                                                    <p style="color:black">Phone no: <span>{{ $patient->cell_phone }}</span></p>
                                                    <p style="color:black">Assesment type: <span>{{ $patient->assesment_type }}</span></p>
                                                    <p style="color:black">Sepcial Instruction:</p>


                                                </div>
                                            </div>
                                        </div>
                                        @else

                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title" onclick="call_full_calendar({{ $patient->id }})">

                                                    <a class="collapsed" data-toggle="collapse" href="#collapseOneDefault{{ $patient->id }}">
                                                        <span >{{ $patient->first_name." ".$patient->last_name}}</span>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseOneDefault{{ $patient->id }}" class="collapse" data-parent="#accordion-default">
                                                <div class="card-body">
                                                    <p style="color:black">Name:<span>{{ $patient->first_name." ".$patient->last_name}}</span> </p>
                                                    <p style="color:black">Medicaid Id:<span>{{ $patient->medicaid_id }}</span> </p>
                                                    <p style="color:black">DOB: <span>{{ $patient->date_of_birth }}</span></p>
                                                    <p style="color:black">Address:<span>{{ $patient->address.",".$patient->city }}</span> </p>
                                                    <p style="color:black">Phone no: <span>{{ $patient->cell_phone }}</span></p>
                                                    <p style="color:black">Assesment type: <span>{{ $patient->assesment_type }}</span></p>
                                                    <p style="color:black">Sepcial Instruction:</p>


                                                </div>
                                            </div>
                                        </div>

                                        @endif






                                        @endforeach


                                    </div>

                        </li>
                    </div>

                    </ul>
                </div>
            </div>
           <div class="page-container">
             <div class="main-content">

                <div class="card">
                    <div class="card-body">

                        <div id="calendar"></div>


                        <div class="modal fade bd-example-modal-xl" id="show_date_details">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content" style="overflow-x: auto;">
                                    <div class="modal-header">

                                        <button type="button" class="close" data-dismiss="modal">
                                            <i class="anticon anticon-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="preload">
                                            <img src="{{asset('image')}}/loading_spinner.gif" />
                                        </div>

                                        <div class="card" style="overflow-x: auto;">

                                            <div class="card-body" style="overflow-x: auto;">


                                                <div class="m-t-25">
                                                    <table id="data-table" class="table table-bordred">
                                                        <thead>
                                                            <th>Nurse Name</th>
                                                            <th>Patient Name</th>
                                                            <th>Date</th>
                                                            <th>Start Time</th>

                                                            <th>Patient Address</th>
                                                            <th>Assesment Type</th>


                                                            <th>Distance from patient(KM)</th>

                                                            <th></th>

                                                        </thead>
                                                        <tbody id="assign_nurse">

                                                        </tbody>

                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade bd-example-modal-xl" id="map_modal">
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


                                                <div class="m-t-25">
                                                    <div id="map" style="width: 400px; height: 300px"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

             </div>
            </div>


        </div>
    </div>


  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="{{asset('assets')}}/js/app.min.js"></script>
  <script src="{{asset('assets')}}/js/vendors.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.js" ></script>


  <script src="{{asset('assets')}}/vendors/datatables/jquery.dataTables.min.js"></script>
 <script src="{{asset('assets')}}/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/datatables.js"></script>




  <script>


    var calendar;
    var events;
    var patient_id;


    function assign_nurse()
    {
        var patient_id = $("#assign_patient_id").val();
        var nurse_id = $("#assign_nurse_id").val();
        var date = $("#assign_date").val();
        var time = $("#assign_time").val();
        var assesment_type = $("#assesment_type").val();
        var formdata = new FormData();
        formdata.append('patient_id',patient_id);
        formdata.append('nurse_id',nurse_id);
        formdata.append('date',date);
        formdata.append('time',time);
        formdata.append('assesment_type',assesment_type);

         swal({
          title: "Are you sure?",
          text: "You will not be able to recover this assignment!",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
          ],
           showLoaderOnConfirm: true,
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {

                    $.ajax({
                processData: false,
                contentType: false,
                url:"{{url('submit_nurse')}}",
                type:'POST',
                data: formdata,
                success:function(data, status){
                  // alert(data);
                     swal("Nurse Assign Successfully");
                     location.reload();

                  // alert('Nurse Assign Successfully');



            },



              });

          } else {
            swal("Cancelled", "Assignment of nurse canceled :)", "error");
          }
        });

        // if(confirm('Are you sure'))
        // {
        //     $.ajax({
        //         processData: false,
        //         contentType: false,
        //         url:"{{url('submit_nurse')}}",
        //         type:'POST',
        //         data: formdata,
        //         success:function(data, status){
        //           // alert(data);
        //              swal("Nurse Assign Successfully");
        //           // alert('Nurse Assign Successfully');
        //           location.reload();


        //     },



        //       });
        // }
       // alert(patient_id+" "+nurse_id+" "+date+" "+time);

    }

    function call_full_calendar(patient_id)
    {

        $("#hidden_patient_id").val(patient_id);

     calendar.fullCalendar('refetchEvents');




    }



    function fetch_calendar_data()
    {


        patient_id = $("#hidden_patient_id").val();
        //alert(patient_id);





         calendar = $('#calendar').fullCalendar({


            editable:true,
            allDaySlot: false,
            eventLimit: true, // for all non-agenda views
            views: {
                agenda: {
                eventLimit: 6 // adjust to 6 only for agendaWeek/agendaDay
                },
                week: {
                    eventLimit: 6
                  },
                  timeGrid: {
                    eventLimit: 6
                  },

            },

            eventOrder: 'id',
            height: "auto",
            slotMinutes: 60,

            slotDuration: '00:60:00',


           slotLabelInterval: 60,



            {{-- defaultView: 'agendaWeek', --}}

            minTime:'09:00:00',
            maxTime:'19:00:00',

            header:{
             left:'prev,next today',
             center:'title',
             right:'agendaWeek,agendaDay,',
            },

        events:function (start, end, timezone, callback) {
           //alert(patient_id);




        $.ajax({
            {{-- processData: false,
            contentType: false, --}}
            url:"{{url('fetch_calendar_data')}}",
            type:'POST',
           data:{patient_id:$("#hidden_patient_id").val()},
            success:function(data, status){



                //alert(patient_id);
                events = JSON.parse(data);

               callback(events);
               //$('#calendar').fullCalendar( 'removeEvents', events );







        },



          });

        },




         /* events:[{

            id: 999,
            title: 'Repeating Event',
            start: '2019-12-22T10:00',
            end:'2019-12-22T10:00',
            //dow:'[1]',

           // dow:'[1,4]',
            //dow:'[1,4]',
          }]*/






            selectable:true,
            selectHelper:true,

            editable:true,

            eventClick:function(calEvent, jsEvent, view)
            {
                //alert(calEvent.id);
              var patient_id = $('#hidden_patient_id').val();
                var nurse_id = calEvent.nurse_id;
              // alert(nurse_id);
              var time = calEvent.start.format('H:mm');
              var date = calEvent.start.format('DD-MM-YYYY');

             // alert(patient_id+" "+nurse_id);

             // alert(nurse_id);



            // alert(date);

                var formdata = new FormData();
                formdata.append('patient_id',patient_id);
                formdata.append('nurse_id',nurse_id);
                formdata.append('time',time);
                formdata.append('date',date);
                $.ajax({
                    processData: false,
                    contentType: false,
                    url:"{{url('show_nurse_assign_modal')}}",
                    type:'POST',
                    data: formdata,
                    success:function(data, status){
                        var msg = $.trim(data);
                        //alert(msg);
                        if(msg == 'not_ok')
                        {   swal("Please Select a patient first");

                        }
                        else if(msg =='already_appointed')
                        {

                            alert('Nurse already assigned for this slot. Try another nurse or another slot');
                        }
                        else
                        {
                        $("#assign_nurse").html(data);

                          $("#show_date_details").modal('show');
                        }
                        //alert(data);



                },



                  });






            }
            ,

            eventAfterAllRender: function() {

                // define static values, use this values to vary the event item height
                var defaultItemHeight = 50;
                var defaultEventItemHeight = 18;
                // ...

                // find all rows and define a function to select one row with an specific time
                var rows = [];
                $('div.fc-slats > table > tbody > tr[data-time]').each(function() {
                  rows.push($(this));
                });
                var rowIndex = 0;
                var getRowElement = function(time) {
                  while (rowIndex < rows.length && moment(rows[rowIndex].attr('data-time'), ['HH:mm:ss']) <= time) {
                    rowIndex++;
                  }
                  var selectedIndex = rowIndex - 1;
                  return selectedIndex >= 0 ? rows[selectedIndex] : null;
                };

                // reorder events items position and increment row height when is necessary
                $('div.fc-content-col > div.fc-event-container').each(function() {  // for-each week column
                  var accumulator = 0;
                  var previousRowElement = null;

                  $(this).find('> a.fc-time-grid-event.fc-v-event.fc-event.fc-start.fc-end').each(function() {  // for-each event on week column
                    // select the current event time and its row
                    var currentEventTime = moment($(this).find('> div.fc-content > div.fc-time').attr('data-full'), ['h:mm A']);
                    var currentEventRowElement = getRowElement(currentEventTime);

                    // the current row has to more than one item
                    if (currentEventRowElement === previousRowElement) {
                      accumulator++;

                      // move down the event (with margin-top prop. IT HAS TO BE THAT PROPERTY TO AVOID CONFLICTS WITH FullCalendar BEHAVIOR)
                      $(this).css('margin-top', '+=' + (accumulator * defaultItemHeight).toString() + 'px');

                      // increse the heigth of current row if it overcome its current max-items
                      var maxItemsOnRow = currentEventRowElement.attr('data-max-items') || 1;
                      if (accumulator >= maxItemsOnRow) {
                        currentEventRowElement.attr('data-max-items', accumulator + 1);
                        currentEventRowElement.css('height', '+=' + defaultItemHeight.toString() + 'px');
                      }
                    } else {
                      // reset count
                      rowIndex = 0;
                      accumulator = 0;
                    }

                    // set default styles for event item and update previosRow
                    $(this).css('left', '0');
                    $(this).css('right', '7px');
                    $(this).css('height', defaultEventItemHeight.toString() + 'px');
                    $(this).css('margin-right', '0');
                    previousRowElement = currentEventRowElement;
                  });
                });

                // this is used for re-paint the calendar

                $('#calendar').fullCalendar('option', 'aspectRatio', $('#calendar').fullCalendar('option', 'aspectRatio'));
                //calendar.fullCalendar('refetchEvents');

              }



           });


         //  calendar.fullCalendar("removeEventSource", jQuery(this).data('source'));
    }


  $(document).ready(function() {

    $(".preload").hide();

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

        });
          fetch_calendar_data();




  });

  </script>

  <script>
    $('#data-table').DataTable({
        'paging' : false,
        'lengthChange': true,
        'searching' : false,
        'ordering' : false,
        'info' : false,
        'autoWidth' : true
      })

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
  </script>




    {{-- <script src="{{asset('assets')}}/js/vendors.min.js"></script>



    <script src="{{asset('assets')}}/vendors/chartjs/Chart.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/dashboard-default.js"></script>




    <script src="{{asset('assets')}}/js/app.min.js"></script>
     <script src="{{asset('assets')}}/js/ajax.min.js"></script> --}}


</body>



</html>









    <!-- page js -->









    <!-- Core JS -->


    <!-- JQuery -->

<!-- Bootstrap tooltips -->
