@extends('layouts.main')
@section('title','Welcome')

@section('index_modal')
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
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="row">
                            <!-- Input Contact Number -->
                            <div class="col mb-3">
                                <label for="contact" class="form-label">Contact Number</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="bi bi-phone"></i>
                                    </span>
                                    <input type="text" id="contact" name="contact" class="form-control"/>
                                </div>
                                <!-- Error Message -->
                                <div class="error-pad">
                                    <span class="errorMsg_contact"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Input Device ID -->
                            <div id="last" class="col mb-3">
                                <label for="device" class="form-label">Location</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class="bi bi-map"></i>
                                    </span>
                                    <select class="form-select" id="device" name="device"> 
                                        <option value="label" style="display:none;" disabled>Choose an option</option>
                                        @foreach($device as $dv)
                                            <option value="{{$dv->id}}">{{$dv->location}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Error Message -->
                                <div class="error-pad">
                                    <span class="errorMsg_device"></span>
                                </div>
                            </div>
                        </div>
                        <div id="main-append" style="display:none"></div>
                    </div>
                    <!-- Submit Form -->
                    <div class="modal-footer">
                        <button id="main-close" type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="main-submit" type="button" onclick="Validate()" class="btn btn-primary"></button>
                    </div>
                </form>
            </div>
        </div>
    <!-- End of Adding / Editing Modal -->
@endsection

@section('index_pages')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="index/img/carousel-1.jpg" alt="Image" />
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <h1 class="display-3 text-light mb-4 animated slideInDown">
                                        Be Flood Aware. Be Flood Ready.
                                    </h1>
                                    <p class="text-light fs-5 mb-5">
                                        While floods can cause significant damage, destruction, and devastation, 
                                        it is possible to mitigate these consequences by being prepared. 
                                    </p>
                                    <a href="#water" class="btn btn-primary py-3 px-5">Check Water Levels</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="index/img/carousel-2.png" alt="Image" />
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <h1 class="display-3 text-light mb-4 animated slideInDown">
                                        Green. Orange. Red. 
                                    </h1>
                                    <p class="text-light fs-5 mb-5">
                                        Monitor water levels in your areas and receive alerts in the event of rising water levels 
                                        with classification such as above normal, 
                                        severe, and extreme.
                                    </p>
                                    <a href="#water" class="btn btn-primary py-3 px-5">Check Water Levels</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Color Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp " style="max-width: 500px">
                <h1 class="display-6 mb-5">
                Water Level Alert Warning Information
                </h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded h-100 p-5">
                        <div class="d-flex align-items-center ms-n5 mb-4">
                            <div class="service-icon flex-shrink-0 bg-success rounded-end me-4">
                                <i class="bi bi-water text-white" style="font-size: 30px;"></i>
                            </div>
                            <h4 class="mb-0">Green</h4>
                        </div>
                        <p class="mb-4">
                            <strong>ALERT!</strong>
                            Flood water level reaches ankle to knee level and car tires but still be passable.
                        </p>
                        <a class="btn btn-light px-3" onclick="not_available()">Read More</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded h-100 p-5">
                        <div class="d-flex align-items-center ms-n5 mb-4">
                            <div class="service-icon flex-shrink-0 rounded-end me-4" style="background-color:orange;">
                                <i class="bi bi-water text-white" style="font-size: 30px;"></i>
                            </div>
                            <h4 class="mb-0">Orange</h4>
                        </div>
                        <p class="mb-4">
                            <strong>WARNING!</strong>
                            Flood water level reaches knee to hips level and car window and not passable.
                        </p>
                        <a class="btn btn-light px-3" onclick="not_available()">Read More</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded h-100 p-5">
                        <div class="d-flex align-items-center ms-n5 mb-4">
                            <div class="service-icon flex-shrink-0 bg-danger rounded-end me-4" >
                                <i class="bi bi-water text-white" style="font-size: 30px;"></i>
                            </div>
                            <h4 class="mb-0">Red</h4>
                        </div>
                        <p class="mb-4">
                            <strong>DANGER!</strong>
                            Flood water level reaches hips to chest level and car rooftop and not passable.
                        </p>
                        <a class="btn btn-light px-3" onclick="not_available()">Read More</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Color End -->

    <!-- Table Start -->
    <div id="water" class="container-fluid appointment my-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container-md wow fadeIn" data-wow-delay="0.1s">
            <div class="row">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                    <h1 class="text-light display-6 mb-4">
                        Real-Time Water Levels
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
                                <tbody id="main_table">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->

    <!-- Registered Numbers Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden rounded ps-5 pt-5 h-100" style="min-height: 400px">
                        <img class="position-absolute w-100 h-100" src="index/img/text-message.png" alt="" style="object-fit: cover"/>
                        <div class="position-absolute top-0 start-0 bg-white rounded pe-3 pb-3" style="width: 200px; height: 200px" >
                            <div class="d-flex flex-column justify-content-center text-center bg-primary rounded h-100 p-3" >
                                <h4 class="text-white ">Receive</h4>
                                <h3 class="text-white">SMS/Text</h3>
                                <h5 class="text-white mb-0">Alerts</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h1 class="display-6 mb-5">
                            Get Real-Time Alerts of Rising Water Levels
                        </h1>
                        <p class="mb-4">
                            Register your mobile numbers to receive real-time data on the 
                            event of rising water levels on your area. You can be able to monitor 
                            water levels and can help you prepare and prevent floods and flood-related problems. 
                        </p>
                        <div class="border-top mt-4 pt-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-4">
                                    <div class="row g-3">
                                        <div class="col-sm-12">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number" />
                                                <label for="contact_number">Contact Number</label>
                                            </div>
                                            <!-- Error Message -->
                                            <div class="error-pad">
                                                <span id="errorMsg_contact_number"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-floating">
                                                <select class="form-select" id="device_id" name="device_id" aria-label="Floating label select example" placeholder="Available Locations" > 
                                                    <option value="label" style="display:none;" disabled>Choose an option</option>
                                                    @foreach($device as $dv)
                                                        @if($dv->status == 1)
                                                            <option value="{{$dv->id}}">{{$dv->location}}</option> 
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <label for="device_id">Available Locations</label>
                                            </div>
                                            <!-- Error Message -->
                                            <div class="error-pad">
                                                <span id="errorMsg_device_id"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <p class="small mb-0">Stop Receiving SMS?
                                                <button class="text-primary" onclick="Remove()" style=" background:none; border:none;">Click here</button>
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <button id="but" onclick="Save()" class="btn btn-primary py-3 px-5">
                                                Register
                                            </button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Registered Numbers End -->
@endsection

@section('index_scripts')
    <script>
        // Sidebar
        $('[id^="nav-"]').removeClass('active')
        $('#nav-home').addClass('active')
        
        // Data Table
        $('#dataTable').DataTable({
            order: [[0, 'desc']],
            searching: true, 
            paging: true, 
            info: true,
            "bPaginate": true,
        });
        
        // Clear Input Fields
        $('#contact_number').val('')
        $('#device_id').val('label')

        // Clear Error Messages
        $("#errorMsg_contact_number").html('');
        $("#errorMsg_device_id").html('');

        // Onclick Save Function
        function Save() {
            $("#errorMsg_contact_number").html('');
            $("#errorMsg_device_id").html('');
            // Get Values from input fields
            var data = {
            contact_number: $('#contact_number').val(),
            device_id: $('#device_id').val(),
            }
            // Add Data to Database
            Controller.Post('/api/registered/create', data)
            // If success, return message
            .done(function(result) {
                if(result == 0){
                    let msg_contact_number = "<text>The contact number has already been registered for this location.</text>";
                    $("#errorMsg_contact_number").html(msg_contact_number).addClass('text-danger').fadeIn(1000);
                    $("#but").attr('disabled',false);
                }else{
                    var dialog = bootbox.confirm({
                    centerVertical: true,
                    closeButton: false,
                    title: 'Sending Information',
                    message: '<p class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </p>',
                    buttons: {
                        cancel: {
                            label: 'Cancel',
                            className : "d-none",
                        },
                        confirm: {
                            label: 'OK',
                            className : "btn btn-primary",
                        }
                    },
                    callback: function(result) {
                        if(result){
                            window.location.reload();  
                        }
                    }
                    });
                    dialog.init(function(){
                        setTimeout(function(){
                            dialog.find('.bootbox-body').html('Information Successfully registered! You will now receive sms updates on changes of water levels in your chosen area.');
                        }, 1500);
                    });
                }
                
            })
            // If fail, show errors
            .fail(function (error) {
                const error1 = error.responseJSON.errors;
                let error_contact_number = "";
                let error_device_id = "";
                for (const listKey in error1){
                    if(listKey == "contact_number"){
                        error_contact_number = ""+error1[listKey]+"";
                    }else if(listKey == "device_id"){
                        error_device_id = ""+error1[listKey]+"";
                    }
                }
                let msg_contact_number = "<text>"+error_contact_number+"</text>";
                let msg_device_id = "<text>"+error_device_id+"</text>";
                $("#errorMsg_contact_number").html(msg_contact_number).addClass('text-danger').fadeIn(1000);
                $("#errorMsg_device_id").html(msg_device_id).addClass('text-danger').fadeIn(1000);
                $("#but").attr('disabled',false);
            })
        }

        // Onclick Remove Function
        function Remove(){
            $('#main-append').html('');
            document.getElementById("main-modalTitle").innerHTML= "Remove SMS Notification";
            document.getElementById("main-submit").innerHTML= "Remove";
            // Clear Input Fields
            $('#device').val(''),
            $('#contact').val(''),
            // Clear Error Messages
            $("#main-modal .errorMsg_device").html('');
            $("#main-modal .errorMsg_contact").html('');
            // Show Modal
            $('#main-modal').modal('show');
        }

        // Onclick Validate Function
        function Validate(){
            // Get Values from input fields
            var data = {
            contact: $('#contact').val(),
            device: $('#device').val(),
            }
            // Add Data to Database
            Controller.Post('/api/registered/valid', data)
            // If success, return message
            .done(function(result) {
                if(result == 0){
                    bootbox.alert({
                        message: "Information not found in our list.",
                        centerVertical: true,
                        closeButton: false,
                        size: 'medium'
                    }); 
                }else{
                    $('#main-modal').modal('hide');
                    bootbox.confirm({
                        title: "Deleting Information",
                        closeButton: false,
                        message: "Are you sure you want to stop receiving sms water level notification? This cannot be undone.",
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
                        callback: function(res){
                            if(res) {
                                Controller.Post('/api/registered/delete', { 'id': result.id }).done(function(res) {
                                    var dialog = bootbox.confirm({
                                        centerVertical: true,
                                        closeButton: false,
                                        title: 'Deleting Information',
                                        message: '<p class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </p>',
                                        buttons: {
                                            cancel: {
                                                label: 'Cancel',
                                                className : "d-none",
                                            },
                                            confirm: {
                                                label: 'OK',
                                                className : "btn btn-primary",
                                            }
                                        },
                                        callback: function(r) {
                                            if(r){
                                                window.location.reload();  
                                            }
                                        }
                                    });
                                    dialog.init(function(){
                                        setTimeout(function(){
                                            dialog.find('.bootbox-body').html('Information Successfully removed! You are now removed and will not be receiving sms on changes of water levels in your chosen area.');
                                        }, 1500);
                                        
                                    });
                                    
                                });
                            }
                        }
                    })
                }
                
            })
            // If fail, show errors
            .fail(function (error) {
                const error1 = error.responseJSON.errors;
                let error_contact = "";
                let error_device = "";
                for (const listKey in error1){
                    if(listKey == "contact"){
                        error_contact = ""+error1[listKey]+"";
                    }else if(listKey == "device"){
                        error_device = ""+error1[listKey]+"";
                    }
                }
                let msg_contact = "<text>"+error_contact+"</text>";
                let msg_device = "<text>"+error_device+"</text>";
                $("#main-modal .errorMsg_contact").html(msg_contact).addClass('text-danger').fadeIn(1000);
                $("#main-modal .errorMsg_device").html(msg_device).addClass('text-danger').fadeIn(1000);
                $("#but").attr('disabled',false);
            })
        }

        // Onclick Delete Function
        function Delete(id) {
            $('#main-modal').modal('hide');
            bootbox.confirm({
                title: "Deleting Information",
                closeButton: false,
                message: "Are you sure you want to stop receiving sms water level notification? This cannot be undone.",
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
                        Controller.Post('/api/registered/delete', { 'id': id }).done(function(result) {
                            var dialog = bootbox.dialog({
                                centerVertical: true,
                                closeButton: false,
                                title: 'Deleting Information',
                                message: '<p class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </p>'
                            });
                            dialog.init(function(){
                                setTimeout(function(){
                                    dialog.find('.bootbox-body').html('Information Successfully removed!');
                                    window.location.reload();
                                }, 1500);
                                
                            });
                            
                        });
                    }
                }
            })
        }
    </script>

    <script>
        function loadXMLDoc() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("main_table").innerHTML =
                    this.responseText;
                    $('#dataTable').DataTable();
                }
            };
            xhttp.open("GET", "./main-table", true);
            xhttp.send();
        }
        setInterval(function(){
            loadXMLDoc();
            // 1sec
        },1000);
        window.onload = loadXMLDoc;
    </script>
@endsection