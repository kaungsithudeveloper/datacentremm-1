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
                    <h1 class="page-title">Create Game</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Game</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row">
                    <div class="col-xl-12">
                        <form id="myForm" method="post" action="{{ route('games.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $err)
                                        {{ $err }}
                                    @endforeach
                                </div>
                            @endif

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Game Code :<span
                                                        class="text-red">*</span></label>
                                                <input type="text" class="form-control" placeholder="Name" name="code"
                                                    autocomplete="name">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Game Title :<span
                                                        class="text-red">*</span></label>
                                                <input type="text" class="form-control" placeholder="Name" name="title"
                                                    autocomplete="name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="description" class="form-label">Game Description :</label>
                                        <textarea name="description" id="myTextarea" class="content"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="short_descp" class="form-label">Short Description :</label>
                                        <textarea class="form-control mb-4" rows="4" name="short_descp"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Release_date :</label>
                                                <input type="text" class="form-control" placeholder="Name"
                                                    name="release_date" autocomplete="name">
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="form-label">Trailer :</label>
                                                <input type="text" class="form-control" placeholder="Name" name="trailer"
                                                    autocomplete="name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Selling Price :</label>
                                                <input type="text" class="form-control" placeholder="Name"
                                                    name="selling_price" autocomplete="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="form-label">Discount Price :</label>
                                                <input type="text" class="form-control" placeholder="Name"
                                                    name="discount_price" autocomplete="name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="genre_id" class="form-label">Genres:</label>
                                                <input type="text" name="genre_id" class="form-control"
                                                    data-role="tagsinput" id="genres" required>
                                            </div>
                                        </div>


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
                                        <input type="file" name="photo" class="form-control" id="photo"
                                            required>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{ url('upload/blog_images.png') }}"
                                                style="width: 100px; height: 150px;">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Create Game</button>
                                    <a href="{{ route('games') }}" class="btn btn-danger float-end">Discard</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!-- app-content close -->

    <!-- Movie Tags -->
    <script>
        $(function() {
            var genres = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: {
                    url: "/games-genre",
                    cache: false,
                }
            });

            genres.initialize();

            $('#genres').tagsinput({
                typeaheadjs: {
                    name: 'genres',
                    source: genres.ttAdapter()
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

                    release_date: {
                        required: true,
                    },

                    trailer: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    discount_price: {
                        required: true,
                    },


                },
                messages: {
                    title: {
                        required: 'Please Enter Movie Title',
                    },
                    release_date: {
                        required: 'Please Enter Release Date',
                    },

                    trailer: {
                        required: 'Please Enter Trailer',
                    },
                    selling_price: {
                        required: 'Please Enter Selling Price',
                    },
                    discount_price: {
                        required: 'Please Enter Discount Price',
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

    <!-- typeahead -->
    <script src="{{ asset('backend/plugins/typeahead/typeahead.bundle.js') }}"></script>

    <!-- INPUT MASK JS -->
    <script src="{{ asset('backend/plugins/input-mask/jquery.mask.min.js') }}"></script>

    <!-- INTERNAL WYSIWYG Editor JS -->
    <script src="{{ asset('backend/plugins/wysiwyag/jquery.richtext.js') }}"></script>
    <script src="{{ asset('backend/plugins/wysiwyag/wysiwyag.js') }}"></script>
@endpush
