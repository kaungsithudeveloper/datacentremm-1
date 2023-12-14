@extends('frontend.layout.layout')

@section('content')
    <div class="py-3" id="page-title">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-1">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap"><a href="#">Blog Detail </a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-2 text-center text-lg-left">
                <h1 class="h3 mb-0 text-white"> Blog Detail </h1>
            </div>
        </div>
    </div>


    <div class="container  pb-5 mb-2 mb-md-4 mt-3">
        <div class="row">

            <section class="col-lg-8 mt-2">
                <!-- Post meta-->
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4 mt-n1">
                    <div class="d-flex align-items-center font-size-sm mb-2">
                        <a class="blog-entry-meta-link" href="{{ route('dc.user.blogs', ['id' => $blog->user->id]) }}">
                            <div class="blog-entry-author-ava">
                                <img src="{{ !empty($blog->user->photo) ? url('upload/admin_images/' . $blog->user->photo) : url('upload/profile.jpg') }}"
                                    alt="Blog Post">
                            </div>{{ $blog->user->name }}
                        </a>
                        <span class="blog-entry-meta-divider"></span>
                        <a class="blog-entry-meta-link"
                            href="{{ route('dc.blogs.date', ['date' => date('Y-m-d', strtotime($blog->created_at))]) }}">
                            {{ date('F j', strtotime($blog['created_at'])) }}
                        </a>
                    </div>
                    <div class="font-size-sm mb-2">
                        <a class="blog-entry-meta-link text-nowrap" href="#comments" data-scroll>
                            <i class="czi-message"></i>{{ $blog->comments->count() }}
                        </a>
                    </div>
                </div>

                <!-- Gallery-->
                <div class="cz-gallery row pb-2">
                    <div class="col-sm-12">
                        <a class="gallery-item rounded-lg mb-grid-gutter"
                            href="{{ !empty($blog->photo) ? url('upload/blog_images/' . $blog->photo) : url('upload/blog_images.png') }}"
                            data-sub-html="&lt;h6 class=&quot;font-size-sm text-light&quot;&gt;Gallery image caption #1&lt;/h6&gt;">
                            <img src="{{ !empty($blog->photo) ? url('upload/blog_images/' . $blog->photo) : url('upload/blog_images.png') }}"
                                alt="Gallery image">
                            <span class="gallery-item-caption">
                                Gallery image caption #1
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Post content-->
                <h2 class="h5 blog-entry-title mb-2">
                    <a href="{{ route('dc.blogs.detail', $blog->id) }}">{{ $blog->title }}</a>
                </h2>
                <p>
                    <span class="text-white">{!! html_entity_decode($blog->description) !!}</span>
                </p>

                <!-- Post tags + sharing-->
                <div class="d-flex flex-wrap justify-content-between pt-2 pb-4 mb-1">
                    <div class="mt-3 mr-3">
                        @foreach ($blog->tags as $tag)
                            <a class="btn-tag mr-2 mb-2" id="btn-tag"
                                href="{{ route('dc.blogs.tags', ['id' => $tag->id]) }}">#{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>

                <!-- Comments-->

                <div class="pt-2 mt-5" id="comments">

                    <h2 class="h4 text-white">Comments
                        <span
                            class="badge badge-secondary font-size-sm text-body align-middle ml-2">{{ $blog->comments->count() }}
                        </span>
                    </h2>
                    <!-- comment-->
                    @foreach ($blog->comments as $comment)
                        <div class="media py-4  border-bottom">
                            @if ($comment->user)
                                <a href="#">
                                    <img class="rounded-circle" width="50"
                                        src="{{ !empty($comment->user->photo) ? url('upload/admin_images/' . $comment->user->photo) : url('upload/profile.jpg') }}"
                                        alt="Laura Willson" />
                                </a>
                            @else
                                <img class="rounded-circle" width="50"
                                    src="{{ !empty($comment->user->photo) ? url('upload/admin_images/' . $comment->user->photo) : url('upload/profile.jpg') }}"
                                    alt="Laura Willson" />
                            @endif
                            <div class="media-body pl-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="font-size-md mb-0 text-white">
                                        @if ($comment->user)
                                            {{ $comment->user->name }}
                                        @endif
                                    </h6>
                                </div>

                                <p class="font-size-md mb-1 text-white">
                                    {!! html_entity_decode($comment->content) !!}
                                </p>

                                <span class="font-size-ms text-muted">
                                    <i class="czi-time align-middle mr-2"></i>
                                    {{ date('F j', strtotime($comment['created_at'])) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                    <br>
                    @if (Auth::check())
                        <!-- Comment form for authenticated users -->
                        <div class="card border-0 pt-2 box-shadow my-2">
                            <div class="card-body">
                                <div class="media">
                                    <img class="rounded-circle" width="50"
                                        src="{{ !empty($adminData->photo) ? url('upload/admin_images/' . $adminData->photo) : url('upload/profile.jpg') }}"
                                        alt="Mary Alice" />
                                    <form action="{{ route('dc.post.comment') }}" method="POST"
                                        class="media-body needs-validation ml-3" novalidate>
                                        @csrf
                                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                        <div class="form-group">
                                            <textarea class="form-control text-white" rows="4" placeholder="Write comment..." required
                                                style="background-color: #0f2133;" name="content" id="comment-content"></textarea>
                                            <div class="invalid-feedback">Please write your comment.</div>
                                        </div>
                                        <button class="btn btn-primary btn-sm" type="submit">Post comment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Display a message and login button for non-authenticated users -->
                        <div class="alert alert-info">
                            You must be logged in to post a comment.
                        </div>
                        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                    @endif
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
