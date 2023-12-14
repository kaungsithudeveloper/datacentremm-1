@extends('backend.layout.layout')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Taginput CSS -->
    <link href="{{ url('backend/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ url('backend/plugins/typeahead/typeaheadjs.min.css') }}" rel="stylesheet" />


    <!-- app-content open -->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Create Post</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Post</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row">
                    <div class="col-xl-8">
                        <form id="myForm" method="post" action="{{ route('posts.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $err)
                                                {{ $err }}
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="name" class="form-label">Post Title :<span
                                                class="text-red">*</span></label>
                                        <input type="text" class="form-control" placeholder="Name" name="title"
                                            autocomplete="name">
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="form-label">Post Description :</label>
                                        <textarea name="description" id="myTextarea" class="content"></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Posts Categories</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-4">
                                    <label for="Category" class="form-label">Add Categories:</label>
                                    <input type="text" name="post_category_id" class="form-control" id="category"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Posts Tags</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-4">
                                    <label for="Tag" class="form-label">Add Tags:</label>
                                    <input type="text" name="post_tag_id" class="form-control" data-role="tagsinput"
                                        id="tags" required>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Feature Photo</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-4">
                                    <label for="photo" class="form-label">Photo:</label>
                                    <input type="file" name="photo" class="form-control" id="photo" required>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage" src="{{ url('upload/blog_images.png') }}"
                                            style="width: 190px; height: 90px;">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Create Post</button>
                                <a href="{{ route('blogs') }}" class="btn btn-danger float-end">Discard</a>
                            </div>
                        </div>
                        </form>


                    </div>
                </div>
                <!-- ROW-1 END -->

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!-- app-content close -->

    <!-- Post categories -->
    <script>
        $(function() {
            var category = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: {
                    url: "/category-names",
                    cache: false,
                }
            });

            category.initialize();

            $('#category').tagsinput({
                typeaheadjs: {
                    name: 'category',
                    source: category.ttAdapter()
                },
                confirmKeys: [13, 44], // This allows pressing Enter or comma to add tags
            });
        });
    </script>

    <!-- Post Tags -->
    <script>
        $(function() {
            var tags = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: {
                    url: "/tag-names",
                    cache: false,
                }
            });

            tags.initialize();

            $('#tags').tagsinput({
                typeaheadjs: {
                    name: 'tags',
                    source: tags.ttAdapter()
                },
                confirmKeys: [13, 44], // This allows pressing Enter or comma to add tags
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#photo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    title: {
                        required: true,
                    },

                },
                messages: {
                    title: {
                        required: 'Please Enter Post Title',
                    },
                    meta_keywords: {
                        required: 'Please Enter Post Tags',
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

@endsection

@push('scripts')
    <!-- tagsinput -->
    <script src="{{ url('backend/plugins/input-tags/js/tagsinput.js') }}"></script>
    <script src="{{ url('backend/plugins/input-tags/js/bootstrap-tagsinput.min.js') }}"></script>

    <!-- typeahead -->
    <script src="{{ asset('backend/plugins/typeahead/typeahead.bundle.js') }}"></script>

    <!-- INPUT MASK JS -->
    <script src="{{ asset('backend/plugins/input-mask/jquery.mask.min.js') }}"></script>

    <!-- INTERNAL WYSIWYG Editor JS -->
    <script src="{{ asset('backend/plugins/wysiwyag/jquery.richtext.js') }}"></script>
    <script src="{{ asset('backend/plugins/wysiwyag/wysiwyag.js') }}"></script>
@endpush
