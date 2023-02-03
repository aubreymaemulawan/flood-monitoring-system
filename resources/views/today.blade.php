@extends('layouts.main')
@section('title','Today Water Level')

@section('index_pages')

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="text-white display-4 animated slideInDown mb-4">Water Level Monitoring</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Today</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- No Data Start -->
    <div id="noData" class="container-fluid my-5 py-5 wow fadeIn" data-wow-delay="0.1s" style="display:none">
        <div class="container-md wow fadeIn" data-wow-delay="0.1s">
            <div class="row">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                    <h1 class=" display-6 mb-4">
                        No data available for today.
                    </h1>
                    <p class="fs-5 mb-5">
                        We are still fixing something. We'll be back in a short time.
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- No Data End -->

    <!-- Water Level Chart Start -->
    <div id="chartToday" class="container-md  py-5 wow fadeIn" style="display:none">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Water Level Report <span style="font-size:15px;color:#C0C0C0;">| Today</span></h5>
                <div class="p-4">
                    <nav>
                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                            @foreach($data as $key=>$value)
                                <button class="nav-link fw-semi-bold" id="nav-mission-tab{{$key}}" onclick="ViewData('nav-mission-tab{{$key}}','{{$value['data']['name']}}')">{{$value['data']['location']}}</button>
                            @endforeach
                        </div>
                    </nav>
                    <div id="nm" class="tab-content" id="nav-tabContent">
                    </div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        var data = @json($data);
                        var water_level = @json($water_level);
                        if(water_level.length != 0){
                            $('#water').show();
                            $('#chartToday').show();
                            $.each(data, function (key, value) {
                                $('#nav-mission-tab0').addClass('active');
                                if(key === 0){
                                    chart.render();
                                    chart.updateSeries([{
                                        name: value.data.location,
                                        data: value.data.height,
                                    }])
                                    chart.updateOptions({
                                        labels: value.data.dates,
                                    })
                                    
                                }
                            });
                        }else{
                            $('#chartToday').hide();
                            $('#water').hide();
                            $('#noData').show();
                        }
                    });
                    var data = @json($data);

                    // Function View Data on Chart
                    function ViewData(id,name){
                        $('[id^="nav-mission-tab"]').removeClass('active');
                        $('#'+id+'').addClass('active');
                        $('#nm').html('');
                        $.each(data, function (key, value) {
                            if(value.data.name == name){
                                chart.updateSeries([{
                                    name: value.data.location,
                                    data: value.data.height,
                                }])
                                chart.updateOptions({
                                    labels: value.data.dates,
                                    fill: {
                                        color: value.data.random,
                                    }
                                })
                            }
                        });
                    }
                </script> 
            </div>
        </div>
    </div>
    <!-- Water Level Chart End -->

    <!-- Table Start -->
    <div id="water" class="container-fluid appointment my-5 py-5 wow fadeIn" data-wow-delay="0.1s" style="display:none">
        <div class="container-md wow fadeIn" data-wow-delay="0.1s">
            <div class="row">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                    <h1 class="text-light display-6 mb-4">
                        Real-Time Water Levels Today
                    </h1>
                    <p class="fs-5 text-light mb-5">
                        This table is updated in real-time whenever the water levels in a particular area change.
                    </p>
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="1s">
                    <div class="h-100">
                    <div class="alert alert-pad alert-success alert-dismissible fade show" role="alert"> 
                        <div class="badge rounded-pill bg-success mb-2">Above Normal</div>
                            &nbsp Green Level indicates that the water level reaches 5cm-30cm.
                        </div>
                        <div class="alert alert-pad alert-warning alert-dismissible fade show" role="alert"> 
                            <div style="background-color:orange;color:white" class="badge rounded-pill mb-2">Severe</div>
                            &nbsp Orange Level indicates that the water level reaches 31cm-90cm.
                        </div>
                        <div class="alert alert-pad alert-danger alert-dismissible fade show" role="alert"> 
                            <div class="badge rounded-pill bg-danger mb-2">Extreme</div>
                            &nbsp Red Level indicates that the water level reaches 91cm-130cm.
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="rounded">
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table id="dataTable" class="table table-hover">
                                <thead class="table-light" style="border-bottom: 2px solid #e3e6f0;">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Height</th>
                                        <th scope="col">Color Level</th>
                                        <th scope="col">Time Created</th>
                                    </tr>
                                </thead>
                                <tbody id="realtime_table">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->

@endsection

@section('index_scripts')
    <script>
        // Sidebar
        $('[id^="nav-"]').removeClass('active')
        $('#nav-pages').addClass('active')  
        $('[id^="nav-pages-"]').removeClass('active')
        $('#nav-pages-today').addClass('active')        

        // Data Table
        $('#dataTable').DataTable({order: [[0, 'desc']]});

        // Apexcharts Initialization
        var options = {
            series: [{
                name: [],
                data: [],
            }],
            chart: {
                type: 'area',
                height: 300,
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                curve: 'smooth'
            },
            subtitle: {
                text: 'Water Level Movements',
                align: 'left'
            },
            labels: [],
            xaxis: {
                type: 'datetime',
            },
            yaxis: {
                opposite: true
            },
            legend: {
                horizontalAlign: 'left'
            },
        }
        var chart = new ApexCharts(document.querySelector("#nm"), options);
    </script>

    <script>
        function loadXMLDoc() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("realtime_table").innerHTML =
                    this.responseText;
                }
            };
            xhttp.open("GET", "./today-table", true);
            xhttp.send();
        }
        setInterval(function(){
            loadXMLDoc();
            // 1sec
        },1000);
        window.onload = loadXMLDoc;
    </script>
@endsection