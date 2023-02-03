<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="description" content="" />
        <meta http-equiv="content-type" content="text/plain; charset=UTF-8"/>


        <!-- Page Title -->
        <title>@yield('title')  |  FLSys</title>
        <meta name="robots" content="noindex, nofollow">
        <meta content="" name="description">
        <meta content="" name="keywords">

        <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" >

        <!-- Icon -->
        <link href="{{ asset('assets/img/favicon-32x32.png') }}" rel="icon">
        <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        
        <!-- Vendors CSS -->
        <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/remixicon.css') }}" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet">


        
        
        

        <!-- Main CSS -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    </head>

   <body>
    @guest
        <!-- Login Route -->
        @if (Route::has('login'))
            @yield('login_content')
        @endif
        @else
            <!-- Admin User -->
            @if( Auth::user()->user_type == 1)
                @yield('modal')
                @include('admin.navbar')
                @include('admin.sidebar')
                @yield('admin_content')
                @include('admin.footer')
            @endif
    @endguest
      
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>  
        <script src="{{ asset('assets/js/jquery.js') }}"></script> 
        <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.table2excel.js') }}"></script>

        <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/chart.min.js') }}"></script>
        <script src="{{ asset('assets/js/echarts.min.js') }}"></script>
        <script src="{{ asset('assets/js/quill.min.js') }}"></script>        
        <script src="{{ asset('assets/js/tinymce.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootbox.min.js') }}"></script>
        <script src="{{ asset('assets/js/validate.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script> 
        <script src="{{ asset('assets/js/core.js') }}"></script>
        <script src="{{ asset('assets/js/datatables.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>

        

        

        

        @yield('scripts')    
   </body>
</html>