@extends('layouts.app')
@section('title','Profile')

@section('admin_content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Account</li>
                    <li class="breadcrumb-item active">Profile</li> 
                </ol>
            </nav>
        </div>
        <section class="section profile">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="padding-left:.5rem; padding-right:.5rem">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item"> <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button></li>
                                <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button></li>
                                <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-logs">Logs</button></li>
                            </ul>
                        <div class="mt-2 tab-content pt-2">
                            <!-- Profile Overview -->
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">About</h5>
                                <p class="small fst-italic"><strong style="color:#4154f1">FLSys</strong> is a Flood Monitoring System in the Philippines which monitors water levels in remote sites in rivers, creeks, canals and roads. The system sends alerts in the event of rising water levels and can do classification such as above normal, severe, and extreme. These alerts can be extended to the public via a website or thru SMS/Text alerts. </p>
                                <h5 class="card-title">Account Details</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">User</div>
                                    <div class="col-lg-9 col-md-8">Admin</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Job</div>
                                    <div class="col-lg-9 col-md-8">Web Manager</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Country</div>
                                    <div class="col-lg-9 col-md-8">Philippines</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Username / Email</div>
                                    <div class="col-lg-9 col-md-8">{{Auth::user()->email}}</div>
                                </div>
                            </div>
                            <!-- Change Password -->
                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert" style="padding-top:11px; padding-bottom:11px"> 
                                    <i class="bi bi-info-circle me-1"></i> Last Updated : 
                                    <?php
                                        $date = new DateTime($last_updated);
                                        $result = $date->format('F j, Y, g:i a');
                                    ?>
                                    {{$result}}
                                </div>
                                <form id="change_pass">
                                @csrf
                                    <input type="hidden" class="form-control" id="id" name="id" value="{{Auth::user()->id}}">
                                    <input type="hidden" class="form-control" id="user_type" name="user_type" value="{{Auth::user()->user_type}}">
                                    <div class="row mb-3">
                                        <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9"> 
                                            <input name="current_password" type="password" class="form-control" id="current_password">
                                            <!-- Error Message -->
                                            <div class="error-pad">
                                                <span class="errorMsg_current_password"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9"> 
                                            <input name="new_password" type="password" class="form-control" id="new_password">
                                            <!-- Error Message -->
                                            <div class="error-pad">
                                                <span class="errorMsg_new_password"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="retype_password" class="col-md-4 col-lg-3 col-form-label">Re-type New Password</label>
                                        <div class="col-md-8 col-lg-9"> 
                                            <input name="retype_password" type="password" class="form-control" id="retype_password">
                                            <!-- Error Message -->
                                            <div class="error-pad">
                                                <span class="errorMsg_retype_password"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center "> 
                                        <button id="save_pass" type="submit" class="btn btn-primary mt-2 mb-2">Change Password</button>
                                    </div>
                                </form>
                            </div>
                            <!-- Admin Logs -->
                            <div class="tab-pane fade pt-3" id="profile-logs">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert" style="padding-top:11px; padding-bottom:11px"> 
                                    <i class="bi bi-info-circle me-1"></i> Admin log viewer.
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table table-hover">
                                            <thead class="table-light" style="border-bottom: 2px solid #e3e6f0;">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Account Type</th>
                                                    <th scope="col">Action</th>
                                                    <th scope="col">Status Code</th>
                                                    <th scope="col">Date Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $count = 1; ?>
                                            @foreach ($logs as $lg)
                                                <tr>
                                                    <td>{{$count++}}</td>
                                                    @if($lg->user_type == 1)
                                                    <?php $user = 'Admin';?>
                                                    @endif
                                                    <td>{{$user}}</td>

                                                    <?php 
                                                    if($lg->action_type == '1.1'){
                                                        $action = 'Manage Device - Create';
                                                    }else if($lg->action_type == '1.2'){
                                                        $action = 'Manage Device - Update';
                                                    }else if($lg->action_type == '1.3'){
                                                        $action = 'Manage Device - Delete';
                                                    }else if($lg->action_type == '2'){
                                                        $action = 'Exported Data and Deleted';
                                                    }else if($lg->action_type == '3.1'){
                                                        $action = 'Generate Water Level Report';
                                                    }else if($lg->action_type == '3.2'){
                                                        $action = 'Generate Registered Numbers Report';
                                                    }else if($lg->action_type == '4'){
                                                        $action = 'Update Password';
                                                    }else if($lg->action_type == '5.1'){
                                                        $action = 'Account logged in';
                                                    }else if($lg->action_type == '5.2'){
                                                        $action = 'Account logged out';
                                                    }
                                                    ?>
                                                    <td>{{$action}}</td>

                                                    <td>{{$lg->status_code}}</td>
                                                    <td>
                                                        <?php
                                                        $date = new DateTime($lg->created_at);
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
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        // Sidebar
        $('#main-admin-profile').removeClass('collapsed');

        $('#dataTable').DataTable({
            order: [[0, 'desc']],
        });

        $(document).ready(function (e) {
            // Update/Edit Data
            $(document).on('submit','#change_pass', function(e) {
                $("#profile-change-password .errorMsg_current_password").html('');
                $("#profile-change-password .errorMsg_new_password").html('');
                $("#profile-change-password .errorMsg_retype_password").html('');
                e.preventDefault();
                let editformData = new FormData($('#change_pass')[0]);
                $.ajax({
                    type:'POST',
                    url: "{{ url('/api/profile/change_password') }}",
                    data: editformData,
                    cache: false,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    // If success, return message
                    success: (data) => {
                        if(data == 1){
                            let msg_current_password = "<text>The password is incorrect.</text>";
                            $("#main .errorMsg_current_password").html(msg_current_password).addClass('text-danger').fadeIn(1000);
                            $("#main button").attr('disabled',false);
                        }else if(data == 2){
                            let msg_new_password = "<text>Please choose a new password.</text>";
                            $("#main .errorMsg_new_password").html(msg_new_password).addClass('text-danger').fadeIn(1000);
                            $("#main button").attr('disabled',false);
                        }else{
                            var dialog = bootbox.dialog({
                                centerVertical: true,
                                closeButton: false,
                                title: 'Updating Password',
                                message: '<p class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </p>'
                            }); 
                            dialog.init(function(){
                                setTimeout(function(){
                                    dialog.find('.bootbox-body').html('Password Successfully updated!');
                                    window.location.reload();
                                }, 1500);
                            });
                        }
                        
                    },
                    // If fail, show errors
                    error: function(data) {
                        const error2 = data.responseJSON.errors;
                        let error_current_password = "";
                        let error_new_password = "";
                        let error_retype_password = "";
                        for (const listKey in error2){
                            if(listKey == "current_password"){
                                error_current_password = ""+error2[listKey]+"";
                            }else if(listKey == "new_password"){
                                error_new_password = ""+error2[listKey]+"";
                            }else if(listKey == "retype_password"){
                                error_retype_password = ""+error2[listKey]+"";
                            }
                        }
                        let msg_current_password = "<text>"+error_current_password+"</text>";
                        let msg_new_password = "<text>"+error_new_password+"</text>";
                        let msg_retype_password = "<text>"+error_retype_password+"</text>";
                        $("#main .errorMsg_current_password").html(msg_current_password).addClass('text-danger').fadeIn(1000);
                        $("#main .errorMsg_new_password").html(msg_new_password).addClass('text-danger').fadeIn(1000);
                        $("#main .errorMsg_retype_password").html(msg_retype_password).addClass('text-danger').fadeIn(1000);
                        $("#main button").attr('disabled',false);
                    }
                });
            });
        });
    </script>
@endsection


