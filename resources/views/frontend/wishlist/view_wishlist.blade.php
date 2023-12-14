@extends('frontend.layout.layout')

@section('content')
    <div class="py-3" id="page-title">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-1">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap"><a href="#">Wishlist</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-2 text-center text-lg-left">
                <h1 class="h3 mb-0 text-white">Wishlist</h1>
            </div>
        </div>
    </div>

    <div class="container  pb-5 mb-2 mb-md-4 mt-4">
        <div class="row">

            <aside class="col-lg-4 pt-2 pt-lg-0">
                <div class="cz-sidebar-static rounded-lg box-shadow-lg px-0 pb-0 mb-5 mb-lg-0"
                    style="background-color: #233a50;">
                    <div class="px-4 mb-4">
                        <div class="media align-items-center">
                            <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;">
                                <img class="rounded-circle"
                                    src="{{ !empty($user->photo) ? url('upload/user_images/' . $user->photo) : url('upload/profile.jpg') }}"
                                    alt="User">
                            </div>
                            <div class="media-body pl-3">
                                <h3 class="font-size-base mb-0" id="h-a">{{ $user->name }}</h3>
                                <span class="text-accent font-size-sm">{{ $user->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-secondary px-4 py-3">
                        <h3 class="font-size-sm mb-0 text-muted">Account settings</h3>
                    </div>
                    <ul class="list-unstyled mb-0">
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3"
                                href="{{ route('user.account.page') }}" id="h-a">
                                <i class="czi-user opacity-60 mr-2"></i>
                                Profile info
                            </a>
                        </li>
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3"
                                href="{{ route('user.password.page') }}" id="h-a">
                                <i class="czi-locked opacity-60 mr-2"></i>
                                Password Update
                            </a>
                        </li>
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ route('user.orders') }}"
                                id="h-a">
                                <i class="czi-bag opacity-60 mr-2"></i>Orders
                                <span class="font-size-sm text-muted ml-auto">{{ $ordersCount }}</span>
                            </a>
                        </li>
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3 active"
                                href="{{ route('wishlist') }}" id="h-a">
                                <i class="czi-heart opacity-60 mr-2"></i>Wishlist
                                <span class="font-size-sm text-muted ml-auto">{{ $wishQty }}</span>
                            </a>
                        </li>

                        <li class="m-3">
                            <a class="btn btn-primary btn-shadow btn-block mt-4" href="{{ route('user.logout') }}">
                                <i class="czi-sign-out mr-2"></i>Sign
                                out</a>
                        </li>
                    </ul>

                    <div class="cz-sidebar  ml-lg-auto" id="blog-sidebar" style="background-color: #233a50;">
                        <br>
                        <div class="cz-sidebar-header box-shadow-sm">
                            <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close">
                                <span class="d-inline-block font-size-xs font-weight-normal align-middle">Close
                                    sidebar</span>
                                <span class="d-inline-block align-middle ml-2" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- Content  -->
            <section class="col-lg-8">
                <!-- Toolbar-->
                <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-4 mb-lg-3">
                    <h6 class="font-size-base text-light mb-0">List of items you added to wishlist:</h6><a
                        class="btn btn-primary btn-sm" href="account-signin.html"><i class="czi-sign-out mr-2"></i>Sign
                        out</a>
                </div>
                <!-- Wishlist-->
                <!-- Item-->
                <div id="wishlist">

                </div>

            </section>


        </div>
    </div>
@endsection
