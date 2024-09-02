<header class="box-shadow-sm" style="background-color: #233a50;">
    <!-- Topbar-->
    <div class="topbar topbar-dark">
        <div class="container">
            <div class="topbar-text text-nowrap d-none d-md-inline-block">
                <i class="czi-support"></i>
                <span class="text-muted mr-1">Call Us</span>
                <a class="topbar-link" href="tel:09 755706627">
                    (+95) 09 755706627
                </a>
            </div>

            <div class="ml-3 text-nowrap">
                <span class="text-muted mr-1">Open Time:</span>
                <a class="topbar-link">
                    10:00AM to 06:00PM
                </a>
            </div>
        </div>
    </div>

    <div class="navbar-sticky" style="background-color: #0f2133;">
        <!-- Web Nav View -->
        <form action="{{ route('product.search') }}" method="post">
            @csrf
            <div class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand d-none d-sm-block mr-3 flex-shrink-0" href="{{ route('/') }}"
                        style="min-width: 7rem;">
                        <img width="142" src="{{ url('frontend/img/logo/logo-2-light.png') }}" alt="DataCentre" />
                    </a>
                    <a class="navbar-brand d-sm-none mr-2" href="{{ route('/') }}">
                        <img width="132" src="{{ url('frontend/img/logo/logo-2-light.png') }}" alt="DataCentre" />
                    </a>
                    <div class="input-group-overlay d-none d-lg-flex mx-4">

                        <input class="form-control appended-form-control" name="search" placeholder="Search......"
                            id="search" onfocus="search_result_show()" onblur="search_result_hide()"
                            style="background-color: #233a50;border-color: #3a5d7d; color: #fff;">
                        <div id="searchProducts"></div>
                        <div class="input-group-append-overlay">

                            <span class="input-group-text">
                                <i class="czi-search"></i>
                            </span>

                        </div>


                    </div>
                    <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">

                        <a class="navbar-tool navbar-stuck-toggler" href="#">
                            <span class="navbar-tool-tooltip">Expand menu</span>
                            <div class="navbar-tool-icon-box">
                                <i class="navbar-tool-icon czi-menu"></i>
                            </div>
                        </a>
                        <a class="navbar-tool d-none d-lg-flex" href="{{ route('wishlist') }}">
                            <span class="navbar-tool-tooltip">Wishlist</span>
                            <div class="navbar-tool-icon-box">
                                <span class="navbar-tool-label" id="wishQty">0</span>
                                <i class="navbar-tool-icon czi-heart text-white"></i>
                            </div>
                        </a>
                        <div class="navbar-tool dropdown">
                            <a class="navbar-tool-icon-box dropdown-toggle" href="{{ route('mycart') }}">
                                <span class="navbar-tool-label" id="cartQty"></span>
                                <i class="navbar-tool-icon czi-cart text-white"></i>
                            </a>
                            <!-- Cart dropdown-->
                            <div class="dropdown-menu dropdown-menu-right" style="width: 20rem;" id="dropdown-menu">
                                <div class="widget widget-cart px-3 pt-2 pb-3">
                                    <div style="height: 15rem;" data-simplebar data-simplebar-auto-hide="false">

                                        <!--   // mini cart start with ajax -->
                                        <div id="miniCart">

                                        </div>
                                        <!--   // End mini cart start with ajax -->
                                    </div>
                                    <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                                        <div class="font-size-sm mr-2 py-2">
                                            <span class="text-muted">Total:</span>
                                            <span class="text-accent font-size-base ml-1" id="cartSubTotal"></span>
                                            <span class="text-muted">Ks</span>
                                        </div>
                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('mycart') }}">Expand
                                            cart
                                            <i class="czi-arrow-right ml-1 mr-n1"></i>
                                        </a>
                                    </div>
                                    <a class="btn btn-primary btn-sm btn-block" href="{{ route('checkout') }}">
                                        <i class="czi-card mr-2 font-size-base align-middle"></i>Checkout
                                    </a>
                                </div>
                            </div>
                        </div>

                        @auth
                            <div class="navbar">
                                <div class="dropdown">
                                    <a class="navbar-tool-icon-box dropdown-toggle " data-bs-toggle="dropdown">
                                        <i class="navbar-tool-icon czi-user" id="h-a"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" id="dropdown-menu">
                                        <a class="dropdown-item text-center" href="{{ route('user.account.page') }}">
                                            {{ Auth::user()->name }}</a>
                                        <a class="dropdown-item text-center" href="{{ route('user.password.page') }}">
                                            Update Password
                                        </a>
                                        @if (Auth::check() && Auth::user()->role == 'admin')
                                            <a class="dropdown-item text-center" href="{{ route('admin.dashboard') }}">
                                                Admin Dashboard
                                            </a>
                                        @endif
                                        <a class="dropdown-item text-center" href="{{ route('user.orders') }}">Order</a>
                                        <div class="dropdown-divider"></div>
                                        <div class="text-center p-1">
                                            <a class="btn btn-primary d-block btn-sm" href="{{ route('user.logout') }}">
                                                <span style="color: #fff;">Sign Out</span>
                                            </a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @else
                            <a class="btn btn-primary btn-sm ml-3" href="{{ route('login') }}">
                                <span style="color: #fff;">Login</span>
                            </a>
                        @endauth

                        <button class="navbar-toggler ml-1" id="navbar-toggler" type="button"
                            data-toggle="collapse" data-target="#navbarCollapse">
                            <span style="color: #fff;">Menu</span>
                        </button>

                    </div>
                </div>
            </div>
        </form>
        <!-- MObile & Tablet Nav View -->
        <form action="{{ route('product.search') }}" method="post">
            @csrf
            <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu mt-n2 pt-0 pb-2">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <!-- Search-->
                        <div class="input-group-overlay d-lg-none my-3">
                            <div class="input-group-prepend-overlay">
                                <span class="input-group-text">
                                    <i class="czi-search"></i>
                                </span>
                            </div>
                            <input class="form-control prepended-form-control" placeholder="Search ......."
                                name="search" id="search2"
                                style="background-color: #233a50;border-color: #000000; color: #fff">
                        </div>
                        <!-- Primary menu-->
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown active">
                                <a class="nav-link " href="{{ route('/') }}">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item dropdown ">
                                <a class="nav-link" href="{{ route('dc.movies') }}">
                                    Movies
                                </a>

                                <div class="dropdown-menu p-0">
                                    <div class="d-flex flex-wrap flex-md-nowrap px-2">
                                        <div class="mega-dropdown-column py-4 px-3">
                                            <div class="widget widget-links mb-3 ">
                                                <ul class="widget-list">
                                                    @php
                                                        $categories = App\Models\Backend\Category::where('type', 'movie')
                                                            ->orderBy('name', 'ASC')
                                                            ->get();
                                                    @endphp
                                                    @foreach ($categories as $category)
                                                        <li class="widget-list-item pb-1">
                                                            <a class="widget-list-link "
                                                                href="{{ route('dc.movies.categories', ['id' => $category->id]) }}">{{ $category->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown ">
                                <a class="nav-link" href="{{ route('dc.series') }}">
                                    Series
                                </a>
                                <div class="dropdown-menu p-0">
                                    <div class="d-flex flex-wrap flex-md-nowrap px-2">
                                        <div class="mega-dropdown-column py-4 px-3">
                                            <div class="widget widget-links mb-3 ">
                                                <ul class="widget-list">
                                                    @php
                                                        $categories = App\Models\Backend\Category::where('type', 'serie')
                                                            ->orderBy('name', 'ASC')
                                                            ->get();
                                                    @endphp
                                                    @foreach ($categories as $category)
                                                        <li class="widget-list-item pb-1">
                                                            <a class="widget-list-link "
                                                                href="{{ route('dc.series.categories', ['id' => $category->id]) }}">{{ $category->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown ">
                                <a class="nav-link" href="{{ route('dc.games') }}">
                                    PC Games
                                </a>
                                <style>
                                    .dropdown-menu::-webkit-scrollbar {
                                        width: 0px;
                                        visibility: hidden;
                                    }

                                    .dropdown-menu::-webkit-scrollbar-thumb {
                                        background-color: #888;
                                        border-radius: 4px;

                                    }

                                    .dropdown-menu::-webkit-scrollbar-track {
                                        background-color: #f1f1f1;
                                    }
                                </style>
                                <div class="dropdown-menu p-0" style="max-height: 400px; overflow: auto;">
                                    <div class="d-flex flex-wrap flex-md-nowrap px-2">
                                        <div class="mega-dropdown-column py-4 px-3">
                                            <div class="widget widget-links mb-3">
                                                <ul class="widget-list">
                                                    <li class="widget-list-item">
                                                        <a class="widget-list-link pb-1"
                                                            href="{{ route('dc.games') }}">
                                                            Update PC Games
                                                        </a>
                                                    </li>

                                                    <li class="widget-list-item">
                                                        <a class="widget-list-link pb-1"
                                                            href="{{ route('dc.games') }}">
                                                            Small PC Games
                                                        </a>
                                                    </li>
                                                    @php
                                                        $genres = App\Models\Backend\Genre::where('type', 'game')
                                                            ->orderBy('name', 'ASC')
                                                            ->get();
                                                    @endphp
                                                    @foreach ($genres as $genre)
                                                        <li class="widget-list-item pb-1">
                                                            <a class="widget-list-link "
                                                                href="{{ route('dc.games.genres', ['id' => $genre->id]) }}">
                                                                {{ $genre->name }}
                                                                Games
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link " href="{{ route('dc.casts') }}">
                                    Casts
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link " href="{{ route('dc.blogs') }}">
                                    Blogs
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link " href="{{ route('contact.us') }}">
                                    Contact Us
                                </a>
                            </li>

                        </ul>
                    </div>

                </div>

            </div>
        </form>
    </div>

    <script>
        function search_result_show() {
            $("#searchProducts").slideDown();
        }

        function search_result_hide() {
            $("#searchProducts").slideUp();
        }
    </script>
</header>
