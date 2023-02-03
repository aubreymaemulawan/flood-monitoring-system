@extends('layouts.app')
@section('title','Registered Numbers')

@section('admin_content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Registered Numbers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./admin">Home</a></li>
                    <li class="breadcrumb-item">Management</li>
                    <li class="breadcrumb-item active">Registered Numbers</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header card-head-pad">
                            <h5 class="card-title">Flood Monitoring Phone Numbers List</h5>
                            <div class="alert alert-primary alert-dismissible fade show" role="alert" style="padding-top:11px; padding-bottom:11px"> 
                                <i class="bi bi-info-circle me-1"></i> Any changes to the water levels in any of the locations we have will be alerted to the phone numbers on this list. 
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-hover">
                                    <thead class="table-light" style="border-bottom: 2px solid #e3e6f0;">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Registered Location</th>
                                            <th scope="col">Contact Number</th>
                                            <th scope="col">Date Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 1; ?>
                                        @foreach ($registered_numbers as $rn)
                                        <tr>
                                            <th scope="row">{{$count++}}</th>
                                            <td data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="{{$rn->device->device_name}}">{{$rn->device->location}}</td>
                                            <td>+63{{$rn->contact_number}}</td>
                                            <td>
                                                <?php
                                                    $date = new DateTime($rn->created_at);
                                                    $result = $date->format('F j, Y, g:i a');
                                                ?>
                                                {{$result}}
                                            </td>
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
        $('#main-admin-registeredNumbers').removeClass('collapsed')
        
        // Data Table
        $('#dataTable').DataTable({order: [[0, 'desc']]});
    </script>
@endsection


