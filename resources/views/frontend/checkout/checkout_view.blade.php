@extends('frontend.layout.layout')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="py-3" id="page-title">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-1">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap"><a href="#">Checkout</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-2 text-center text-lg-left">
                <h1 class="h3 mb-0 text-white"> Checkout </h1>
            </div>
        </div>
    </div>

    <div class="container pb-5 mb-2 mb-md-4 mt-5">
        <div class="row">

            <section class="col-lg-8">
                <form id="myForm" method="post" action="{{ route('cash.order') }}">
                    @csrf
                    <!-- Steps-->
                    <div class="steps steps-light pt-2 pb-3 mb-5">
                        <a class="step-item active" href="{{ route('mycart') }}">
                            <div class="step-progress"><span class="step-count">1</span></div>
                            <div class="step-label"><i class="czi-cart"></i>Cart</div>
                        </a>
                        <a class="step-item active current" href="{{ route('checkout') }}">
                            <div class="step-progress"><span class="step-count">2</span></div>
                            <div class="step-label"><i class="czi-user-circle"></i>Checkout</div>
                        </a>
                    </div>
                    <!-- Autor info-->
                    <div
                        class="d-sm-flex justify-content-between align-items-center bg-secondary p-4 rounded-lg mb-grid-gutter">
                        <div class="media align-items-center">
                            <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;">
                                <img class="rounded-circle"
                                    src="{{ !empty($user->photo) ? url('upload/admin_images/' . $user->photo) : url('upload/profile.jpg') }}"
                                    alt="Susan Gardner">
                            </div>
                            <div class="media-body pl-3">
                                <h3 class="font-size-base mb-0">{{ $user->name }}</h3><span
                                    class="text-accent font-size-sm">{{ $user->email }}</span>
                            </div>
                        </div>
                        <a class="btn btn-primary btn-sm btn-shadow mt-3 mt-sm-0" href="{{ route('mycart') }}">
                            <i class="czi-cart"></i>
                            <span class="d-none d-sm-inline">Back to Cart</span>
                        </a>
                    </div>
                    <!-- Shipping address-->

                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $err)
                                {{ $err }}
                            @endforeach
                        </div>
                    @endif

                    <h2 class="h6 pt-1 pb-3 mb-3 border-bottom text-white">Shipping address</h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-white" for="checkout-ln">Name</label>
                                <input class="form-control" type="text" id="checkout-ln" name="name"
                                    value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label class="text-white" for="checkout-email">E-mail</label>
                                <input class="form-control " type="email" id="checkout-email" name="email"
                                    value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="text-white" for="checkout-phone">Phone Number</label>
                                <input class="form-control" type="text" id="checkout-phone" name="phone"
                                    value="{{ $user->phone }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-white" for="checkout-address-1">Address 1</label>
                                <input class="form-control" type="text" id="checkout-address-1" name="address"
                                    value="{{ $user->address }}">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-white" for="checkout-address-1">Additional comments</label>
                                <textarea class="form-control" rows="6" id="order-comments" name="notes"></textarea>
                            </div>
                        </div>
                    </div>

            </section>

            <!-- Sidebar-->
            <aside class="col-lg-4 pt-4 pt-lg-0">
                <div class="cz-sidebar-static rounded-lg box-shadow-lg ml-lg-auto" style="background-color: #233a50;">
                    <div class="widget mb-3">
                        <h2 class="widget-title text-center">Order summary</h2>
                        <div class="row" id="cartPage2">
                        </div>
                    </div>
                    <div class="text-center mb-4 pb-3 border-bottom">
                        <h2 class="h6 mb-3 pb-1 text-white">Subtotal</h2>
                        <h3 class="font-weight-normal text-white" id="cartSubTotal"></h3>
                    </div>


                    <button type="submit" class="btn btn-primary btn-block">
                        <span class="d-none d-sm-inline">Complete order</span>
                        <span class="d-inline d-sm-none">Complete</span>
                        <i class="czi-arrow-right mt-sm-0 ml-1"></i>
                    </button>
                </div>

            </aside>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    notes: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please Enter Name',
                    },
                    email: {
                        required: 'Please Enter Email',
                    },
                    phone: {
                        required: 'Please Enter Phone',
                    },
                    address: {
                        required: 'Please Enter Address',
                    },
                    notes: {
                        required: 'Please Enter Yotes',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
