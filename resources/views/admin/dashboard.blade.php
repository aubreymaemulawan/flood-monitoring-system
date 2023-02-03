@extends('layouts.app')
@section('title','Dashboard')

@section('admin_content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-xxl-4 col-md-6">
                        <!-- Devices -->
                            <div class="card info-card sales-card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li><button class="dropdown-item" id="deviceToday">Today</button></li>
                                        <li><button class="dropdown-item" id="deviceMonth">This Month</button></li>
                                        <li><button class="dropdown-item" id="deviceYear">This Year</button></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Devices <span id="dev">| Today</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> 
                                            <i class="bx bx-devices"></i>
                                        </div>
                                        <!-- Device Today -->
                                        <div hidden class="ps-3" id="dev_today_activity">
                                            <?php $count=0; $percent=0;?>
                                            @foreach($device as $dv)
                                            <?php 
                                            $created_at = $dv->created_at;
                                            $today = date('m/d/Y');
                                            $date = date('m/d/Y', strtotime($created_at));
                                            if($today == $date){
                                                if($dv->status == 1){
                                                    $count++;
                                                }
                                            }
                                            ?>
                                            @endforeach
                                            <?php 
                                            $old = $device->count();
                                            $diff = $count - $old;
                                            $more_less = $diff >= 0 ? "increase" : "decrease";
                                            if($count !=0){
                                                $diff = abs($diff);
                                                $percentChange = ($diff/$old)*100;
                                                $percent = number_format((float)$percentChange, 1, '.', '');
                                            }else{
                                                $percent = 0;
                                            }
                                            ?>
                                            <h6>{{$count}}</h6>
                                            <span class="text-success small pt-1 fw-bold">{{$percent}}%</span> 
                                            <span class="text-muted small pt-2 ps-1">{{$more_less}}</span>
                                        </div>

                                        <!-- Device This Month -->
                                        <div hidden class="ps-3" id="dev_month_activity">
                                            <?php $count=0; $percent=0;?>
                                            @foreach($device as $dv)
                                            <?php 
                                            $created_at = $dv->created_at;
                                            $today = date('m/Y');
                                            $date = date('m/Y', strtotime($created_at));
                                            if($today == $date){
                                                if($dv->status == 1){
                                                    $count++;
                                                }
                                            }
                                            ?>
                                            @endforeach
                                            <?php 
                                            $old = $device->count();
                                            $diff = $count - $old;
                                            $more_less = $diff >= 0 ? "increase" : "decrease";
                                            if($count !=0){
                                                $diff = abs($diff);
                                                $percentChange = ($diff/$old)*100;
                                                $percent = number_format((float)$percentChange, 1, '.', '');
                                            }else{
                                                $percent = 0;
                                            }
                                            ?>
                                            <h6>{{$count}}</h6>
                                            <span class="text-success small pt-1 fw-bold">{{$percent}}%</span> 
                                            <span class="text-muted small pt-2 ps-1">{{$more_less}}</span>
                                        </div>

                                        <!-- Device This Year -->
                                        <div hidden class="ps-3" id="dev_year_activity">
                                            <?php $count=0; $percent=0;?>
                                            @foreach($device as $dv)
                                            <?php 
                                            $created_at = $dv->created_at;
                                            $today = date('Y');
                                            $date = date('Y', strtotime($created_at));
                                            if($today == $date){
                                                if($dv->status == 1){
                                                    $count++;
                                                }
                                            }
                                            ?>
                                            @endforeach
                                            <?php 
                                            $old = $device->count();
                                            $diff = $count - $old;
                                            $more_less = $diff >= 0 ? "increase" : "decrease";
                                            if($count !=0){
                                                $diff = abs($diff);
                                                $percentChange = ($diff/$old)*100;
                                                $percent = number_format((float)$percentChange, 1, '.', '');
                                            }else{
                                                $percent = 0;
                                            }
                                            ?>
                                            <h6>{{$count}}</h6>
                                            <span class="text-success small pt-1 fw-bold">{{$percent}}%</span> 
                                            <span class="text-muted small pt-2 ps-1">{{$more_less}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Registered Numbers -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                        </li>
                                        <li><button class="dropdown-item" id="regToday">Today</button></li>
                                        <li><button class="dropdown-item" id="regMonth">This Month</button></li>
                                        <li><button class="dropdown-item" id="regYear">This Year</button></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Registered <span id="reg">| Today</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> 
                                            <i class="bi bi-person"></i></div>
                                        
                                            <!-- Registered Today -->
                                            <div hidden class="ps-3" id="reg_today_activity">
                                                <?php $count=0; $percent=0;?>
                                                @foreach($registered as $reg)
                                                <?php 
                                                $created_at = $reg->created_at;
                                                $today = date('m/d/Y');
                                                $date = date('m/d/Y', strtotime($created_at));
                                                if($today == $date){
                                                    $count++;
                                                }
                                                ?>
                                                @endforeach
                                                <?php 
                                                $old = $registered->count();
                                                $diff = $count - $old;
                                                $more_less = $diff >= 0 ? "increase" : "decrease";
                                                if($count !=0){
                                                    $diff = abs($diff);
                                                    $percentChange = ($diff/$old)*100;
                                                    $percent = number_format((float)$percentChange, 1, '.', '');
                                                }else{
                                                    $percent = 0;
                                                }
                                                ?>
                                                <h6>{{$count}}</h6>
                                                <span class="text-success small pt-1 fw-bold">{{$percent}}%</span> 
                                                <span class="text-muted small pt-2 ps-1">{{$more_less}}</span>
                                            </div>

                                            <!-- Registered This Month -->
                                            <div hidden class="ps-3" id="reg_month_activity">
                                                <?php $count=0; $percent=0;?>
                                                @foreach($registered as $reg)
                                                <?php 
                                                $created_at = $reg->created_at;
                                                $today = date('m/Y');
                                                $date = date('m/Y', strtotime($created_at));
                                                if($today == $date){
                                                    $count++;
                                                }
                                                ?>
                                                @endforeach
                                                <?php 
                                                $old = $registered->count();
                                                $diff = $count - $old;
                                                $more_less = $diff >= 0 ? "increase" : "decrease";
                                                if($count !=0){
                                                    $diff = abs($diff);
                                                    $percentChange = ($diff/$old)*100;
                                                    $percent = number_format((float)$percentChange, 1, '.', '');
                                                }else{
                                                    $percent = 0;
                                                }
                                                ?>
                                                <h6>{{$count}}</h6>
                                                <span class="text-success small pt-1 fw-bold">{{$percent}}%</span> 
                                                <span class="text-muted small pt-2 ps-1">{{$more_less}}</span>
                                            </div>

                                            <!-- Registered This Year -->
                                            <div hidden class="ps-3" id="reg_year_activity">
                                                <?php $count=0; $percent=0;?>
                                                @foreach($registered as $reg)
                                                <?php 
                                                $created_at = $reg->created_at;
                                                $today = date('Y');
                                                $date = date('Y', strtotime($created_at));
                                                if($today == $date){
                                                    $count++;
                                                }
                                                ?>
                                                @endforeach
                                                <?php 
                                                $old = $registered->count();
                                                $diff = $count - $old;
                                                $more_less = $diff >= 0 ? "increase" : "decrease";
                                                if($count !=0){
                                                    $diff = abs($diff);
                                                    $percentChange = ($diff/$old)*100;
                                                    $percent = number_format((float)$percentChange, 1, '.', '');
                                                }else{
                                                    $percent = 0;
                                                }
                                                ?>
                                                <h6>{{$count}}</h6>
                                                <span class="text-success small pt-1 fw-bold">{{$percent}}%</span> 
                                                <span class="text-muted small pt-2 ps-1">{{$more_less}}</span>
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Water Level Chart -->
                        <div class="col-12">
                            <div class="card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                        </li>
                                        <li><button class="dropdown-item" id="waterToday">Today</button></li>
                                        <li><button class="dropdown-item" id="waterMonth">This Month</button></li>
                                        <li><button class="dropdown-item" id="waterYear">This Year</button></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Water Level Report <span id="wat">| Today</span></h5>
                                    <div id="reportsChart"></div>
                                    <div>
                                        <nav>
                                            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                                @foreach($data_today as $key=>$value)
                                                    <button class="nav-link fw-semi-bold" id="location-tab-{{$key}}" onclick="ViewData('location-tab-{{$key}}','{{$value['data']['name']}}')">{{$value['data']['name']}}</button>
                                                @endforeach
                                            </div>
                                        </nav>
                                        <div id="nm" class="tab-content" id="nav-tabContent">
                                        </div>
                                    </div>
                                    <!-- <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                    
                                            new ApexCharts(document.querySelector("#reportsChart"), {
                                                series: data,
                                                chart: {
                                                    height: 350,
                                                    type: 'area',
                                                    toolbar: {
                                                    show: false
                                                    },
                                                },
                                                markers: {
                                                    size: 4
                                                },
                                                colors: color,
                                                fill: {
                                                    type: "gradient",
                                                    gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                    }
                                                },
                                                dataLabels: {
                                                    enabled: false
                                                },
                                                stroke: {
                                                    curve: 'smooth',
                                                    width: 2
                                                },
                                                xaxis: {
                                                    type: 'datetime',
                                                    categories: timestamp
                                                },
                                                yaxis: {
                                                    title: {
                                                        text: 'Height (cm)'
                                                    }
                                                },
                                                tooltip: {
                                                    x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                    },
                                                }
                                            }).render();
                                        });
                                    </script>  -->
                                </div>
                            </div>
                        </div>
                        <!-- Registered Numbers Data -->
                        <div class="col-12">
                            <div class="card recent-sales">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                        </li>
                                        <li><button class="dropdown-item" id="tbleToday">Today</button></li>
                                        <li><button class="dropdown-item" id="tbleMonth">This Month</button></li>
                                        <li><button class="dropdown-item" id="tbleYear">This Year</button></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Recent Registered <span id="tb">| Today</span></h5>
                                    <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Registered Location</th>
                                            <th scope="col">Contact Number</th>
                                            <th scope="col">Date Created</th>
                                        </tr>
                                        </thead>
                                        <!-- Today Table -->
                                        <tbody hidden id="tble_today">
                                            <?php $count=0; $count1=1;?>
                                            @foreach($registered as $rd)
                                                <?php 
                                                $created_at = $rd->created_at;
                                                $today = date('m/d/Y');
                                                $date = date('m/d/Y', strtotime($created_at));
                                                ?>
                                                @if($today == $date)
                                                <?php $count++;?>
                                                <tr>
                                                    <td>{{$count1++}}</td>
                                                    <td>{{$rd->device->location}}</td>
                                                    <td class="text-primary">+63{{$rd->contact_number}}</td>
                                                    <td>
                                                        <?php
                                                            $date = new DateTime($rd->created_at);
                                                            $result = $date->format('F j, Y, g:i a');
                                                        ?>
                                                        @if($rd->created_at != null)
                                                            {{$result}}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                            @if($count == 0)
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>No Available Data</td>
                                                </tr>
                                            @else
                                            @endif
                                        </tbody>

                                        <!-- This Month Table -->
                                        <tbody hidden id="tble_month">
                                            <?php $count=0; $count1=1;?>
                                            @foreach($registered as $rd)
                                                <?php 
                                                $created_at = $rd->created_at;
                                                $today = date('m/Y');
                                                $date = date('m/Y', strtotime($created_at));
                                                ?>
                                                @if($today == $date)
                                                <?php $count++;?>
                                                <tr>
                                                    <td>{{$count1++}}</td>
                                                    <td>{{$rd->device->location}}</td>
                                                    <td class="text-primary">+63{{$rd->contact_number}}</td>
                                                    <td>
                                                        <?php
                                                            $date = new DateTime($rd->created_at);
                                                            $result = $date->format('F j, Y, g:i a');
                                                        ?>
                                                        @if($rd->created_at != null)
                                                            {{$result}}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                            @if($count == 0)
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>No Available Data</td>
                                                </tr>
                                            @else
                                            @endif
                                        </tbody>

                                        <!-- This Year Table -->
                                        <tbody hidden id="tble_year">
                                            <?php $count=0; $count1=1;?>
                                            @foreach($registered as $rd)
                                                <?php 
                                                $created_at = $rd->created_at;
                                                $today = date('Y');
                                                $date = date('Y', strtotime($created_at));
                                                $time = date('h:i A', strtotime($created_at));
                                                ?>
                                                @if($today == $date)
                                                <?php $count++;?>
                                                <tr>
                                                    <td>{{$count1++}}</td>
                                                    <td>{{$rd->device->location}}</td>
                                                    <td class="text-primary">+63{{$rd->contact_number}}</td>
                                                    <td>
                                                        <?php
                                                            $date = new DateTime($rd->created_at);
                                                            $result = $date->format('F j, Y, g:i a');
                                                        ?>
                                                        @if($rd->created_at != null)
                                                            {{$result}}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                            @if($count == 0)
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>No Available Data</td>
                                                </tr>
                                            @else
                                            @endif
                                        </tbody>
                                    </table>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Logs 6 -->
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><button class="dropdown-item" id="lgToday">Today</button></li>
                                <li><button class="dropdown-item" id="lgMonth">This Month</button></li>
                                <li><button class="dropdown-item" id="lgYear">This Year</button></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Recent Activity <span id="lg">| Today</span></h5>
                            <!-- Today Logs -->
                            <div hidden class="activity" id="lg_today_activity">
                                <?php $count=0;?>
                                    @foreach($logs as $lg)
                                    @if($count < 5)
                                        <?php 
                                        $created_at = $lg->created_at;
                                        $today = date('m/d/Y');
                                        $date = date('m/d/Y', strtotime($created_at));
                                        $time = date('h:i A', strtotime($created_at));
                                        ?>
                                        @if($today == $date)
                                        <?php $count++;?>
                                        <div class="activity-item d-flex" >
                                            <div class="activite-label">{{$time}} </div>
                                            <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                            @if($lg->action_type == '1.1')
                                            <div class="activity-content"> Manage Device - Create </div>
                                            @elseif($lg->action_type == '1.2')
                                            <div class="activity-content"> Manage Device - Update </div>
                                            @elseif($lg->action_type == '1.3')
                                            <div class="activity-content"> Manage Device - Delete </div>
                                            @elseif($lg->action_type == '2')
                                            <div class="activity-content"> Export Data and Deleted</div>
                                            @elseif($lg->action_type == '3.1')
                                            <div class="activity-content"> Generate Water Level Report </div>
                                            @elseif($lg->action_type == '3.2')
                                            <div class="activity-content"> Generate Registered Numbers Report </div>
                                            @elseif($lg->action_type == '4')
                                            <div class="activity-content"> Update Password </div>
                                            @elseif($lg->action_type == '5.1')
                                            <div class="activity-content"> Account logged in </div>
                                            @elseif($lg->action_type == '5.2')
                                            <div class="activity-content"> Account logged out </div>
                                            @endif
                                        </div>
                                        @endif
                                    @endif
                                    @endforeach
                                    @if($count == 0)
                                        <center><div>No Recent Activity</div></center>
                                    @else
                                    @endif
                            </div>
                            <!-- This Month Logs -->
                            <div hidden class="activity" id="lg_month_activity">
                                <?php $count=0;?>
                                    @foreach($logs as $lg)
                                    @if($count < 5)
                                        <?php 
                                        $created_at = $lg->created_at;
                                        $today = date('m/Y');
                                        $date = date('m/Y', strtotime($created_at));
                                        $time = date('m/d/y h:i A', strtotime($created_at));
                                        ?>
                                        @if($today == $date)
                                        <?php $count++;?>
                                        <div class="activity-item d-flex" >
                                            <div class="activite-label">{{$time}} </div>
                                            <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                            @if($lg->action_type == '1.1')
                                            <div class="activity-content"> Manage Device - Create </div>
                                            @elseif($lg->action_type == '1.2')
                                            <div class="activity-content"> Manage Device - Update </div>
                                            @elseif($lg->action_type == '1.3')
                                            <div class="activity-content"> Manage Device - Delete </div>
                                            @elseif($lg->action_type == '2')
                                            <div class="activity-content"> Export Data </div>
                                            @elseif($lg->action_type == '3.1')
                                            <div class="activity-content"> Generate Water Level Report </div>
                                            @elseif($lg->action_type == '3.2')
                                            <div class="activity-content"> Generate Registered Numbers Report </div>
                                            @elseif($lg->action_type == '4')
                                            <div class="activity-content"> Update Password </div>
                                            @elseif($lg->action_type == '5.1')
                                            <div class="activity-content"> Account logged in </div>
                                            @elseif($lg->action_type == '5.2')
                                            <div class="activity-content"> Account logged out </div>
                                            @endif
                                        </div>
                                        @endif
                                    @endif
                                    @endforeach
                                    @if($count == 0)
                                        <center><div>No Recent Activity</div></center>
                                    @else
                                    @endif
                            </div>
                            <!-- This Year Logs -->
                            <div hidden class="activity" id="lg_year_activity">
                                <?php $count=0;?>
                                    @foreach($logs as $lg)
                                    @if($count < 5)
                                        <?php 
                                        $created_at = $lg->created_at;
                                        $today = date('Y');
                                        $date = date('Y', strtotime($created_at));
                                        $time = date('m/d/y h:i A', strtotime($created_at));
                                        ?>
                                        @if($today == $date)
                                        <?php $count++;?>
                                        <div class="activity-item d-flex" >
                                            <div class="activite-label">{{$time}} </div>
                                            <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                            @if($lg->action_type == '1.1')
                                            <div class="activity-content"> Manage Device - Create </div>
                                            @elseif($lg->action_type == '1.2')
                                            <div class="activity-content"> Manage Device - Update </div>
                                            @elseif($lg->action_type == '1.3')
                                            <div class="activity-content"> Manage Device - Delete </div>
                                            @elseif($lg->action_type == '2')
                                            <div class="activity-content"> Export Data </div>
                                            @elseif($lg->action_type == '3.1')
                                            <div class="activity-content"> Generate Water Level Report </div>
                                            @elseif($lg->action_type == '3.2')
                                            <div class="activity-content"> Generate Registered Numbers Report </div>
                                            @elseif($lg->action_type == '4')
                                            <div class="activity-content"> Update Password </div>
                                            @elseif($lg->action_type == '5.1')
                                            <div class="activity-content"> Account logged in </div>
                                            @elseif($lg->action_type == '5.2')
                                            <div class="activity-content"> Account logged out </div>
                                            @endif
                                        </div>
                                        @endif
                                    @endif
                                    @endforeach
                                    @if($count == 0)
                                        <center><div>No Recent Activity</div></center>
                                    @else
                                    @endif
                            </div>
                        </div>
                    </div>
                    <!-- Chart for Devices and Registered Numbers -->
                    <div class="card">
                        <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><button class="dropdown-item" id="reportToday">Today</button></li>
                            <li><button class="dropdown-item" id="reportMonth">This Month</button></li>
                            <li><button class="dropdown-item" id="reportYear">This Year</button></li>
                        </ul>
                        </div>
                        <div class="card-body pb-0">
                        <h5 class="card-title">Device Report <span id="rep">| Today</span></h5>
                        <div id="barChart" style="min-height: 400px;" class="echart"></div>
                        <script>
                            var device_name = @json($device_name);
                            var length = @json($length_today);
                            document.addEventListener("DOMContentLoaded", () => {
                            new ApexCharts(document.querySelector("#barChart"), {
                                series: [{
                                    name: 'Users',
                                    data: length
                                }],
                                chart: {
                                    type: 'bar',
                                    height: 350,
                                    toolbar: {
                                        show: false
                                    },
                                },
                                plotOptions: {
                                    bar: {
                                        borderRadius: 4,
                                        horizontal: true,
                                    }
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                xaxis: {
                                    categories: device_name
                                }
                            }).render();
                            });
                        </script> 
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        // Sidebar
        $('#main-admin-dashboard').removeClass('collapsed')

        // Data Table
        $(document).ready(function (e) {
            $('#dataTable').DataTable();
        })

        // Apex Chart Initialize
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
                enabled: true,
                formatter: function(val) {
                    return parseInt(val);
                },
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
                opposite: true,
            },
            legend: {
                horizontalAlign: 'left'
            },
        }
        var chart = new ApexCharts(document.querySelector("#nm"), options);

        // On Load Chart 
        document.addEventListener("DOMContentLoaded", () => {
            var data = @json($data_today);
            var water_level = @json($wat_today);
            $.each(data, function (key, value) {
                if(key === 0){
                    $('#location-tab-0').addClass('active');
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
        });

        // Function View Data on Chart
        function ViewData(id,name){
            var data = @json($data_today);
            var water_level = @json($wat_today);
            $('[id^="location-tab-"]').removeClass('active');
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
                    })
                }
            });
        }

        // Function New Data on Chart
        function NewData(id,name,location,height,dates){
            $('[id^="location-tab-"]').removeClass('active');
            $('#'+id+'').addClass('active');
            $('#nm').html('');
            chart.render();
            chart.updateSeries([{
                name: location,
                data: height,
            }])
            chart.updateOptions({
                labels: dates,
            })
        }

        // Function Clear on Chart
        function Clear(){
            chart.render();
            chart.updateSeries([{
                name: '',
                data: [],
            }])
            chart.updateOptions({
                labels: [],
            })
        }

        // Device
        var dev_month = document.getElementById('dev_month_activity');
        var dev_year = document.getElementById('dev_year_activity');
        var dev_today = document.getElementById('dev_today_activity');
        dev_today.removeAttribute("hidden");

        // Registered Numbers
        var reg_month = document.getElementById('reg_month_activity');
        var reg_year = document.getElementById('reg_year_activity');
        var reg_today = document.getElementById('reg_today_activity');
        reg_today.removeAttribute("hidden");

        // Logs
        var lg_month = document.getElementById('lg_month_activity');
        var lg_year = document.getElementById('lg_year_activity');
        var lg_today = document.getElementById('lg_today_activity');
        lg_today.removeAttribute("hidden");

        // Table
        var tble_month = document.getElementById('tble_month');
        var tble_year = document.getElementById('tble_year');
        var tble_today = document.getElementById('tble_today');
        tble_today.removeAttribute("hidden");

        // Logs
        $('#lgToday').on('click', function () {
            $('#lg').html('| Today');
            lg_month.setAttribute("hidden", true);
            lg_year.setAttribute("hidden", true);
            lg_today.removeAttribute("hidden");
        })
        $('#lgMonth').on('click', function () {
            $('#lg').html('| This Month');
            lg_today.setAttribute("hidden", true);
            lg_year.setAttribute("hidden", true);
            lg_month.removeAttribute("hidden");
        })
        $('#lgYear').on('click', function () {
            $('#lg').html('| This Year');
            lg_month.setAttribute("hidden", true);
            lg_today.setAttribute("hidden", true);
            lg_year.removeAttribute("hidden");
        })

        // Devices
        $('#deviceToday').on('click', function () {
            $('#dev').html('| Today');
            dev_month.setAttribute("hidden", true);
            dev_year.setAttribute("hidden", true);
            dev_today.removeAttribute("hidden");
        })
        $('#deviceMonth').on('click', function () {
            $('#dev').html('| This Month');
            dev_today.setAttribute("hidden", true);
            dev_year.setAttribute("hidden", true);
            dev_month.removeAttribute("hidden");
        })
        $('#deviceYear').on('click', function () {
            $('#dev').html('| This Year');
            dev_month.setAttribute("hidden", true);
            dev_today.setAttribute("hidden", true);
            dev_year.removeAttribute("hidden");
        })

        // Registered Numbers
        $('#regToday').on('click', function () {
            $('#reg').html('| Today');
            reg_month.setAttribute("hidden", true);
            reg_year.setAttribute("hidden", true);
            reg_today.removeAttribute("hidden");
        })
        $('#regMonth').on('click', function () {
            $('#reg').html('| This Month');
            reg_today.setAttribute("hidden", true);
            reg_year.setAttribute("hidden", true);
            reg_month.removeAttribute("hidden");
        })
        $('#regYear').on('click', function () {
            $('#reg').html('| This Year');
            reg_month.setAttribute("hidden", true);
            reg_today.setAttribute("hidden", true);
            reg_year.removeAttribute("hidden");
        })

        // Table Numbers
        $('#tbleToday').on('click', function () {
            $('#tb').html('| Today');
            tble_month.setAttribute("hidden", true);
            tble_year.setAttribute("hidden", true);
            tble_today.removeAttribute("hidden");
        })
        $('#tbleMonth').on('click', function () {
            $('#tb').html('| This Month');
            tble_today.setAttribute("hidden", true);
            tble_year.setAttribute("hidden", true);
            tble_month.removeAttribute("hidden");
        })
        $('#tbleYear').on('click', function () {
            $('#tb').html('| This Year');
            tble_month.setAttribute("hidden", true);
            tble_today.setAttribute("hidden", true);
            tble_year.removeAttribute("hidden");
        })

        // Device Report Numbers
        $('#reportToday').on('click', function () {
            $('#rep').html('| Today');
            $('#barChart').html('');
            var device_name = @json($device_name);
            var length = @json($length_today);
            new ApexCharts(document.querySelector("#barChart"), {
                series: [{
                    name: 'Users',
                    data: length
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: device_name
                }
            }).render();
            
        })
        $('#reportMonth').on('click', function () {
            $('#rep').html('| This Month');
            $('#barChart').html('');
            var device_name = @json($device_name);
            var length = @json($length_month);
            new ApexCharts(document.querySelector("#barChart"), {
                series: [{
                    name: 'Users',
                    data: length
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: device_name
                }
            }).render();
            
        })
        $('#reportYear').on('click', function () {
            $('#rep').html('| This Year');
            $('#barChart').html('');
            var device_name = @json($device_name);
            var length = @json($length_year);
            new ApexCharts(document.querySelector("#barChart"), {
                series: [{
                    name: 'Users',
                    data: length
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: device_name
                }
            }).render();
        })

        // Water Level Chart
        $('#waterToday').on('click', function () {
            Clear();
            $('#nm').html('');
            $('#nav-tab').html('');
            $('#reportsChart').html('');
            $('#wat').html('| Today');
            var data = @json($data_today);
            var water_level = @json($wat_today);
            $.each(data, function (key, value) {
                var height = [];
                var dates = [];
                $.each(value.data.height, function (k1, val1) {
                    height[k1] = val1;
                });
                $.each(value.data.dates, function (k2, val2) {
                    dates[k2] = val2;
                });

                $('#nav-tab').append('<button class="nav-link fw-semi-bold" id="location-tab-'+key+'">'+value.data.name+'</button>');
                document.getElementById('location-tab-'+key+'').onclick = function() {
                    NewData('location-tab-'+key+'',value.data.name,value.data.location,height,dates)
                };
                if(key === 0){
                    $('#location-tab-0').addClass('active');
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
                 
        })
        $('#waterMonth').on('click', function () {
            Clear();
            $('#nm').html('');
            $('#nav-tab').html('');
            $('#reportsChart').html('');
            $('#wat').html('| This Month');
            var data = @json($data_month);
            var water_level = @json($wat_month);
            $.each(data, function (key, value) {
                var height = [];
                var dates = [];
                $.each(value.data.height, function (k1, val1) {
                    height[k1] = val1;
                });
                $.each(value.data.dates, function (k2, val2) {
                    dates[k2] = val2;
                });

                $('#nav-tab').append('<button class="nav-link fw-semi-bold" id="location-tab-'+key+'">'+value.data.name+'</button>');
                document.getElementById('location-tab-'+key+'').onclick = function() {
                    NewData('location-tab-'+key+'',value.data.name,value.data.location,height,dates)
                };
                if(key === 0){
                    $('#location-tab-0').addClass('active');
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
        })
        $('#waterYear').on('click', function () {
            Clear();
            $('#nm').html('');
            $('#nav-tab').html('');
            $('#reportsChart').html('');
            $('#wat').html('| This Year');
            var data = @json($data_year);
            var water_level = @json($wat_year);
            $.each(data, function (key, value) {
                var height = [];
                var dates = [];
                $.each(value.data.height, function (k1, val1) {
                    height[k1] = val1;
                });
                $.each(value.data.dates, function (k2, val2) {
                    dates[k2] = val2;
                });

                $('#nav-tab').append('<button class="nav-link fw-semi-bold" id="location-tab-'+key+'">'+value.data.name+'</button>');
                document.getElementById('location-tab-'+key+'').onclick = function() {
                    NewData('location-tab-'+key+'',value.data.name,value.data.location,height,dates)
                };
                if(key === 0){
                    $('#location-tab-0').addClass('active');
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
        })
    </script>
@endsection


