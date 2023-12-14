@extends('frontend.layout.layout')

@section('content')
    <div class="py-3" id="page-title">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-1">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap"><a href="#">Blogs</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-2 text-center text-lg-left">
                <h1 class="h3 mb-0 text-white"> Blogs </h1>
            </div>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-3 mt-4">
        <div class="row">
            <!-- Sidebar-->
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
                <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-3 mb-lg-3">
                    <h6 class="font-size-base text-light mb-0">Order No : {{ $order->invoice_no }}
                    </h6>
                    <a class="btn btn-primary btn-sm" href="{{ route('user.logout') }}">
                        <i class="czi-sign-out mr-2"></i>
                        Sign out</a>
                </div>
                <div class="row">
                    @foreach ($orderItem as $movie)
                        <!-- Movie-->
                        <div class="col-4 col-md-2 px-2 mb-4">
                            <div class="card product-card card-static" id="custom-card">
                                <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip"
                                    data-placement="left" title="Add to wishlist" id="{{ $movie->product->id }}"
                                    onclick="addToWishList(this.id)">
                                    <i class="czi-heart"></i>
                                </button>

                                <a class=" d-block overflow-hidden" href="{{ route('dc.detail', $movie->id) }}">
                                    <img src="{{ !empty($movie->product->photo) ? url('upload/product_images/' . $movie->product->photo) : url('upload/movie_image.jpg') }}"
                                        alt="Product">
                                </a>

                                <div class="d-flex justify-content-between font-size-sm mt-1 mb-2">
                                    <div class="star-rating">
                                        <i class="sr-star czi-star-filled active">
                                            {{ $movie->product->rating }}</i>
                                    </div>
                                    <a class="product-meta d-block font-size-xs mr-1" id="h-a">
                                        <div class="movie-title">
                                            Price-{{ $movie->product->selling_price }}Ks
                                        </div>
                                    </a>
                                </div>

                                <a href="{{ route('dc.detail', $movie->id) }}">
                                    <div class="movie-title font-size-sm" id="mname_{{ $movie->product->id }}">
                                        {{ $movie->product->title }}
                                    </div>
                                </a>

                                <div>
                                    <input type="hidden" class="movie_id" value="{{ $movie->product->id }}">
                                    <input type="hidden" class="qty" value="1">
                                    <button type="submit" class="btn btn-default btn-sm btn-block mt-1" id="h-btn"
                                        onclick="addToCart({{ $movie->product->id }})">Add to cart</button>
                                </div>


                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row ">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="text-center mb-4 pb-3">
                            <h2 class="h6 mb-3 pb-1 text-white">Total Amount</h2>
                            <h3 class="font-weight-normal text-white">{{ $order->amount }}Ks</h3>
                        </div>
                    </div>
                    <div class="col-2"> </div>
                </div>

            </section>
        </div>
    </div>
@endsection
