@extends('admin.app')

@section('content')



    <!-- Content Wrapper START -->

        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card custom-card-admin">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="m-b-0" style="color:white;font-weight:bold">Totla Pending Patient</p><br>
                                <h2 class="m-b-0" style="color:white;font-weight:bold">
                                    <span>{{ $total_pedning_patient }}</span>
                                </h2>
                            </div>
                            <div class="avatar avatar-icon avatar-lg avatar-blue" style="color:white;font-weight:bold">
                                <i class="anticon anticon-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card custom-card-admin">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="m-b-0" style="color:white;font-weight:bold">Total Assigned Patient Today</p>
                                <h2 class="m-b-0" style="color:white;font-weight:bold">
                                    <span>{{ $total_assign_patient }}</span>
                                </h2>
                            </div>
                            <div class="avatar avatar-icon avatar-lg avatar-cyan" style="color:white;font-weight:bold">
                                <i class="anticon anticon-bar-chart"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card custom-card-admin">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="m-b-0" style="color:white;font-weight:bold">Total Assigned Nurse Today</p>
                                <h2 class="m-b-0" style="color:white;font-weight:bold">
                                    <span>{{ $total_assign_nurse }}</span>
                                </h2>
                            </div>
                            <div class="avatar avatar-icon avatar-lg avatar-red" style="color:white;font-weight:bold">
                                <i class="anticon anticon-profile"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card custom-card-admin">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="m-b-0" style="color:white;font-weight:bold">Total Occupied Nurse Today</p>
                                <h2 class="m-b-0" style="color:white;font-weight:bold">
                                    <span>{{ $occupied_nurse }}</span>
                                </h2>
                            </div>
                            <div class="avatar avatar-icon avatar-lg avatar-gold" style="color:white;font-weight:bold">
                                <i class="anticon anticon-bar-chart"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



          <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5>Assigned Patients</h5>
                                        <div>
                                            <div class="btn-group">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-t-50" style="height: 330px">
                                        <canvas class="chart" id="assigned_patient"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5>Assigned Nurse</h5>
                                        <div>
                                            <div class="btn-group">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-t-50" style="height: 330px">
                                        <canvas class="chart" id="assigned_nurse"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5>Occupied Nurse</h5>
                                        <div>
                                            <div class="btn-group">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-t-50" style="height: 330px">
                                        <canvas class="chart" id="occupied_nurse"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>


                      <script src="{{asset('assets')}}/js/vendors.min.js"></script>
                      <script src="{{asset('assets')}}/js/app.min.js"></script>
                      <script src="{{ asset('assets') }}/vendors/chartjs/Chart.min.js"></script>
                      <script src="{{asset('assets')}}/js/custom/custom_chart.js"></script>




{{--
                    <script>
var ctx = document.getElementById('assigned_patient').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['21-12-2019', '22-12-2019', '23-12-2019', '24-12-2019', '25-12-2019', '26-12-2019','27-12-2019'],
        datasets: [{
            label: '# of Patients',
            data: [12, 19, 3, 5, 8, 3,10],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});





</script> --}}



        <script src="{{ asset('assets') }}/js/vendors.min.js"></script>

        <!-- page js -->

        <script src="{{ asset('assets') }}/js/pages/dashboard-default.js"></script>

        <!-- Core JS -->
        <script src="{{ asset('assets') }}/js/app.min.js"></script>







    <!-- Content Wrapper END -->

    <!-- Footer START -->

    <!-- Footer END -->



@endsection
