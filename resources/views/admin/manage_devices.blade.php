@extends('layouts.app')
@section('title','Manage Devices')

@section('modal')
    <!-- Adding / Editing Modal -->
        <div class="modal fade" id="main-modal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <!-- Adding Form -->
                <form class="modal-content">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="main-modalTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Input Hidden ID -->
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" class="form-control" id="user_type" name="user_type" value="{{Auth::user()->user_type}}">
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="row">
                            <!-- Input Device Name -->
                            <div class="col mb-3">
                                <label for="device_name" class="form-label">Device Name</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="bx bx-devices"></i>
                                    </span>
                                    <input type="text" id="device_name" name="device_name" class="form-control"/>
                                </div>
                                <!-- Error Message -->
                                <div class="error-pad">
                                    <span class="errorMsg_device_name"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Input Location -->
                            <div id="last" class="col mb-3">
                                <label for="location" class="form-label">Location</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="bx bx-location-plus"></i>
                                    </span>
                                    <input type="text" id="location" name="location" class="form-control"/>
                                </div>
                                <!-- Error Message -->
                                <div class="error-pad">
                                    <span class="errorMsg_location"></span>
                                </div>
                            </div>
                        </div>
                        <div id="main-append" style="display:none"></div>
                    </div>
                    <!-- Submit Form -->
                    <div class="modal-footer">
                        <button id="main-close" type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="main-submit" type="button" onclick="Save()" class="btn btn-primary"></button>
                    </div>
                </form>
            </div>
        </div>
    <!-- End of Adding / Editing Modal -->
@endsection

@section('admin_content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Manage Devices</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./admin">Home</a></li>
                    <li class="breadcrumb-item">Management</li>
                    <li class="breadcrumb-item active">Manage Devices</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header card-head-pad" style="padding-left:2rem">
                            <h5 class="card-title">Flood Monitoring Device List</h5>
                            <button onclick="Add()" type="button" class="btn btn-primary mb-2 rounded-pill">
                                <i class="bi bi-plus me-1"></i> Add New
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-hover">
                                    <thead class="table-light" style="border-bottom: 2px solid #e3e6f0;">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Device Name</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Registered</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date Created</th>
                                            <th scope="col">Date Updated</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 1; $cnt=0;?>
                                        @foreach ($device as $dc)
                                        <?php $cnt=0;?>
                                        <tr>
                                            <th scope="row">{{$count++}}</th>
                                            <td>{{$dc->device_name}}</td>
                                            <td>{{$dc->location}}</td>
                                            <td>
                                                @foreach($registered as $rs)
                                                    @if($rs->device_id == $dc->id)
                                                        <?php $cnt++;?>
                                                    @endif
                                                @endforeach
                                                {{$cnt}}
                                            </td>
                                            <!-- Status column -->
                                            @if ($dc->status == 1)
                                            <td><span class="badge rounded-pill bg-success">Active</span></td>
                                            @elseif ($dc->status == 2)
                                            <td><span class="badge rounded-pill bg-danger">Not Active</span></td>
                                            @endif
                                            <td>
                                                <?php
                                                $date = new DateTime($dc->created_at);
                                                $result1 = $date->format('F j, Y, g:i a');
                                                ?>
                                                {{$result1}}
                                            </td>
                                            <td>
                                               <?php
                                                $date = new DateTime($dc->updated_at);
                                                $result2 = $date->format('F j, Y, g:i a');
                                                ?>
                                                {{$result2}}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <!-- View -->
                                                        <button onclick="Edit({{ $dc->id }})" class="dropdown-item" href="javascript:void(0);">
                                                            <i class="bx bx-info-square me-1"></i>
                                                            Edit
                                                        </button>
                                                        <!-- Delete -->
                                                        <button onclick="Delete({{ $dc->id }})" class="dropdown-item" href="javascript:void(0);">
                                                            <i class="bx bx-trash me-1"></i>
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
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
        $('#main-admin-manageDevices').removeClass('collapsed')
        
        // Data Table
        $('#dataTable').DataTable({order: [[0, 'desc']]});

        // Onclick Add Function
        function Add(){
            $('#main-append').html('');
            document.getElementById("main-modalTitle").innerHTML= "Create Device Information";
            document.getElementById("main-submit").innerHTML= "Create";
            // Clear Input Fields
            $('#id').val('-1'),
            $('#device_name').val(''),
            $('#location').val(''),
            // Clear Error Messages
            $("#main-modal .errorMsg_device_name").html('');
            $("#main-modal .errorMsg_location").html('');
            // Show Modal
            $('#main-modal').modal('show');
        }

        // Onclick Save Function
        function Save() {
            // Get Values from input fields
            var data = {
                id: $('#id').val(),
                device_name: $('#device_name').val(),
                location: $('#location').val(),
                status: $('#status').val(),
                user_id: $('#user_id').val(),
                user_type: $('#user_type').val(),
            }
            // Add Data to Database
            if(data.id == -1) {
                Controller.Post('/api/device/create', data)
                // If success, return message
                .done(function(result) {
                    var dialog = bootbox.dialog({
                    centerVertical: true,
                    closeButton: false,
                    title: 'Saving Information',
                    message: '<p class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </p>'
                    });
                    $('#main-modal').modal('hide');
                    dialog.init(function(){
                        setTimeout(function(){
                            dialog.find('.bootbox-body').html('Information Successfully saved!');
                            window.location.reload();
                        }, 1500);
                    });
                })
                // If fail, show errors
                .fail(function (error) {
                    const error1 = error.responseJSON.errors;
                    let error_device_name = "";
                    let error_location = "";
                    for (const listKey in error1){
                        if(listKey == "device_name"){
                            error_device_name = ""+error1[listKey]+"";
                        }else if(listKey == "location"){
                            error_location = ""+error1[listKey]+"";
                        }
                    }
                    let msg_device_name = "<text>"+error_device_name+"</text>";
                    let msg_location = "<text>"+error_location+"</text>";
                    $("#main-modal .errorMsg_device_name").html(msg_device_name).addClass('text-danger').fadeIn(1000);
                    $("#main-modal .errorMsg_location").html(msg_location).addClass('text-danger').fadeIn(1000);
                    $("#main-modal button").attr('disabled',false);
                })
            }
            // Update Data to Database
            else if(data.id > 0) {
                Controller.Post('/api/device/update', data)
                // If success, return message
                .done(function(result) {
                    var dialog = bootbox.dialog({
                    centerVertical: true,
                    closeButton: false,
                    title: 'Updating Information',
                    message: '<p class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </p>'
                    });
                    $('#main-modal').modal('hide');
                    dialog.init(function(){
                        setTimeout(function(){
                            dialog.find('.bootbox-body').html('Information Successfully updated!');
                            window.location.reload();
                        }, 1500);
                    });
                })
                // If fail, show errors
                .fail(function (error) {
                    const error1 = error.responseJSON.errors;
                    let error_device_name = "";
                    let error_location = "";
                    let error_status = "";
                    for (const listKey in error1){
                        if(listKey == "device_name"){
                            error_device_name = ""+error1[listKey]+"";
                        }else if(listKey == "location"){
                            error_location = ""+error1[listKey]+"";
                        }else if(listKey == "status"){
                            error_status = ""+error1[listKey]+"";
                        }
                    }
                    let msg_device_name = "<text>"+error_device_name+"</text>";
                    let msg_location = "<text>"+error_location+"</text>";
                    let msg_status = "<text>"+error_status+"</text>";
                    $("#main-modal .errorMsg_device_name").html(msg_device_name).addClass('text-danger').fadeIn(1000);
                    $("#main-modal .errorMsg_location").html(msg_location).addClass('text-danger').fadeIn(1000);
                    $("#main-modal .errorMsg_status").html(msg_status).addClass('text-danger').fadeIn(1000);
                    $("#main-modal button").attr('disabled',false);
                })    
            }
        }

        // Onclick Edit Function
        function Edit(id) {
            $('#main-append').html('');
            document.getElementById("main-modalTitle").innerHTML="Edit Device Information";
            document.getElementById("main-submit").innerHTML= "Save";
            // Show Values in Modal
            Controller.Post('/api/device/items', { 'id': id }).done(function(result) {
                // Clear Error Messages
                $("#main-modal .errorMsg_device_name").html('');
                $("#main-modal .errorMsg_location").html('');
                // Status Input Field
                $('#last').removeClass('mb-3');
                $('#main-append').addClass('mb-3');
                $('#main-append').show();
                $("#main-append").append('<div id="main-status" class="row">');
                $("#main-append").append('<div class="col mt-0 mb-3">');
                $("#main-append").append('<label for="status" class="form-label">Status</label>');
                $("#main-append").append('<div class="input-group input-group-merge">');
                $("#main-append").append('<select class="form-select" id="status" name="status"> <option value="1">Active</option> <option value="2">Not Active</option> </select>');
                $("#main-append").append('</div>');
                $("#main-append").append('<div class="error-pad">');
                $("#main-append").append('<span class="errorMsg_status"></span>');
                $("#main-append").append('</div>');
                $("#main-append").append('</div>');
                $("#main-append").append('</div>');
                // Show ID values in Input Fields
                $('#id').val(result.id),
                $('#device_name').val(result.device_name),
                $('#location').val(result.location),
                $('#status').val(result.status),
                // Show Modal
                $('#main-modal').modal('show');
            });
        }

        // Onclick Delete Function
        function Delete(id) {
            var user_id = '{{Auth::user()->id}}';
            var user_type = '{{Auth::user()->user_type}}';
            bootbox.confirm({
                title: "Deleting Information",
                closeButton: false,
                message: "Are you sure you want to delete this item? This cannot be undone.",
                buttons: {
                    cancel: {
                        label: 'Cancel',
                        className : "btn btn-outline-secondary",
                    },
                    confirm: {
                        label: 'Confirm',
                        className : "btn btn-primary",
                    }
                },
                centerVertical: true,
                callback: function(result){
                    if(result) {
                        Controller.Post('/api/device/delete', { 'id': id, 'user_id':user_id , 'user_type':user_type  }).done(function(result) {
                            if(result == 1){
                                bootbox.confirm({
                                    title: "Oops! Water Level data is available with this ID.",
                                    closeButton: false,
                                    message: "Go to water level list?",
                                    buttons: {
                                        cancel: {
                                            label: 'No',
                                            className : "btn btn-outline-secondary",
                                        },
                                        confirm: {
                                            label: 'Yes',
                                            className : "btn btn-primary",
                                        }
                                    },
                                    centerVertical: true,
                                    callback: function(result){
                                        if(result) {
                                            location.href = './water-level';
                                        }
                                    }
                                    })
                            }else if(result == 2){
                                bootbox.confirm({
                                    title: "Oops! Registered Numbers is available with this ID.",
                                    closeButton: false,
                                    message: "Go to registered numbers list?",
                                    buttons: {
                                        cancel: {
                                            label: 'No',
                                            className : "btn btn-outline-secondary",
                                        },
                                        confirm: {
                                            label: 'Yes',
                                            className : "btn btn-primary",
                                        }
                                    },
                                    centerVertical: true,
                                    callback: function(result){
                                        if(result) {
                                            location.href = './registered-numbers';
                                        }
                                    }
                                    })
                            }else{
                                var dialog = bootbox.dialog({
                                    centerVertical: true,
                                    closeButton: false,
                                    title: 'Deleting Information',
                                    message: '<p class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </p>'
                                });
                                dialog.init(function(){
                                    setTimeout(function(){
                                        dialog.find('.bootbox-body').html('Information Successfully deleted!');
                                        window.location.reload();
                                    }, 1500);
                                    
                                });
                            }
                        });
                    }
                }
            })
        }
    </script>
@endsection


