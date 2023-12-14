@extends('backend.layout.layout')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Create Cast</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Cast</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Create New Cast</h4>
                            </div>
                            <form id="myForm" method="post" action="{{ route('casts.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="">

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                @foreach ($errors->all() as $err)
                                                    {{ $err }}
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label for="name" class="form-label">Cast Name<span
                                                    class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Name" name="name"
                                                autocomplete="name">
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="gender" class="form-label">Gender</label>
                                                    <select name="gender" class="form-select mb-3"
                                                        aria-label="Default select example">
                                                        <option selected="">Open this select gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="birthday" class="form-label">Birthday</label>
                                                    <input type="text" class="form-control" placeholder="Name"
                                                        name="birthday" autocomplete="name">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Biography</label>
                                            <textarea class="form-control" rows="5" name="biography"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <input type="file" name="photo" class="form-control" id="image" />
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <img id="showImage"
                                                    src="{{ !empty($cast->photo) ? url('upload/cast_images/' . $cast->photo) : url('upload/profile.jpg') }}"
                                                    alt="Admin" style="width:100px; height: 150px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary mt-4 mb-0">Submit</button>
                                    <a href="{{ route('casts') }}" class="btn btn-danger mt-4 mb-0 text-end">Cancle</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ROW-1 END -->

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content close-->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
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
                    name: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                    birthday: {
                        required: true,
                    },
                    biography: {
                        required: true,
                    },
                    photo: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please Enter Name',
                    },
                    gender: {
                        required: 'Please Enter Gender',
                    },
                    birthday: {
                        required: 'Please Enter Birthday',
                    },
                    biography: {
                        required: 'Please Enter Biography',
                    },
                    photo: {
                        required: 'Please Enter Photo',
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
