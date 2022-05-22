<!DOCTYPE html>
<html lang="en">



<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="cache-control" content="no-store" />
    <meta http-equiv="cache-control" content="must-revalidate" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Smart Nurse</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets')}}/images/logo/favicon.png">


    <!-- page css -->
<link href="{{asset('assets')}}/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- Core css -->
    <link href="{{asset('assets')}}/css/app.min.css" rel="stylesheet">

</head>

<body style="overflow-x:auto">
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="{{url('/')}}">
                        <img src="{{ asset('image') }}/logo.jpg" alt="Logo">
                        <img class="logo-fold" src="assets/images/logo/logo-fold11.png" alt="Logo">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="{{url('/')}}">
                        <img src="assets/images/logo/logo-white.png" alt="Logo">
                        <img class="logo-fold" src="assets/images/logo/logo-fold-white1.png" alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    @include('header')
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
