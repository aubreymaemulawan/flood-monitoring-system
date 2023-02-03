<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')  |  FLSys</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="keywords" />
        <meta content="" name="description" />
        <meta http-equiv="content-type" content="text/plain; charset=UTF-8"/>

        <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" >

        <!-- Favicon -->
        <link href="{{ asset('assets/img/favicon-32x32.png') }}" rel="icon">
        <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Poppins:wght@600;700&display=swap" rel="stylesheet"/>

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet"/>

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
        <link href="{{ asset('index/lib/animate/animate.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('index/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('index/css/bootstrap.min.css') }}" rel="stylesheet" />

        <!-- Template Stylesheet -->
        <link href="{{ asset('index/css/style.css') }}" rel="stylesheet" />

    </head>

    <body>
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->
        @yield('index_modal')
        @include('topbar')
        @yield('index_pages')
        @include('endbar')


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
            <i class="bi bi-arrow-up"></i>
        </a>

        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('index/lib/wow/wow.min.js') }}"></script>
        <script src="{{ asset('index/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('index/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('index/lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>

        <script src="{{ asset('index/lib/counterup/counterup.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatables.js') }}"></script>
        <script src="{{ asset('assets/js/bootbox.min.js') }}"></script>
        <script src="{{ asset('assets/js/core.js') }}"></script>
        <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>


        <!-- Template Javascript -->
        <script src="{{ asset('index/js/main.js') }}"></script>

        <script>
            $('#device_id').val('');
            function not_available(){
                bootbox.alert({
                    message: "Feature still not available.",
                    centerVertical: true,
                    closeButton: false,
                    size: 'medium'
                }); 
            }
        </script>

        @yield('index_scripts') 
    </body>
</html>
