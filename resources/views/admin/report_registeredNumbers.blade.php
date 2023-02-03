@extends('layouts.app')
@section('title','Generate Report')

@section('admin_content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Export Data</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./admin">Home</a></li>
                    <li class="breadcrumb-item">Management</li>
                    <li class="breadcrumb-item">Generate Report</li>
                    <li class="breadcrumb-item active">Registered Numbers</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header card-head-pad">
                    <h5 class="card-title">Registered Numbers Report</h5>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert" style="padding-top:11px; padding-bottom:11px"> 
                        <i class="bi bi-info-circle me-1"></i> 
                        Generate PDF Reports here for registered numbers.
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label for="generate_from" class="expo">Created From</label>
                                <input name="generate_from" type="date" class="form-control" id="generate_from">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label for="generate_to" class="expo">Created To</label>
                                <input name="generate_to" type="date" class="form-control" id="generate_to">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label for="device_type" class="expo">Device</label>
                                <select name="device_type" class="form-select" data-style="btn btn-link" id="device_type">
                                    <option hidden selected></option>
                                    <option value="0">All Device</option>
                                    @foreach ($device as $dc)
                                        @if($dc->status == 1)
                                        <option value="{{ $dc->id }}">{{ $dc->device_name }} - Active</option>
                                        @else if($dc->status == 2)
                                        <option value="{{ $dc->id }}">{{ $dc->device_name }} - Not Active</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="padding-top: 32px;">
                                <button id="generate" type="button" class="form-control btn btn-primary rounded-pill">
                                    Generate Data
                                </button>
                            </div>
                        </div>
                        <div>
                            <div id="gen-button" class="mt-3 mb-0 form-group">
                            </div>
                        </div>
                    </div> 
                    <br>
                </div>
            </div>
            <div class="card" id="output" style="display:none">
                <div class="card-body table-responsive" style="background-color:white">
                    <table id="dataTable" class="table">
                        <div class="card-header" id="crd">
                            <br class="mb-4">
                            <img src="{{ asset('assets/img/logo1.png') }}" width="80" height="80" class="center shadow-4 mb-3">
                            <h1 style="text-align:center" class="h4 mb-2 text-gray-800"> <strong>FLSys Water Level Data Report</strong> </h1>
                            <p id="crd_a" style="text-align:center" class="mb-3">Date: </p>
                            <hr class="mb-4">
                            <p class="mb-1">Total Data : <strong id="crd_b"></strong></p>
                            <p class="mb-1">Date to be Export : <strong id="crd_c"></strong></p>
                            <p class="mb-1">Device Name : <strong id="crd_d"></strong></p>
                            <p class="mb-2">Color Level : <strong id="crd_e">GREEN, ORANGE, RED</strong></p>
                        </div>
                        <thead id="th" class="table-light" style="border-bottom: 2px solid #e3e6f0;">
                            <tr id="tr">
                                <th scope="col">List No.</th>
                                <th scope="col">Device Name</th>
                                <th scope="col">Device Location</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        // Sidebar
        $('#main-admin-generateReport').removeClass('collapsed')
        $('#mid-genrep').removeClass('collapse')
        $('#menu-generateReport-registeredNumbers').addClass('active')

        // Clear Input Fields
        $('#generate_from').val('')
        $('#generate_to').val('')
        $('#device_type').val('')

        // Date for filename
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        today = mm + '/' + dd + '/' + yyyy;
        
        // Data Table
        $('#dataTable').DataTable({
            searching: false, 
            paging: false, 
            info: true,
            order: [[0, 'desc']],
            "bPaginate": false,
        })

        // Generate PDF
        function GeneratePDF(){
            // Document Resizing
            var HTML_Width = $("#output").width();
            var HTML_Height = $("#output").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;
            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
            // HTML2Canvas
            html2canvas($("#output")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("FLSys-GenerateReport-"+today+".pdf");
                // Success Message
                bootbox.alert({
                    message: "Data Report has been successfully downloaded!",
                    centerVertical: true,
                    closeButton: false,
                    size: 'medium'
                }); 
            });
        }

        // Generate IMG
        function GenerateIMG(){
            html2canvas(document.querySelector("#output")).then(canvas => {
                a = document.createElement('a'); 
                document.body.appendChild(a); 
                a.download = "FLSys-GenerateReport-"+today+".png";
                a.href =  canvas.toDataURL();
                a.click();
                bootbox.alert({
                    message: "Data Report has been successfully downloaded!",
                    centerVertical: true,
                    closeButton: false,
                    size: 'medium'
                }); 
            });
        }

        // Unique Data
        function onlyUnique(value, index, self) {
            return self.indexOf(value) === index;
        }

        // Generate Data Report
        $(document).ready( 
            function () {  
                $('#generate').on('click', function () {
                    $('#output').hide();
                    $('#gen-button').html('');
                    $('#areaChart').html('');
                    var tble = $('#dataTable').DataTable();
                    tble.clear();
                    var height = new Array();
                    var dates = new Array();
                    var generateFrom = $('#generate_from').val()+' 00:00:00';
                    var generateTo = $('#generate_to').val()+' 23:59:59';
                    var deviceId = $('#device_type').val();
                    $.ajax({
                    url: '{{ route('generateRegisteredNumbers') }}?from='+generateFrom+'&to='+generateTo+'&device='+deviceId,
                    type: 'get',
                    success: function (data) {
                        if(data == 0){
                            $('#output').hide();
                            bootbox.alert({
                                message: "No Data Found!",
                                centerVertical: true,
                                closeButton: false,
                                size: 'medium'
                            }); 
                        }else{
                            $('#output').show();
                            $('#gen-button').append('<a onclick="GeneratePDF()" type="button" class="btn btn-outline-danger mb-2 rounded-pill"><i class="bi bi-file-earmark-pdf me-1"></i>PDF</a>   <button onclick="GenerateIMG()" type="button" class="btn btn-outline-secondary mb-2 rounded-pill"><i class="bi bi-file-earmark-image me-1"></i>IMG</button>   ');
                            // Title & About
                            var dp = moment().format('LLLL');
                            $('#crd_a').html('Date : '+dp);
                            $('#crd_b').html(data.length);
                            $('#crd_c').html($('#generate_from').val()+' - '+$('#generate_to').val());
                            var arr = [];
                            $.each(data, function (k1, val1) {
                                arr[k1] = val1.device.device_name;
                            })
                            var unique = arr.filter(onlyUnique);
                            $('#crd_d').html(unique.join(', ').toUpperCase());
                            // Table
                            var cnt = 1;
                            $.each(data, function (key, value) {
                                var index = key+1;
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
                                    var colorLev = "Extreme";
                                }else if(value.color == 'green'){
                                    var spanClass = 'badge rounded-pill bg-success';
                                    var spanStyle = "";
                                    var colorLev = "Above Normal";
                                }else if(value.color == 'orange'){
                                    var spanClass = 'badge rounded-pill';
                                    var spanStyle = "background-color:orange;color:white";
                                    var colorLev = "Severe";
                                }
                                // Add Row to Datatable
                                var table = $('#dataTable').DataTable();
                                table.row.add($("<tr><td>"+cnt++
                                +"</td><td>"+value.device.device_name
                                +"</td><td>"+value.device.location
                                +"</td><td>+63"+value.contact_number
                                +"</td><td>"+dd
                                +"</td></tr>")).draw(false);
                                
                            })
                        }
                    }
                }); 
            });
        })
    </script>
@endsection


