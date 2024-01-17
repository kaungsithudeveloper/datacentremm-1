@extends('frontend.layout.layout')

@section('content')
    <div class="container  mb-md-4">
        <section class="col-lg-12 mt-5 mb-5">
            <div>
                <!-- Slider  -->
                <div class="cz-carousel cz-controls-static cz-controls-outside mb-1">
                    <div class="cz-carousel-inner"
                        data-carousel-options=
                "{
                    &quot;items&quot;: 2,
                    &quot;controls&quot;: true,
                    &quot;nav&quot;: false,
                    &quot;autoHeight&quot;: true,
                    &quot;autoplay&quot;: true,
                    &quot;autoplayTimeout&quot;: 2000,
                    &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:3,&quot;gutter&quot;: 9},
                    &quot;500&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 9},
                    &quot;768&quot;:{&quot;items&quot;:5, &quot;gutter&quot;: 9},
                    &quot;1100&quot;:{&quot;items&quot;:9, &quot;gutter&quot;: 9}}
                }">

                        <!-- Movie-->
                        @foreach ($allitem as $movie)
                            <div>
                                <div class="card product-card card-static" id="custom-card">
                                    <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip"
                                        data-placement="left" title="Add to wishlist" id="{{ $movie->id }}"
                                        onclick="addToWishList(this.id)">
                                        <i class="czi-heart"></i>
                                    </button>
                                    <a class=" d-block overflow-hidden" href="{{ route('dc.detail', $movie->id) }}">
                                        <img src="{{ !empty($movie->photo) ? url('upload/product_images/' . $movie->photo) : url('upload/movie_image.jpg') }} "
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
                                        <div class="movie-title font-size-sm" id="mname_{{ $movie->id }}">
                                            {{ $movie->title }}
                                        </div>
                                    </a>
                                    <div>
                                        <input type="hidden" class="movie_id" value="{{ $movie->id }}">
                                        <input type="hidden" class="qty" value="1">
                                        <button type="submit" class="btn btn-default btn-sm btn-block mt-1" id="h-btn"
                                            onclick="addToCart({{ $movie->id }})">Add to cart</button>
                                    </div>


                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Content  -->
            </div>
        </section>
    </div>
    <div class="container  pb-5 mb-2 mb-md-4">
        <div class="row">

            <section class="col-lg-8 mb-5">
                <hr class="mb-3" id="hr">
                <!-- Update Movie -->
                <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-2 pb-3 pb-sm-2">
                    <div class="d-flex flex-wrap">
                        <div class="order-lg-1 pr-lg-2 text-center text-lg-left">
                            <h1 class="h5 mb-0 text-white">
                                <a class="" href="{{ route('dc.movies') }}" id="h-a">
                                    Update Movies<i class="czi-arrow-right ml-1 mr-n1"></i>
                                </a>
                            </h1>
                        </div>
                    </div>
                    <div class="d-none d-sm-flex">
                        <a class="btn btn-sm" id="h-btn" href="{{ route('dc.movies') }}" id="custom-btn-tag">
                            View all
                        </a>
                    </div>
                </div>
                <!-- Movie Slider  -->
                <div class="cz-carousel cz-controls-static cz-controls-outside mb-5">
                    <div class="cz-carousel-inner"
                        data-carousel-options=
                            "{
                                &quot;items&quot;: 2,
                                &quot;controls&quot;: true,
                                &quot;nav&quot;: false,
                                &quot;autoHeight&quot;: true,
                                &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:3,&quot;gutter&quot;: 9},
                                &quot;500&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 9},
                                &quot;768&quot;:{&quot;items&quot;:5, &quot;gutter&quot;: 9},
                                &quot;1100&quot;:{&quot;items&quot;:5, &quot;gutter&quot;: 9}}
                            }">

                        <!-- Movie -->
                        @foreach ($movies as $movie)
                            <div>
                                <div class="card product-card card-static" id="custom-card">
                                    <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip"
                                        data-placement="left" title="Add to wishlist" id="{{ $movie->id }}"
                                        onclick="addToWishList(this.id)">
                                        <i class="czi-heart"></i>
                                    </button>
                                    <a class=" d-block overflow-hidden" href="{{ route('dc.detail', $movie->id) }}">
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
                                        <div class="movie-title font-size-sm" id="mname_{{ $movie->id }}">
                                            {{ $movie->title }}
                                        </div>
                                    </a>
                                    <div>
                                        <input type="hidden" class="movie_id" value="{{ $movie->id }}">
                                        <input type="hidden" class="qty" value="1">
                                        <button type="submit" class="btn btn-default btn-sm btn-block mt-1" id="h-btn"
                                            onclick="addToCart({{ $movie->id }})">Add to cart</button>
                                    </div>


                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Content  -->

                <hr id="hr">

                <!-- Update Series -->
                <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-4 pb-3 pb-sm-2">
                    <div class="d-flex flex-wrap">
                        <div class="order-lg-1 pr-lg-2 text-center text-lg-left">
                            <h1 class="h5 mb-0">
                                <a class="" href="{{ route('dc.series') }}" id="h-a">
                                    Update Series<i class="czi-arrow-right ml-1 mr-n1"></i>
                                </a>
                            </h1>

                        </div>
                    </div>
                    <div class="d-none d-sm-flex">
                        <a class="btn btn-sm" id="h-btn" href="{{ route('dc.series') }}" id="custom-btn-tag">
                            View all
                        </a>
                    </div>
                </div>
                <!-- Series Slider  -->
                <div class="cz-carousel cz-controls-static cz-controls-outside mb-5">
                    <div class="cz-carousel-inner"
                        data-carousel-options=
                            "{
                                &quot;items&quot;: 2,
                                &quot;controls&quot;: true,
                                &quot;nav&quot;: false,
                                &quot;autoHeight&quot;: true,
                                &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:3,&quot;gutter&quot;: 9},
                                &quot;500&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 9},
                                &quot;768&quot;:{&quot;items&quot;:5, &quot;gutter&quot;: 9},
                                &quot;1100&quot;:{&quot;items&quot;:5, &quot;gutter&quot;: 9}}
                            }">

                        <!-- Series-->
                        @foreach ($series as $movie)
                            <div>
                                <div class="card product-card card-static" id="custom-card">
                                    <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip"
                                        data-placement="left" title="Add to wishlist" id="{{ $movie->id }}"
                                        onclick="addToWishList(this.id)">
                                        <i class="czi-heart"></i>
                                    </button>
                                    <a class=" d-block overflow-hidden" href="{{ route('dc.detail', $movie->id) }}">
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
                                        <div class="movie-title font-size-sm" id="mname_{{ $movie->id }}">
                                            {{ $movie->title }}
                                        </div>
                                    </a>
                                    <div>
                                        <input type="hidden" class="movie_id" value="{{ $movie->id }}">
                                        <input type="hidden" class="qty" value="1">
                                        <button type="submit" class="btn btn-default btn-sm btn-block mt-1"
                                            id="h-btn" onclick="addToCart({{ $movie->id }})">Add to cart</button>
                                    </div>


                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Content  -->

                <hr id="hr">

                <!-- Update PC Game -->
                <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-5 pb-3 pb-sm-2">
                    <div class="d-flex flex-wrap">
                        <div class="order-lg-1 pr-lg-2 text-center text-lg-left">
                            <h1 class="h5 mb-0 ml-2">
                                <a class="" href="shop-grid-ls.html" id="h-a">
                                    Update PC Game<i class="czi-arrow-right ml-1 mr-n1"></i>
                                </a>
                            </h1>
                        </div>
                    </div>
                    <div class="d-none d-sm-flex">
                        <a class="btn btn-sm" id="h-btn" href="{{ route('dc.games') }}" id="custom-btn-tag">
                            View all
                        </a>
                    </div>
                </div>
                <!-- PC Game Slider  -->
                <div class="cz-carousel cz-controls-static cz-controls-outside mb-5">
                    <div class="cz-carousel-inner"
                        data-carousel-options=
                            "{
                                &quot;items&quot;: 2,
                                &quot;controls&quot;: true,
                                &quot;nav&quot;: false,
                                &quot;autoHeight&quot;: true,
                                &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:3,&quot;gutter&quot;: 9},
                                &quot;500&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 9},
                                &quot;768&quot;:{&quot;items&quot;:5, &quot;gutter&quot;: 9},
                                &quot;1100&quot;:{&quot;items&quot;:5, &quot;gutter&quot;: 9}}
                            }">

                        <!-- PC Game-->
                        @foreach ($games as $movie)
                            <div>
                                <div class="card product-card card-static" id="custom-card">
                                    <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip"
                                        data-placement="left" title="Add to wishlist" id="{{ $movie->id }}"
                                        onclick="addToWishList(this.id)">
                                        <i class="czi-heart"></i>
                                    </button>
                                    <a class=" d-block overflow-hidden" href="{{ route('dc.detail', $movie->id) }}">
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
                                        <div class="movie-title font-size-sm" id="mname_{{ $movie->id }}">
                                            {{ $movie->title }}
                                        </div>
                                    </a>
                                    <div>
                                        <input type="hidden" class="movie_id" value="{{ $movie->id }}">
                                        <input type="hidden" class="qty" value="1">
                                        <button type="submit" class="btn btn-default btn-sm btn-block mt-1"
                                            id="h-btn" onclick="addToCart({{ $movie->id }})">Add to cart</button>
                                    </div>


                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr id="hr">
                <!-- Content  -->

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
