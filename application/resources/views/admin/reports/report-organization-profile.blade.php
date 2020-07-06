@extends('layouts.default')

    @section('meta')
        <title>Reports | Log Tracker</title>
        <meta name="description" content="Log Tracker reports, view reports, and export or download reports">
    @endsection

    @section('styles')
        <link href="{{ asset('/assets/vendor/chartsjs/Chart.min.css') }}" rel="stylesheet">
    @endsection

    @section('content')
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __("Organizational Profile") }}
                    <button class="ui basic button mini offsettop5 float-right" id="toggleview"><i class="ui icon columns"></i>{{ __("View") }}</button> 
                    <a href="{{ url('reports') }}" class="ui blue basic button mini offsettop5 float-right"><i class="ui icon chevron left"></i>{{ __("Return") }}</a>
                </h2>
            </div>    
        </div>

        <div class="row columnview">
                
            <div class="col-md-6 colview">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __("School Population") }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="canvas-wrapper">
                            <canvas class="chart" id="school"></canvas>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="colview col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __("Grade Population") }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="canvas-wrapper">
                            <canvas class="chart" id="grade"></canvas>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="colview col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __("Gender Demographics") }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="canvas-wrapper">
                            <canvas class="chart" id="genderdiff"></canvas>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="colview col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __("Age Demographics") }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="canvas-wrapper">
                            <canvas class="chart" id="age_group"></canvas>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    @endsection
    
    @section('scripts')
    <script src="{{ asset('/assets/vendor/chartsjs/Chart.min.js') }}"></script>

    <script type="text/javascript">
    $('#toggleview').click(function(event) {
        $('.columnview .colview').toggleClass('col-md-12');
        $('.columnview .colview').toggleClass('col-md-6');
    });

    // chart by school
    var school = document.getElementById("school");
    var myChart0 = new Chart(school, {
        type: 'pie',
        data: {
            labels: [
                @isset($dcc) @php foreach ($dcc as $key => $value) { echo '"' . $key . ' ('. $value .')' . '"' . ', '; } @endphp @endisset
            ],
            datasets: [{
                data: [ @isset($cc) {{ $cc }} @endisset ],
                backgroundColor: ["#009688","#795548","#673AB7","#2196F3","#6da252","#f39c12","#F44336"],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            legend: {display: true,fullWidth: true,position: 'right',},
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var allData = data.datasets[tooltipItem.datasetIndex].data;
                        var tooltipLabel = data.labels[tooltipItem.index];
                        var tooltipData = allData[tooltipItem.index];
                        var total = 0;
                        var label = tooltipLabel.split(" - ");
                        for (var i in allData) {total += allData[i];}
                        var tooltipPercentage = Math.round((tooltipData / total) * 100);
                        return label[0] + ' (' + tooltipPercentage + '%)';
                    }
                }
            },
        }
    });

    // chart by grade
    var grade = document.getElementById("grade");
    var myChart0 = new Chart(grade, {
        type: 'pie',
        data: {
            labels: [
                @isset($dpc) @php foreach ($dpc as $key => $value) { echo '"' . $key . ' ('. $value .')' . '"' . ', '; } @endphp @endisset
            ],
            datasets: [{
                data: [ @isset($dc) {{ $dc }} @endisset ],
                backgroundColor: ["#673AB7","#2196F3","#6da252","#f39c12","#F44336","#009688","#795548"],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            legend: {display: true,fullWidth: true,position: 'right',},
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var allData = data.datasets[tooltipItem.datasetIndex].data;
                        var tooltipLabel = data.labels[tooltipItem.index];
                        var tooltipData = allData[tooltipItem.index];
                        var total = 0;
                        var label = tooltipLabel.split(" - ");
                        for (var i in allData) {total += allData[i];}
                        var tooltipPercentage = Math.round((tooltipData / total) * 100);
                        return label[0] + ' (' + tooltipPercentage + '%)';
                    }
                }
            },
        }
    });

    // chart by gender
    var genderdiff = document.getElementById("genderdiff");
    var myChart1 = new Chart(genderdiff, {
        type: 'pie',
        data: {
            labels: [
                @isset($dgc) @php foreach ($dgc as $key => $value) { echo '"' . $value . " - " . $key . '"' . ', '; } @endphp @endisset
            ],
            datasets: [{
                data: [ @isset($gc) {{ $gc }} @endisset ],
                backgroundColor: ["#6da252","#f39c12","#F44336","#009688","#673AB7","#2196F3","#795548"],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            legend: {display: true,fullWidth: true,position: 'right',},
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var allData = data.datasets[tooltipItem.datasetIndex].data;
                        var tooltipLabel = data.labels[tooltipItem.index];
                        var tooltipData = allData[tooltipItem.index];
                        var total = 0;
                        var label = tooltipLabel.split(" - ");
                        for (var i in allData) {total += allData[i];}
                        var tooltipPercentage = Math.round((tooltipData / total) * 100);
                        return label[1] + ': ' + label[0] + ' (' + tooltipPercentage + '%)';
                    }
                }
            },
        }
    });

    // chart by age group
    var age_group = document.getElementById("age_group");
    var mychart2 = new Chart(age_group, {
        type: 'radar',
        data: {
            labels: ['Age 5-7', 'Age 8-10', 'Age 11-13', 'Age 14-16', 'Age 17-100+'],
            datasets: [{
                label: 'Headcount',
                backgroundColor : "rgba(48, 164, 255, 0.2)",
                borderColor : "rgba(48, 164, 255, 0.8)",
                pointBackgroundColor : "rgba(48, 164, 255, 1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(48, 164, 255, 1)",
                data: [ @isset($age_group) {{ $age_group }} @endisset ],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            legend: {position: 'top',display: false,},
            title: {display: false,text: 'Radar'},
            scale: {ticks: {beginAtZero: true} }
        }
    });



    

    </script>
    @endsection 