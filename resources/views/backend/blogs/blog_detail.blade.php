@extends('backend.layout.layout')

@section('content')
    <style>
        .card-body {
            max-height: 200px;
            /* Set an initial maximum height for the card body */
            overflow: hidden;
        }

        .post-description {
            max-height: 100%;
            /* Allow the description to expand */
            overflow: hidden;
            transition: max-height 0.3s ease;
            /* Add a smooth transition effect */
        }
    </style>
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Blog Details</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <img class="card-img-top "
                                src="{{ !empty($blog->photo) ? url('upload/blog_images/' . $blog->photo) : url('upload/blog_images.png') }}"
                                alt="blog images">
                            <br>
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <a href="javascript:void(0);" class="d-flex me-4 mb-2"><i
                                            class="fe fe-calendar fs-16 me-1 p-3 bg-secondary-transparent text-secondary bradius"></i>
                                        <div class="mt-0 mt-3 ms-1 text-muted font-weight-semibold">
                                            {{ date('F j, Y, g:ia', strtotime($blog['created_at'])) }}</div>
                                    </a>
                                    <a href="profile.html" class="d-flex mb-2"><i
                                            class="fe fe-user fs-16 me-1 p-3 bg-primary-transparent text-primary bradius"></i>
                                        <div class="mt-0 mt-3 ms-1 text-muted font-weight-semibold">{{ $blog->user->name }}
                                        </div>
                                    </a>
                                    <div class="ms-auto">
                                        <a href="javascript:void(0);" class="d-flex mb-2"><i
                                                class="fe fe-message-square fs-16 me-1 p-3 bg-success-transparent text-success bradius"></i>
                                            <div class="mt-0 mt-3 ms-1 text-muted font-weight-semibold">
                                                {{ $blog->comments->count() }}</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="font-13 text-muted">{{ $blog->description }}</p>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Comments</div>
                            </div>
                            @foreach ($blog->comments as $comment)
                                <div class="card-body pb-0">
                                    <div class="media mb-5 overflow-visible d-block d-sm-flex">
                                        <div class="me-3 mb-2">
                                            @if ($comment->user)
                                                <a href="#">
                                                    <img class="media-object rounded-circle thumb-sm" alt="64x64"
                                                        src="{{ !empty($comment->user->photo) ? url('upload/admin_images/' . $comment->user->photo) : url('upload/profile.jpg') }}">
                                                </a>
                                            @else
                                                <img class="media-object rounded-circle thumb-sm" alt="64x64"
                                                    src="{{ !empty($comment->user->photo) ? url('upload/admin_images/' . $comment->user->photo) : url('upload/profile.jpg') }}">
                                            @endif
                                        </div>
                                        <div class="media-body overflow-visible">
                                            <div class="border mb-5 p-4 br-5">
                                                <h5 class="mt-0">
                                                    @if ($comment->user)
                                                        {{ $comment->user->name }}
                                                    @endif
                                                </h5>
                                                <span><i class="fe fe-thumb-up text-danger"></i></span>
                                                <p class="font-13 text-muted">{{ $comment->content }}</p>
                                                <a class="like" href="javascript:;">
                                                    <span class="badge btn-danger-light rounded-pill py-2 px-3">
                                                        <i class="fe fe-heart me-1"></i>56</span>
                                                </a>
                                                <span class="reply" id="1">
                                                    <a href="javascript:;"><span
                                                            class="badge btn-primary-light rounded-pill py-2 px-3"><i
                                                                class="fe fe-corner-up-left mx-1"></i>Reply</span></a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Recent Posts</div>
                            </div>
                            @foreach ($posts as $post)
                                <div class="card-body" id="card-body">
                                    <div class="">
                                        <div class="d-flex overflow-visible">
                                            <a href="blog-details.html" class="card-aside-column br-5 cover-image"
                                                data-bs-image-src="" style="center top;">
                                                <img src="{{ !empty($post->photo) ? url('upload/blog_images/' . $post->photo) : url('upload/blog_images.png') }}"
                                                    alt="Image Alt Text" width="150" height="80">
                                            </a>
                                            <div class="ps-3 flex-column">
                                                <h4><a href="blog-details.html">{{ $post->title }}</a></h4>

                                                @php
                                                    $description = strip_tags($post->description); // Remove HTML tags
                                                    $description = str_replace('&nbsp;', ' ', $description); // Replace &nbsp; with a space
                                                    $maxLength = 60; // Set the maximum length you want to display
                                                @endphp

                                                <p class="post-description" data-description="{{ $description }}">
                                                    {{ substr($description, 0, $maxLength) }}...
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
    <!-- CONTAINER END -->
    </div>
    </div>
    <!--app-content close-->
@endsection
