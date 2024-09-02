@extends('backend.layout.layout')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">
                            Add New Post
                        </a>
                    </h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Posts</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->


                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mb-0">Posts</h3>
                            </div>
                            <div class="card-body pt-4">
                                <div class="grid-margin">
                                    <div class="">
                                        <div class="panel panel-primary">
                                            <div class="tab-menu-heading border-0 p-0">
                                                <div class="tabs-menu1">
                                                    <!-- Tabs -->
                                                    <ul class="nav panel-tabs product-sale">
                                                        <li><a href="#tab5" class="active" data-bs-toggle="tab">All
                                                                Posts</a></li>
                                                        <li><a href="#tab6" data-bs-toggle="tab" class="text-dark">Active
                                                                Posts</a></li>
                                                        <li><a href="#tab7" data-bs-toggle="tab"
                                                                class="text-dark">Inactive Post</a></li>
                                                    </ul>

                                                </div>
                                            </div>
                                            <div class="panel-body tabs-menu-body border-0 pt-0">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab5">
                                                        <div class="table-responsive">
                                                            <table id="responsive-datatable"
                                                                class="table table-bordered text-nowrap mb-0 table-striped">
                                                                <thead class="border-top">
                                                                    <tr>
                                                                        <th class="bg-transparent border-bottom-0 text-center"
                                                                            style="width: 3%;">ID
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0"
                                                                            style="width: 7%;">
                                                                            Photo</th>
                                                                        <th class="bg-transparent border-bottom-0"
                                                                            style="width: 20%;"> Blog Title
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0">
                                                                            Categories</th>
                                                                        <th class="bg-transparent border-bottom-0"> Tags
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0"> Autor
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0"> Date
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0 text-center "
                                                                            style="width: 10%;">
                                                                            Action</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    @foreach ($posts as $key => $post)
                                                                        <tr class="border-bottom">
                                                                            <td class="text-center">
                                                                                <div class="mt-0 mt-sm-2 d-block">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                                        {{ $key + 1 }} </h6>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <img
                                                                                            src="{{ !empty($post->photo) ? url('upload/blog_images/' . $post->photo) : url('upload/blog_images.png') }}">
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                                            {{ $post->title }}
                                                                                        </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        @foreach ($post->categories as $category)
                                                                                            <span class="tag tag-blue">
                                                                                                {{ $category->name }}
                                                                                            </span>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        @foreach ($post->tags as $tag)
                                                                                            <span class="tag tag-blue">
                                                                                                {{ $tag->name }}
                                                                                            </span>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-3 d-block">
                                                                                        {{ $post->user->name }}
                                                                                        <a href="{{ route('posts.detail', $post->id) }}"
                                                                                            class="btn text-primary"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="Comment">
                                                                                            <span
                                                                                                class="fe fe-message-square">
                                                                                                {{ $post->comments->count() }}
                                                                                            </span>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        {{ date('F j, Y, g:ia', strtotime($post['created_at'])) }}
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="g-2 text-center">
                                                                                    @if (Auth::user()->can('blog.edit'))
                                                                                        <a href="{{ route('posts.edit', $post->id) }}"
                                                                                            class="btn text-primary btn-sm"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="Edit">
                                                                                            <span
                                                                                                class="fe fe-edit fs-14"></span>
                                                                                        </a>
                                                                                    @endif

                                                                                    @if (Auth::user()->can('blog.edit'))
                                                                                        @if ($post->status == 1)
                                                                                            <a href="{{ route('post.inactive', $post->id) }}"
                                                                                                class="btn text-primary btn-sm"
                                                                                                data-bs-toggle="tooltip"
                                                                                                data-bs-original-title="Inactive">
                                                                                                <span
                                                                                                    class="fa fa-toggle-on fs-14"></span>
                                                                                            </a>
                                                                                        @else
                                                                                            <a href="{{ route('post.active', $post->id) }}"
                                                                                                class="btn text-primary btn-sm"
                                                                                                data-bs-toggle="tooltip"
                                                                                                data-bs-original-title="Active">
                                                                                                <span
                                                                                                    class="fa fa-toggle-off fs-14"></span>
                                                                                            </a>
                                                                                        @endif
                                                                                    @endif

                                                                                    @if (Auth::user()->can('blog.delete'))
                                                                                        <a href="{{ route('posts.delete', $post->id) }}"
                                                                                            class="btn text-danger btn-sm"
                                                                                            id="delete"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="Delete">
                                                                                            <span
                                                                                                class="fe fe-trash-2 fs-14"></span>
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab6">
                                                        <div class="table-responsive">
                                                            <table id="responsive-datatable"
                                                                class="table table-bordered text-nowrap mb-0 table-striped">
                                                                <thead class="border-top">
                                                                    <tr>
                                                                        <th class="bg-transparent border-bottom-0 text-center"
                                                                            style="width: 3%;">ID
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0"
                                                                            style="width: 7%;">
                                                                            Photo</th>
                                                                        <th class="bg-transparent border-bottom-0"
                                                                            style="width: 20%;"> Blog Title
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0">
                                                                            Categories</th>
                                                                        <th class="bg-transparent border-bottom-0"> Tags
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0"> Autor
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0"> Date
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0 text-center "
                                                                            style="width: 10%;">
                                                                            Action</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    @foreach ($activePost as $key => $post)
                                                                        <tr class="border-bottom">
                                                                            <td class="text-center">
                                                                                <div class="mt-0 mt-sm-2 d-block">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                                        {{ $key + 1 }} </h6>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <img
                                                                                            src="{{ !empty($post->photo) ? url('upload/blog_images/' . $post->photo) : url('upload/blog_images.png') }}">
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                                            {{ $post->title }}
                                                                                        </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        @foreach ($post->categories as $category)
                                                                                            <span class="tag tag-blue">
                                                                                                {{ $category->name }}
                                                                                            </span>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        @foreach ($post->tags as $tag)
                                                                                            <span class="tag tag-blue">
                                                                                                {{ $tag->name }}
                                                                                            </span>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        {{ $post->user->name }}
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        {{ date('F j, Y, g:ia', strtotime($post['created_at'])) }}
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="g-2 text-center">
                                                                                    @if (Auth::user()->can('blog.edit'))
                                                                                        <a href=""
                                                                                            class="btn text-primary btn-sm"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="Edit">
                                                                                            <span
                                                                                                class="fe fe-edit fs-14"></span>
                                                                                        </a>
                                                                                    @endif

                                                                                    @if (Auth::user()->can('blog.edit'))
                                                                                        @if ($post->status == 1)
                                                                                            <a href="{{ route('post.inactive', $post->id) }}"
                                                                                                class="btn text-primary btn-sm"
                                                                                                data-bs-toggle="tooltip"
                                                                                                data-bs-original-title="Inactive">
                                                                                                <span
                                                                                                    class="fa fa-toggle-on fs-14"></span>
                                                                                            </a>
                                                                                        @else
                                                                                            <a href="{{ route('post.active', $post->id) }}"
                                                                                                class="btn text-primary btn-sm"
                                                                                                data-bs-toggle="tooltip"
                                                                                                data-bs-original-title="Active">
                                                                                                <span
                                                                                                    class="fa fa-toggle-off fs-14"></span>
                                                                                            </a>
                                                                                        @endif
                                                                                    @endif

                                                                                    @if (Auth::user()->can('blog.delete'))
                                                                                        <a href="{{ route('posts.delete', $post->id) }}"
                                                                                            class="btn text-danger btn-sm"
                                                                                            id="delete"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="Delete">
                                                                                            <span
                                                                                                class="fe fe-trash-2 fs-14"></span>
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab7">
                                                        <div class="table-responsive">
                                                            <table id="responsive-datatable"
                                                                class="table table-bordered text-nowrap mb-0 table-striped">
                                                                <thead class="border-top">
                                                                    <tr>
                                                                        <th class="bg-transparent border-bottom-0 text-center"
                                                                            style="width: 3%;">ID
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0"
                                                                            style="width: 7%;">
                                                                            Photo</th>
                                                                        <th class="bg-transparent border-bottom-0"
                                                                            style="width: 20%;"> Blog Title
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0">
                                                                            Categories</th>
                                                                        <th class="bg-transparent border-bottom-0"> Tags
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0"> Autor
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0"> Date
                                                                        </th>
                                                                        <th class="bg-transparent border-bottom-0 text-center "
                                                                            style="width: 10%;">
                                                                            Action</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    @foreach ($inActivePost as $key => $post)
                                                                        <tr class="border-bottom">
                                                                            <td class="text-center">
                                                                                <div class="mt-0 mt-sm-2 d-block">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                                        {{ $key + 1 }} </h6>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <img
                                                                                            src="{{ !empty($post->photo) ? url('upload/blog_images/' . $post->photo) : url('upload/blog_images.png') }}">
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                                            {{ $post->title }}
                                                                                        </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        @foreach ($post->categories as $category)
                                                                                            <span class="tag tag-blue">
                                                                                                {{ $category->name }}
                                                                                            </span>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        @foreach ($post->tags as $tag)
                                                                                            <span class="tag tag-blue">
                                                                                                {{ $tag->name }}
                                                                                            </span>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        {{ $post->user->name }}
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                                        {{ date('F j, Y, g:ia', strtotime($post['created_at'])) }}
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="g-2 text-center">
                                                                                    @if (Auth::user()->can('blog.edit'))
                                                                                        <a href=""
                                                                                            class="btn text-primary btn-sm"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="Edit">
                                                                                            <span
                                                                                                class="fe fe-edit fs-14"></span>
                                                                                        </a>
                                                                                    @endif

                                                                                    @if (Auth::user()->can('blog.edit'))
                                                                                        @if ($post->status == 1)
                                                                                            <a href="{{ route('post.inactive', $post->id) }}"
                                                                                                class="btn text-primary btn-sm"
                                                                                                data-bs-toggle="tooltip"
                                                                                                data-bs-original-title="Inactive">
                                                                                                <span
                                                                                                    class="fa fa-toggle-on fs-14"></span>
                                                                                            </a>
                                                                                        @else
                                                                                            <a href="{{ route('post.active', $post->id) }}"
                                                                                                class="btn text-primary btn-sm"
                                                                                                data-bs-toggle="tooltip"
                                                                                                data-bs-original-title="Active">
                                                                                                <span
                                                                                                    class="fa fa-toggle-off fs-14"></span>
                                                                                            </a>
                                                                                        @endif
                                                                                    @endif

                                                                                    @if (Auth::user()->can('blog.delete'))
                                                                                        <a href="{{ route('posts.delete', $post->id) }}"
                                                                                            class="btn text-danger btn-sm"
                                                                                            id="delete"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="Delete">
                                                                                            <span
                                                                                                class="fe fe-trash-2 fs-14"></span>
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

@push('scripts')
    <!-- INTERNAL SELECT2 JS -->
    <script src="{{ asset('backend/plugins/select2/select2.full.min.js') }}"></script>

    <!-- INTERNAL Data tables js-->
    <script src="{{ asset('backend/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/dataTables.responsive.min.js') }}"></script>

    <script src="{{ asset('backend/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/js/table-data.js') }}"></script>
@endpush
