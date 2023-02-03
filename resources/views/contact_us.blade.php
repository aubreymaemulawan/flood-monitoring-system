@extends('layouts.main')
@section('title','Contact Us')

@section('index_pages')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="text-white display-4 animated slideInDown mb-4">Contact Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="display-6 mb-5"> If You Have Any Query, Please Contact Us</h1>
                    <p class="mb-4">
                        Need to get in touch with us? Either fill out the form with your inquiry or email us at 
                        <a href="">flsys.ph@gmail.com</a>  if you'd like to connect.
                    </p>
                    <div class="border-top mt-4 pt-4">
                        <div class="bg-light mt-2 rounded p-3 row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name" />
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email" />
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject" />
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 100px" ></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button onclick="not_available()" class="btn btn-primary py-3 px-5">Send Message</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 450px" >
                    <div class="position-relative rounded overflow-hidden h-100">
                        <iframe
                            class="position-relative w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d505243.6449301858!2d124.32590353294638!3d8.38040522928354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32fff2c3ca5ae8c7%3A0x880805868ab84491!2sUniversity%20of%20Science%20and%20Technology%20of%20Southern%20Philippines%20-%20CDO%20Campus!5e0!3m2!1sen!2sph!4v1669345581356!5m2!1sen!2sph"                        frameborder="0"
                            style="min-height: 450px; border: 0"
                            allowfullscreen=""
                            aria-hidden="false"
                            tabindex="0">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

@section('index_scripts')
    <script>
        // Sidebar
        $('[id^="nav-"]').removeClass('active')
        $('#nav-contact').addClass('active')        
    </script>
@endsection