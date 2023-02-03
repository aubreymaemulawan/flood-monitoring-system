@extends('layouts.main')
@section('title','About Us')

@section('index_pages')

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="text-white display-4 animated slideInDown mb-4">About Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto" style="max-width: 500px">
                <h1 class="display-6 mb-5">Meet Our Team Members</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item rounded">
                        <div class="text-center p-4">
                            <h5>Kathleen Fernandez</h5>
                            <span>Project Manager</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item rounded">
                        <div class="text-center p-4">
                            <h5>Charles Demetillo</h5>
                            <span>Developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item rounded">
                        <div class="text-center p-4">
                            <h5>Joycelyn Escobio</h5>
                            <span>Researcher</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="team-item rounded">
                    <div class="text-center p-4">
                        <h5>Rhoda Obias</h5>
                        <span>QA Tester</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->
@endsection

@section('index_scripts')
    <script>
        // Sidebar
        $('[id^="nav-"]').removeClass('active')
        $('#nav-about').addClass('active')      
    </script>
@endsection