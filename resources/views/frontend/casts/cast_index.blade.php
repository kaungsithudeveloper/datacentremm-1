@extends('frontend.layout.layout')

@section('content')
    <div class="py-3" id="page-title">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-1">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap"><a href="#">Cast</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-2 text-center text-lg-left">
                <h1 class="h3 mb-0 text-white"> Cast </h1>
            </div>
        </div>
    </div>



    <div class="container  pb-5 mb-2 mb-md-4 mt-4">
        <div class="row">
            <!-- Content  -->
            <section class="col-lg-8">

                <!-- Products grid-->
                <div class="row">
                    @foreach ($casts as $key => $cast)
                        <div class="col-md-2 col-4 mb-1">
                            <div class="card" id="custom-card">
                                <a class="blog-entry-thumb gallery-item" href="{{ route('dc.casts.detail', $cast->id) }}">
                                    <img class="card-img-top"
                                        src="{{ !empty($cast->photo) ? url('upload/cast_images/' . $cast->photo) : url('upload/profile.jpg') }}"
                                        alt="Post">
                                </a>
                                <div class="card-body">
                                    <div class="movie-title" style="font-size: 12px">
                                        <a href="{{ route('dc.casts.detail', $cast->id) }}"id="h-a">{{ $cast->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <hr class="my-3">
                <!-- Pagination-->
                <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
                    <ul class="pagination">
                        @if ($casts->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="czi-arrow-left mr-2"></i>Prev</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $casts->previousPageUrl() }}"><i
                                        class="czi-arrow-left mr-2"></i>Prev</a>
                            </li>
                        @endif
                    </ul>

                    <ul class="pagination">
                        <li class="page-item d-sm-none">
                            <span class="page-link page-link-static">{{ $casts->currentPage() }} /
                                {{ $casts->lastPage() }}</span>
                        </li>
                        @foreach (range(1, $casts->lastPage()) as $page)
                            @if ($page == $casts->currentPage())
                                <li class="page-item active d-none d-sm-block" aria-current="page">
                                    <span class="page-link">{{ $page }}<span class="sr-only">(current)</span></span>
                                </li>
                            @else
                                <li class="page-item d-none d-sm-block">
                                    <a class="page-link" href="{{ $casts->url($page) }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>

                    <ul class="pagination">
                        @if ($casts->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $casts->nextPageUrl() }}" aria-label="Next">Next<i
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
