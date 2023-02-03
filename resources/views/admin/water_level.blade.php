@extends('layouts.app')
@section('title','Water Level')

@section('admin_content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Water Level</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./admin">Home</a></li>
                    <li class="breadcrumb-item">Management</li>
                    <li class="breadcrumb-item active">Water Level</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header card-head-pad">
                            <h5 class="card-title">Water Level Alert Warning</h5>
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
                                    <?php $count = 1; ?>
                                        @foreach ($water_level as $wl)
                                        <tr>
                                            <th scope="row">{{$count++}}</th>
                                            <td data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="{{$wl->device->device_name}}">{{$wl->device->location}}</td>
                                            <td>{{$wl->height}} cm</td>
                                            <!-- Status column -->
                                            @if ($wl->color == 'red')
                                            <td><span class="badge rounded-pill bg-danger">Extreme</span></td>
                                            @elseif ($wl->color == 'orange')
                                            <td><span style="background-color:orange;color:white" class="badge rounded-pill">Severe</span></td>
                                            @elseif ($wl->color == 'green')
                                            <td><span class="badge rounded-pill bg-success">Above Normal</span></td>
                                            @endif
                                            <td>
                                                <?php
                                                $date = new DateTime($wl->created_at);
                                                $result = $date->format('F j, Y, g:i a');
                                                ?>
                                                {{$result}}
                                            </td>
                                        </div>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
        $('[id^="main-"]').addClass('collapsed')
        $('[id^="mid-"]').addClass('collapse')
        $('#main-admin-waterLevel').removeClass('collapsed')
        $('[id^="menu-"]').removeClass('active')
        
        // Data Table
        $('#dataTable').DataTable({order: [[0, 'desc']]});
    </script>
@endsection


