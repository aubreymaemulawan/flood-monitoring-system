@extends('layouts.main')
@section('title','Daily Water Level')

@section('index_pages')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="text-white display-4 animated slideInDown mb-4">Water Level Monitoring</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daily</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Search Start -->
    <div class="container-fluid py-5">
        <div class="container-md">
            <div class="row">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="h-100">
                        <h1 class="display-6 mb-5">
                            Find a Date to Check the Water Level
                        </h1>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class=" align-items-center">
                        <div class="bg-light rounded p-4">
                            <div class="row g-3">
                                <div class="col-sm-10">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="select_date" name="select_date" placeholder="Date" />
                                        <label for="select_date">Date</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button id="waterChange" class="btn btn-primary py-3 px-4">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search End -->

    <!-- Water Level Chart Start -->
    <div id="chart" class="container-md py-5" style="display:none">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Water Level Report <span style="font-size:15px;color:#C0C0C0;" id="water"></span></h5>
                <div class="p-4">
                    <nav>
                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist"></div>
                    </nav>
                    <div id="nm" class="tab-content" style="display:none"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Water Level Chart End -->

    <!-- Table Start -->
    <div id="waterTable" class="container-fluid appointment my-5 py-5 wow fadeIn" data-wow-delay="0.1s" style="display:none">
        <div class="container-md wow fadeIn" data-wow-delay="0.1s">
            <div class="row">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h1 class="text-light display-6 mb-4">
                            Water Levels
                        </h1>
                        <p class="fs-5 text-light mb-5">
                            The water levels that were observed on a specific date are listed in this table. To monitor the water level, choose a date.
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
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead class="table-light" style="border-bottom: 2px solid #e3e6f0;">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Height</th>
                                        <th scope="col">Color Level</th>
                                        <th scope="col">Date Created</th>
                                    </tr>
                                </thead>
                                <tbody>
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
        $('#nav-pages-daily').addClass('active') 

        // Clear Input Fields
        $('#select_date').val('');
        $('#nm').html('');

        // Data Table
        $('#dataTable').DataTable({order: [[0, 'desc']]});

        // Apex Charts Initialize
        var options = {
            series: [{
                name: '',
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

        // View Data Function
        function ViewData(id,name,location,height,dates){
            $('#nm').show();
            $('[id^="location-tab-"]').removeClass('active');
            $('#'+id+'').addClass('active');
            if(height == 0){
                $('#nm').html('No data available on selected location.');
                chart.render();
                chart.updateSeries([{
                    name: [],
                    data: [],
                }])
                chart.updateOptions({
                    labels: [],
                })
            }else{
                chart.render();
                chart.updateSeries([{
                    name: location,
                    data: height,
                }])
                chart.updateOptions({
                    labels: dates,
                })
            }
            
        }

        // Water Level Chart
        $('#waterChange').on('click', function () {
            ViewData(0,0,0,0,0);
            $('#chart').hide();
            $('#nm').hide();
            var tble = $('#dataTable').DataTable();
            tble.clear();
            $('#nav-tab').html('');
            $('#nm').html('');
            $('#water').html('');
            var dates = $('#select_date').val();
            if(dates){
                var selectedDate = dates+' 00:00:00';
                Controller.Post('/api/water_level/generateChart', { 'selectedDate': selectedDate } )
                // If success, return message
                .done(function([data,water_level]) {
                    if(water_level.length == 0){
                        $('#chart').hide();
                        $('#waterTable').hide();
                        bootbox.alert({
                            message: "No data found in selected date.",
                            centerVertical: true,
                            closeButton: false,
                            size: 'medium'
                        }); 
                    }else{
                        $('#chart').show();
                        $('#waterTable').show();
                        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                        var d = new Date(dates);
                        var date = d.toLocaleDateString("en-US", options);
                        $('#water').html('| '+date);
                        var data = data;
                        $.each(data, function (key, value) {
                            var height = [];
                            var dates = [];
                            $.each(value.data.height, function (k1, val1) {
                                height[k1] = val1;
                            });
                            $.each(value.data.dates, function (k2, val2) {
                                dates[k2] = val2;
                            });

                            if(key == 0){
                                var active = 'active';
                                ViewData('location-tab-'+key+'',value.data.name,value.data.location,height,dates)
                            }
                            $('#nav-tab').append('<button class="nav-link fw-semi-bold '+active+'" id="location-tab-'+key+'">'+value.data.location+'</button>');
                            document.getElementById('location-tab-'+key+'').onclick = function() {
                                ViewData('location-tab-'+key+'',value.data.name,value.data.location,height,dates)
                            };
                        })

                        // Water Level Table
                        var cnt = 1;
                        $.each(water_level, function (key, value) {
                            if(value.device.status == 1){
                                var index = key+1;
                                // Convert Created_at 
                                var date;
                                if(value.created_at != null){
                                    var dd = moment(value.created_at).format('MMMM Do YYYY, h:mm a')
                                }else{
                                    var dd = 'N/A';
                                }
                                
                                // Color Level
                                if(value.color == 'red'){
                                    var spanClass = 'badge rounded-pill bg-danger';
                                    var spanStyle = "";
                                    var colorLevel = "Extreme";
                                }else if(value.color == 'green'){
                                    var spanClass = 'badge rounded-pill bg-success';
                                    var spanStyle = "";
                                    var colorLevel = "Above Normal";
                                }else if(value.color == 'orange'){
                                    var spanClass = 'badge rounded-pill';
                                    var spanStyle = "background-color:orange;color:white";
                                    var colorLevel = "Severe";
                                }
                                // Add Row to Datatable
                                var table = $('#dataTable').DataTable();
                                table.row.add($("<tr><td>"+cnt++
                                +"</td><td>"+value.device.location
                                +"</td><td>"+value.height
                                +" cm</td><td><span class='"+spanClass+"' style='"+spanStyle+"'>"+colorLevel+"</span>"
                                +"</td><td>"+dd
                                +"</td></tr>")).draw(false);
                            }
                        })
                    }
                })
            }else{
                $('#chart').hide();
                $('#waterTable').hide();
                $('#water').html('');
            }
        }) 
    </script>
@endsection