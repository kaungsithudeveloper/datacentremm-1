<aside class="col-lg-4">
    <!-- Sidebar-->
    <div class="cz-sidebar rounded-lg box-shadow-lg ml-lg-auto" id="shop-sidebar" style="background-color: #233a50;">
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
                <li class="nav-item"><a class="nav-link " href="#reviews" data-toggle="tab" role="tab">Series</a>
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
                                                        class="input-group-text"><i class="czi-search"></i></span>
                                                </div>
                                            </div>
                                            <ul class="widget-list cz-filter-list pt-1" style="height: 16rem;"
                                                data-simplebar data-simplebar-auto-hide="false">
                                                @foreach ($genres->sortBy('name') as $genre)
                                                    @php
                                                        $genreMovies = $genre->movies->where('status', 1);
                                                        $isSeriesGenre = false;

                                                        // Check if the genre is associated with series (modify this condition as per your data structure)
                                                        if (strpos(strtolower($genre->name), 'series') !== false) {
                                                            $isSeriesGenre = true;
                                                        }
                                                    @endphp

                                                    @if ($genreMovies->isNotEmpty() && !$isSeriesGenre)
                                                        <li class="widget-list-item cz-filter-item">
                                                            <a class="widget-list-link d-flex justify-content-between align-items-center"
                                                                href="{{ route('dc.movies.genres', ['id' => $genre->id]) }}"
                                                                id="h-span">
                                                                <span class="cz-filter-item-text">
                                                                    {{ $genre->name }} Movies
                                                                </span>
                                                                <span
                                                                    class="font-size-xs text-muted ml-3">{{ $genreMovies->count() }}</span>
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
                                                        class="input-group-text"><i class="czi-search"></i></span>
                                                </div>
                                            </div>
                                            <ul class="widget-list cz-filter-list pt-1" style="height: 16rem;"
                                                data-simplebar data-simplebar-auto-hide="false">
                                                @foreach ($genres->sortBy('name') as $genre)
                                                    @php
                                                        $genreMovies = $genre->movies->where('status', 1);
                                                        $isSeriesGenre = false;

                                                        // Check if the genre is associated with series (modify this condition as per your data structure)
                                                        if (strpos(strtolower($genre->name), 'series') !== false) {
                                                            $isSeriesGenre = true;
                                                        }
                                                    @endphp

                                                    @if ($genreMovies->isNotEmpty() && $isSeriesGenre)
                                                        <li class="widget-list-item cz-filter-item">
                                                            <a class="widget-list-link d-flex justify-content-between align-items-center"
                                                                href="{{ route('dc.movies.genres', ['id' => $genre->id]) }}"
                                                                id="h-span">
                                                                <span class="cz-filter-item-text">
                                                                    {{ $genre->name }}
                                                                </span>
                                                                <span
                                                                    class="font-size-xs text-muted ml-3">{{ $genreMovies->count() }}</span>
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
