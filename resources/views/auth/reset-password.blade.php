<!doctype html>
<html lang="en">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('backend/images/brand/favicon.ico') }}" />

    <!-- TITLE -->
    <title>DataCentre | Register</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ url('backend/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ url('backend/css/style.css') }}" rel="stylesheet" />
    <link href="{{ url('backend/css/dark-style.css') }}" rel="stylesheet" />
    <link href="{{ url('backend/css/transparent-style.css') }}" rel="stylesheet">
    <link href="{{ url('backend/css/skin-modes.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ url('backend/css/icons.css') }}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all"
        href="{{ url('backend/colors/color1.css') }}" />

    <style>
        .login-img::before {
            background-color: rgba(57, 121, 223, 0.5) !important;
        }

        #btn {
            color: #ffffff;
            background-color: #fe696a;
            border: 0px
        }

        #h-a {
            color: #fff;
        }

        #h-a:hover {
            color: #fe696a;
        }
    </style>

</head>

<body class="app login-img">

    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <!-- PAGE -->
        <div class="page">
            <div class="">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <form class="login100-form validate-form" method="POST" action="{{ route('password.store') }}">
                            @csrf


                            <div class="text-center pb-4">
                                <a href="{{ route('/') }}"><img
                                        src="{{ url('frontend/img/logo/logo-2-dark.png') }}"
                                        class="header-brand-img m-0" alt=""></a>
                            </div>
                            <span class="login100-form-title">
                                Registration
                            </span>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="wrap-input100 validate-input input-group"
                                data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                </a>

                                <input name="email" class=" input100 border-start-0 ms-0 form-control" type="email"
                                    value="{{ old('email', $request->email) }}" readonly>
                            </div>

                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-eye" aria-hidden="true"></i>
                                </a>

                                <input type="password" name="password"
                                    class="input100 border-start-0 ms-0 form-control @error('password') is-invalid @enderror"
                                    id="password" placeholder="Password" />
                            </div>

                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-eye" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 ms-0 form-control" type="password"
                                    name="password_confirmation" required placeholder="Comfirmed password" />
                            </div>

                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn btn-red" id="btn">
                                    New Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- END PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <script src="{{ url('backend/js/jquery.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ url('backend/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ url('backend/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('backend/js/show-password.min.js') }}"></script>

    <!-- Color Theme js -->
    <script src="{{ url('backend/js/themeColors.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ url('backend/js/custom.js') }}"></script>


</body>

</html>
