@extends('frontend.layout.layout')

@section('content')
    <div class="py-3" id="page-title">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-1">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap"><a href="#">Contact Us</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-2 text-center text-lg-left">
                <h1 class="h3 mb-0 text-white"> Contact Us </h1>
            </div>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-3 mt-4">
        <div class="row">
            <!-- Sidebar-->

            <!-- Content  -->
            <section class="container-fluid pt-grid-gutter">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-grid-gutter ">
                        <div class="card" href="#map" data-scroll>
                            <div class="card-body text-center" style="background-color: white; border-radius: 8px;">
                                <i class="czi-location h3 mt-2 mb-4 text-primary"></i>
                                <h3 class="h6 mb-2">Address</h3>
                                <p class="font-size-sm text-muted">No.49, Moe Sandar Street, Kamayut Township, Yangon</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-grid-gutter">
                        <div class="card" href="#map" data-scroll>
                            <div class="card-body text-center" style="background-color: white; border-radius: 8px;">
                                <i class="czi-location h3 mt-2 mb-4 text-primary"></i>
                                <h3 class="h6 mb-2">Open Time</h3>
                                <p class="font-size-sm text-muted">Daily:<br> 10:00AM to 6:00PM</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-grid-gutter">
                        <div class="card" href="#map" data-scroll>
                            <div class="card-body text-center" style="background-color: white; border-radius: 8px;">
                                <i class="czi-location h3 mt-2 mb-4 text-primary"></i>
                                <h3 class="h6 mb-2">Phone numbers</h3>
                                <p class="font-size-sm text-muted">(+95) :<br> 09 755 706 627</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-grid-gutter">
                        <div class="card" href="#map" data-scroll>
                            <div class="card-body text-center" style="background-color: white; border-radius: 8px;">
                                <i class="czi-location h3 mt-2 mb-4 text-primary"></i>
                                <h3 class="h6 mb-2">Email addresses</h3>
                                <p class="font-size-sm text-muted">Sent :<br>datacentreby8ray@gmail.com</p>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="container-fluid px-0" id="map">
                <div class="row no-gutters">
                    <div class="col-lg-12 iframe-full-height-wrap">
                        <iframe class="iframe-full-height" width="600" height="550"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1135.3760033002566!2d96.12833444878561!3d16.82960794907601!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c194c9ad607547%3A0x88ce8c9fad1b0ddb!2s8Ray!5e0!3m2!1sen!2smm!4v1700847326187!5m2!1sen!2smm"></iframe>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
