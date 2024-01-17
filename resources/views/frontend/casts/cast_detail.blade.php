@extends('frontend.layout.layout')

@section('content')
    <div class="py-3" id="page-title">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-1">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap"><a href="#">{{ $casts->name }}</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-2 text-center text-lg-left">
                <h1 class="h3 mb-0 text-white"> {{ $casts->name }} </h1>
            </div>
        </div>
    </div>

    <div class="container  pb-5 mb-2 mb-md-4 mt-4">
        <div class="row">
            <section class="col-lg-8">
                <div class="row">
                    <aside class="col-lg-4 pt-4 pt-lg-0">
                        <div class="cz-sidebar-static rounded-lg box-shadow-lg px-0 pb-0 mb-5 mb-lg-0"
                            style="background-color: #233a50;">
                            <div class="px-4 mb-4">
                                <div class="media align-items-center">
                                    <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;">
                                        <img class="rounded-circle"
                                            src="{{ !empty($casts->photo) ? url('upload/cast_images/' . $casts->photo) : url('upload/profile.jpg') }}"
                                            alt="Susan Gardner">
                                    </div>
                                    <div class="media-body pl-3">
                                        <h3 class="font-size-base mb-0 text-white">{{ $casts->name }}</h3><span
                                            class="text-accent font-size-sm text-white">{{ $casts->gender }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-secondary px-4 py-3">
                                <h3 class="font-size-sm mb-0 text-dark">Cast Info</h3>
                            </div>
                            <ul class="list-unstyled mb-0">
                                <li class="border-bottom mb-0">
                                    <a class="nav-link-style d-flex align-items-center px-4 py-3"
                                        href="account-wishlist.html">
                                        <i class="czi-heart  mr-2 text-white"> Gender</i>
                                        <span class="font-size-sm ml-auto text-white">{{ $casts->gender }}</span>
                                    </a>
                                </li>
                                <li class="border-bottom mb-0">
                                    <a class="nav-link-style d-flex align-items-center px-4 py-3"
                                        href="account-wishlist.html">
                                        <i class="czi-heart  mr-2 text-white"> Birthday </i>
                                        <span class="font-size-sm  ml-auto text-white">{{ $casts->birthday }}</span>
                                    </a>
                                </li>
                                <li class="border-bottom mb-0">
                                    <a class="nav-link-style d-flex align-items-center px-4 py-3">
                                        <i class="czi-bag mr-2 text-white"> Movies </i>
                                        <span class="font-size-sm ml-auto"
                                            id="h-a">{{ $casts->movies->count() }}</span>
                                    </a>
                                </li>
                                <li class="border-bottom mb-0">
                                    <a class="nav-link-style d-flex align-items-center px-4 py-3">
                                        <i class="czi-heart  mr-2 text-white"> Series</i>
                                        <span class="font-size-sm  ml-auto text-white">{{ $casts->series->count() }}</span>
                                    </a>
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
                        <div class="">
                            <div class="">
                                <h6 class="blog-entry-title">
                                    <a href="#">{{ $casts->name }} Biography </a>
                                </h6>
                            </div>
                            <div class="">
                                <p>
                                    <span class="text-white">{!! html_entity_decode($casts->biography) !!}</span>
                                </p>

                                <div class="row pt-4">
                                    @foreach ($movies as $movie)
                                        @if ($movie->status == 1)
                                            <div class="col-md-3 col-4 mb-1">
                                                <div class="card product-card card-static" id="custom-card">
                                                    <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wishlist"
                                                        id="{{ $movie->id }}" onclick="addToWishList(this.id)">
                                                        <i class="czi-heart"></i>
                                                    </button>
                                                    <a class=" d-block overflow-hidden"
                                                        href="{{ route('dc.detail', $movie->id) }}">
                                                        <img src="{{ !empty($movie->photo) ? url('upload/product_images/' . $movie->photo) : url('upload/movie_image.jpg') }}"
                                                            alt="Product">
                                                    </a>

                                                    <div class="d-flex justify-content-between font-size-sm mt-1 mb-2">
                                                        <div class="star-rating">
                                                            <i class="sr-star czi-star-filled active">
                                                                {{ $movie->rating }}</i>
                                                        </div>
                                                        <a class="product-meta d-block font-size-xs mr-1" id="h-a">
                                                            <div class="movie-title">
                                                                Price-{{ $movie->selling_price }}Ks
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <a href="{{ route('dc.detail', $movie->id) }}">
                                                        <div class="movie-title font-size-sm"
                                                            id="mname_{{ $movie->id }}">
                                                            {{ $movie->title }}
                                                        </div>
                                                    </a>
                                                    <div>
                                                        <input type="hidden" class="movie_id"
                                                            value="{{ $movie->id }}">
                                                        <input type="hidden" class="qty" value="1">
                                                        <button type="submit"
                                                            class="btn btn-default btn-sm btn-block mt-1" id="h-btn"
                                                            onclick="addToCart({{ $movie->id }})">Add to cart</button>
                                                    </div>


                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                            </div>
                        </div>

                    </section>
                </div>
            </section>

            <aside class="col-lg-4">
                <!-- Sidebar-->
                <div class="cz-sidebar rounded-lg box-shadow-lg ml-lg-auto" id="shop-sidebar"
                    style="background-color: #233a50;">
                    <div class="cz-sidebar-header box-shadow-sm">
                        <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close"><span
                                class="d-inline-block font-size-xs font-weight-normal align-middle">Close
                                sidebar</span><span class="d-inline-block align-middle ml-2"
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="cz-sidebar-body" data-simplebar data-simplebar-auto-hide="true">
                        <!-- Movie Series Genre-->
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item"><a class="nav-link  active" href="#details" data-toggle="tab"
                                    role="tab">Movies</a></li>
                            <li class="nav-item"><a class="nav-link " href="#reviews" data-toggle="tab"
                                    role="tab">Series</a>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">
                            <!-- Movie details tab-->
                            <div class="tab-pane fade show active" id="details" role="tabpanel">
                                <div class="widget widget-categories mb-4 pb-4 border-bottom">
                                    <div class="accordion mt-n1" id="shop-categories">
                                        <!-- Movie-->
                                        <div class="card">
                                            <div class="collapse show" id="Movie" data-parent="#shop-categories">
                                                <div class="card-body">
                                                    <div class="widget widget-links cz-filter">
                                                        <div class="input-group-overlay input-group-sm mb-2">
                                                            <input
                                                                class="cz-filter-search form-control form-control-sm appended-form-control"
                                                                type="text" placeholder="Search">
                                                            <div class="input-group-append-overlay"><span
                                                                    class="input-group-text"><i
                                                                        class="czi-search"></i></span>
                                                            </div>
                                                        </div>
                                                        <ul class="widget-list cz-filter-list pt-1" style="height: 12rem;"
                                                            data-simplebar data-simplebar-auto-hide="false">
                                                            @foreach ($genres->sortBy('name') as $genre)
                                                                {{-- Movies --}}
                                                                @if ($genre->type == 'movie' && $genre->movies()->count() > 0)
                                                                    <li class="widget-list-item cz-filter-item">
                                                                        <a class="widget-list-link d-flex justify-content-between align-items-center"
                                                                            href="{{ route('dc.movies.genres', ['id' => $genre->id]) }}"
                                                                            id="h-a">
                                                                            <span
                                                                                class="cz-filter-item-text">{{ $genre->name }}
                                                                            </span>
                                                                            <span
                                                                                class="font-size-xs text-muted ml-3">{{ $genre->movies->count() }}</span>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Cast tab-->
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="widget widget-categories mb-4 pb-4 border-bottom">
                                    <div class="accordion mt-n1" id="shop-categories">
                                        <!-- series-->
                                        <div class="card">
                                            <div class="collapse show" id="Movie" data-parent="#shop-categories">
                                                <div class="card-body">
                                                    <div class="widget widget-links cz-filter">
                                                        <div class="input-group-overlay input-group-sm mb-2">
                                                            <input
                                                                class="cz-filter-search form-control form-control-sm appended-form-control"
                                                                type="text" placeholder="Search">
                                                            <div class="input-group-append-overlay"><span
                                                                    class="input-group-text"><i
                                                                        class="czi-search"></i></span>
                                                            </div>
                                                        </div>
                                                        <ul class="widget-list cz-filter-list pt-1" style="height: 12rem;"
                                                            data-simplebar data-simplebar-auto-hide="false">
                                                            @foreach ($genres->sortBy('name') as $genre)
                                                                {{-- Series --}}
                                                                @if ($genre->type == 'serie' && $genre->series()->count() > 0)
                                                                    <li class="widget-list-item cz-filter-item">
                                                                        <a class="widget-list-link d-flex justify-content-between align-items-center"
                                                                            href="{{ route('dc.series.genres', ['id' => $genre->id]) }}"
                                                                            id="h-a">
                                                                            <span
                                                                                class="cz-filter-item-text">{{ $genre->name }}</span>
                                                                            <span
                                                                                class="font-size-xs text-muted ml-3">{{ $genre->series->count() }}</span>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget mb-grid-gutter pb-grid-gutter border-bottom">
                            <h3 class="widget-title">Trending posts</h3>
                            @foreach ($posts as $blog)
                                <div class="media align-items-center mb-3">
                                    <a href="{{ route('dc.blogs.detail', $blog->id) }}">
                                        <img class="rounded"
                                            src="{{ !empty($blog->photo) ? url('upload/blog_images/' . $blog->photo) : url('upload/blog_images.png') }}"
                                            width="64" alt="Post image"></a>
                                    <div class="media-body pl-3">
                                        <h6 class="blog-entry-title font-size-sm mb-0">
                                            <a href="{{ route('dc.blogs.detail', $blog->id) }}">{{ $blog->title }}</a>
                                        </h6>
                                        <span class="font-size-ms text-muted">by
                                            <a href='{{ route('dc.user.blogs', ['id' => $blog->user->id]) }}'
                                                class='blog-entry-meta-link'>{{ $blog->user->name }}</a>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </div>
@endsection
