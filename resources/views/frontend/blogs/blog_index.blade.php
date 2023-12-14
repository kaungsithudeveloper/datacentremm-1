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

    <!-- Featured posts carousel-->
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="featured-posts-carousel cz-carousel pt-3">
            <div class="cz-carousel-inner"
                data-carousel-options="{&quot;items&quot;: 2, &quot;nav&quot;: false, &quot;autoHeight&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;750&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 20},&quot;991&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 30}}}">

                @foreach ($blogs as $key => $blog)
                    <article>
                        <a class="blog-entry-thumb mb-3" href="{{ route('dc.blogs.detail', $blog->id) }}">
                            <span class="blog-entry-meta-label font-size-sm"><i class="czi-time"></i>
                                {{ date('F j, Y, g:ia', strtotime($blog['created_at'])) }}</span>
                            <img src="{{ !empty($blog->photo) ? url('upload/blog_images/' . $blog->photo) : url('upload/blog_images.png') }}"
                                alt="Featured post">
                        </a>
                        <div class="d-flex justify-content-between mb-2 pt-1">
                            <h2 class="h5 blog-entry-title mb-0">
                                <a href="{{ route('dc.blogs.detail', $blog->id) }}">{{ $blog->title }}</a>
                            </h2>
                            <a class="blog-entry-meta-link font-size-sm text-nowrap ml-3 pt-1"
                                href="{{ route('dc.blogs.detail', $blog->id) }}">
                                <i class="czi-message"></i>{{ $blog->comments->count() }}
                            </a>
                        </div>
                        <div class="d-flex align-items-center font-size-sm">
                            <a class="blog-entry-meta-link" href="{{ route('dc.blogs.detail', $blog->id) }}">
                                <div class="blog-entry-author-ava">
                                    <img src="{{ !empty($blog->user->photo) ? url('upload/admin_images/' . $blog->user->photo) : url('upload/profile.jpg') }}"
                                        alt="blog_user_photo">
                                </div>{{ $blog->user->name }}
                            </a>
                            <span class="blog-entry-meta-divider"></span>
                            <div class="font-size-sm text-muted">in
                                @foreach ($blog->categories as $category)
                                    <a href='#' class='blog-entry-meta-link'> {{ $category->name }}</a>,
                                @endforeach
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container  pb-5 mb-2 mb-md-4">
        <div class="row">
            <!-- Content  -->
            <section class="col-lg-8">

                <!-- Products grid-->
                <div class="row">
                    @foreach ($posts as $blog)
                        <div class="col-md-4 col-sm-6 px-2 mb-4">
                            <div class="card" id="custom-card">
                                <a class="blog-entry-thumb gallery-item video-item"
                                    href="{{ route('dc.blogs.detail', $blog->id) }}">
                                    <img class="card-img-top"
                                        src="{{ !empty($blog->photo) ? url('upload/blog_images/' . $blog->photo) : url('upload/blog_images.png') }}"
                                        alt="Post">
                                </a>
                                <div class="card-header d-flex align-items-center font-size-xs">
                                    <a class="blog-entry-meta-link"
                                        href="{{ route('dc.user.blogs', ['id' => $blog->user->id]) }}">
                                        <div class="blog-entry-author-ava">
                                            <img src="{{ !empty($blog->user->photo) ? url('upload/admin_images/' . $blog->user->photo) : url('upload/profile.jpg') }}"
                                                alt="blog_user_photo">
                                        </div>{{ $blog->user->name }}
                                    </a>
                                    <div class="ml-auto text-nowrap">
                                        <a class="blog-entry-meta-link text-nowrap"
                                            href="{{ route('dc.blogs.date', ['date' => date('Y-m-d', strtotime($blog->created_at))]) }}">
                                            {{ date('F j', strtotime($blog['created_at'])) }}
                                        </a>
                                        <span class="blog-entry-meta-divider mx-2"></span>
                                        <a class="blog-entry-meta-link text-nowrap"
                                            href="{{ route('dc.blogs.detail', $blog->id) }}">
                                            <i class="czi-message"></i>{{ $blog->comments->count() }}
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h2 class="h5 blog-entry-title mb-0">
                                        <a href="{{ route('dc.blogs.detail', $blog->id) }}">{{ $blog->title }}</a>
                                    </h2>
                                    <p class="font-size-sm">
                                        @php
                                            $description = strip_tags($blog->description); // Remove HTML tags
                                            $description = str_replace('&nbsp;', ' ', $description); // Replace &nbsp; with a space
                                            $maxLength = 100; // Set the maximum length you want to display
                                        @endphp

                                        @if (strlen($description))
                                            {{ substr($description, 0, $maxLength) }}
                                        @else
                                            {{ $description }}
                                        @endif
                                    </p>

                                </div>
                                <div class="card-footer">
                                    <a class="btn-tag mr-2 mb-2" href="{{ route('dc.blogs.detail', $blog->id) }}"
                                        id="btn-tag">See More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <hr class="my-3">
                <!-- Pagination-->
                <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
                    <ul class="pagination">
                        @if ($posts->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="czi-arrow-left mr-2"></i>Prev</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $posts->previousPageUrl() }}"><i
                                        class="czi-arrow-left mr-2"></i>Prev</a>
                            </li>
                        @endif
                    </ul>

                    <ul class="pagination">
                        <li class="page-item d-sm-none">
                            <span class="page-link page-link-static">{{ $posts->currentPage() }} /
                                {{ $posts->lastPage() }}</span>
                        </li>
                        @foreach (range(1, $posts->lastPage()) as $page)
                            @if ($page == $posts->currentPage())
                                <li class="page-item active d-none d-sm-block" aria-current="page">
                                    <span class="page-link">{{ $page }}<span
                                            class="sr-only">(current)</span></span>
                                </li>
                            @else
                                <li class="page-item d-none d-sm-block">
                                    <a class="page-link" href="{{ $posts->url($page) }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>

                    <ul class="pagination">
                        @if ($posts->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $posts->nextPageUrl() }}" aria-label="Next">Next<i
                                        class="czi-arrow-right ml-2"></i></a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next<i class="czi-arrow-right ml-2"></i></span>
                            </li>
                        @endif
                    </ul>
                </nav>
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
