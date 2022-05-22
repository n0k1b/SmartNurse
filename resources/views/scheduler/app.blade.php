<!DOCTYPE html>
<html lang="en">



<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link href="{{ asset('assets')}}/css/app.min.css"rel="stylesheet">

    <title>Smart Nurse</title>

    <!-- Favicon -->


    <link rel="shortcut icon" href="{{asset('assets')}}/images/logo/favicon.png">




    <!-- page css -->
<link href="{{asset('assets')}}/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">


    <!-- Core css -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates&display=swap" rel="stylesheet">




</head>

<body style="overflow-x:auto">
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="http://www.candthomecare.com/">
                        <img src="{{ asset('image') }}/logo1.jpg" alt="Logo">
                        <img class="logo-fold" src="assets/images/logo/logo-fold11.png" alt="Logo">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="http://www.candthomecare.com/">
                        <img src="assets/images/logo/logo-white.png" alt="Logo">
                        <img class="logo-fold" src="assets/images/logo/logo-fold-white1.png" alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="{{ url('/') }}">
                                Home
                            </a>
                        </li>

                    </ul>
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
                        <p style="margin-left:15px;padding-top:15px;color:#D70606">Total pending patient: 20</p>


                    <ul class="side-nav-menu scrollable">
                        <h4 style="margin-left:15px;padding-top:15px;">Patient in Queue</h4>


                        <li class="nav-item dropdown">

                                <div class="accordion" id="accordion-default">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title" onclick="test()">
                                                    <a class="collapsed" data-toggle="collapse" href="#collapseOneDefault">
                                                        <span >Patient 1</span>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseOneDefault" class="collapse" data-parent="#accordion-default">
                                                <div class="card-body">
                                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven</p>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                        </li>

                    </ul>
                </div>
            </div>
           <div class="page-container">
             <div class="main-content">


                    @yield('content')
             </div>
            </div>


        </div>
    </div>




    {{-- <script src="{{asset('assets')}}/js/vendors.min.js"></script>


    <script src="{{asset('assets')}}/vendors/chartjs/Chart.min.js"></script>
    <script src="{{asset('assets')}}/js/pages/dashboard-default.js"></script>




    <script src="{{asset('assets')}}/js/app.min.js"></script>
     <script src="{{asset('assets')}}/js/ajax.min.js"></script> --}}


</body>



</html>
