function find_assign_nurse() {
    //alert('hello');
    $.ajax({
        url: "get_assigned_nurse_data",
        method: "GET",
        success: function(data) {

            var data = JSON.parse(data);
            // console.log(data);
            // console.log(data.length);

            var date = [];
            var patient_count = [];

            for (var i in data) {

                date.push(data[i].date);
                patient_count.push(data[i].patient_count);
            }


            var ctx2 = document.getElementById('assigned_nurse');
            var myChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: date,
                    datasets: [{
                        label: '# of Patients',
                        data: patient_count,
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
                                beginAtZero: true,
                                stepSize: 1
                            }
                        }]
                    }
                }
            });



        },
        error: function(data) {
            console.log(data);
        }
    });

}

function find_assign_patient() {
    $.ajax({
        url: "get_assigned_patient_data",
        method: "GET",
        success: function(data) {

            var data = JSON.parse(data);
            // console.log(data);
            // console.log(data.length);

            var date = [];
            var patient_count = [];

            for (var i in data) {

                date.push(data[i].date);
                patient_count.push(data[i].patient_count);
            }


            var ctx = document.getElementById('assigned_patient').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: date,
                    datasets: [{
                        label: '# of Patients',
                        data: patient_count,
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
                                beginAtZero: true,
                                stepSize: 1
                            }
                        }]
                    }
                }
            });



        },
        error: function(data) {
            console.log(data);
        }
    });


}


function find_occupied_nurse() {
    $.ajax({
        url: "get_assigned_patient_data",
        method: "GET",
        success: function(data) {

            var data = JSON.parse(data);
            // console.log(data);
            // console.log(data.length);

            var date = [];
            var patient_count = [];

            for (var i in data) {

                date.push(data[i].date);
                patient_count.push(data[i].patient_count);
            }


            var ctx3 = document.getElementById('occupied_nurse');
            var myChart = new Chart(ctx3, {

                type: 'line',
                data: {
                    labels: date,

                    datasets: [{
                        label: '# of Patients',
                        data: patient_count,
                        fill: false,
                        stppedLine: true,
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
                                beginAtZero: true,
                                stepSize: 1,

                            }
                        }]
                    }
                }
            });



        },
        error: function(data) {
            console.log(data);
        }
    });
}


$(function() {
    //alert('hello');

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    })
    find_assign_patient();

    find_assign_nurse();

    find_occupied_nurse();



})