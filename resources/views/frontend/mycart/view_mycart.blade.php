@extends('frontend.layout.layout')

@section('content')
    <div class="py-3" id="page-title">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-1">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap"><a href="#">My Cart</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-2 text-center text-lg-left">
                <h1 class="h3 mb-0 text-white"> My Cart </h1>
            </div>
        </div>
    </div>

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 mt-4">
        <div class="row">
            <!-- List of items-->
            <section class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center pt-3 pb-2 pb-sm-5 mt-1">
                    <h2 class="h6 text-light mb-0">Items</h2><a class="btn btn-outline-primary btn-sm pl-2"
                        href="{{ route('/') }}"><i class="czi-arrow-left mr-2"></i>Continue shopping</a>
                </div>

                <div class="row" id="cartPage">

                </div>




                <div class="row ">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="text-center mb-4 pb-3 border-bottom">
                            <h2 class="h6 mb-3 pb-1 text-white">Subtotal</h2>
                            <h3 class="font-weight-normal text-white" id="cartSubTotal"></h3>
                        </div>

                        <a class="btn btn-primary btn-shadow btn-block mt-4" href="{{ route('checkout') }}">
                            <i class="czi-card font-size-lg mr-2"></i>
                            Proceed to Checkout
                        </a>
                    </div>
                    <div class="col-2"> </div>
                </div>



            </section>
        </div>
    </div>
@endsection
