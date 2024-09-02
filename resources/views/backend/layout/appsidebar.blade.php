<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('/') }}">
                <img src="{{ url('frontend/img/logo/logo-2-light.png') }}" class="header-brand-img desktop-logo"
                    alt="logo">
                <img src="{{ url('frontend/img/logo/logo-2-light.png') }}" class="header-brand-img toggle-logo"
                    alt="logo">
                <img src="{{ url('frontend/img/logo/logo-2-dark.png') }}" class="header-brand-img light-logo"
                    alt="logo">
                <img src="{{ url('frontend/img/logo/logo-2-dark.png') }}" class="header-brand-img light-logo1"
                    alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="slide">
                    <a class="side-menu__item has-link {{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('admin.dashboard') }}">
                        <i class="side-menu__icon fe fe-home"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                @if (Auth::user()->can('admin.menu'))
                    <li class="sub-category">
                        <h3>Admins Manage</h3>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item {{ in_array(Route::currentRouteName(), ['all.admin', 'add.admin']) ? 'active' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon fe fe-users"></i>
                            <span class="side-menu__label">Admins</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu"
                            style="{{ in_array(Route::currentRouteName(), ['all.admin', 'add.admin']) ? 'display: block;' : '' }}">
                            <li class="side-menu-label1">
                                <a href="javascript:void(0)">Admin Manage</a>
                            </li>
                            @if (Auth::user()->can('admin.list'))
                                <li>
                                    <a href="{{ route('all.admin') }}"
                                        class="slide-item {{ Route::currentRouteName() === 'all.admin' ? 'active' : '' }}">
                                        All Admins</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('admin.add'))
                                <li>
                                    <a href="{{ route('add.admin') }}"
                                        class="slide-item {{ Route::currentRouteName() === 'add.admin' ? 'active' : '' }}">
                                        Add New Admin </a>
                                </li>
                            @endif
                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item " data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon fe fe-users"></i>
                            <span class="side-menu__label">Users</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1">
                                <a href="javascript:void(0)">User Manage</a>
                            </li>

                            <li>
                                <a href="{{ route('all.user') }}" class="slide-item ">
                                    All User</a>
                            </li>


                            <li>
                                <a href="{{ route('add.user') }}" class="slide-item">
                                    Add New User </a>
                            </li>

                        </ul>
                    </li>
                @endif

                @if (Auth::user()->can('blog.menu'))
                    <li class="sub-category">
                        <h3>Posts Manage</h3>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item {{ in_array(Route::currentRouteName(), ['blogs', 'posts.create', 'posts.categories']) ? 'active' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0)"><i
                                class="side-menu__icon fe fe-file-text"></i><span
                                class="side-menu__label">Posts</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu"
                            style="{{ in_array(Route::currentRouteName(), ['blogs', 'posts.create', 'posts.categories', 'posts.tags']) ? 'display: block;' : '' }}">
                            <li class="side-menu-label1">
                                <a href="javascript:void(0)">Posts Manage</a>
                            </li>

                            @if (Auth::user()->can('blog.list'))
                                <li><a href="{{ route('blogs') }}"
                                        class="slide-item {{ Route::currentRouteName() === 'blogs' ? 'active' : '' }}">
                                        All Posts</a></li>
                            @endif

                            @if (Auth::user()->can('blog.add'))
                                <li><a href="{{ route('posts.create') }}"
                                        class="slide-item {{ Route::currentRouteName() === 'posts.create' ? 'active' : '' }}">
                                        Add New Post </a></li>
                            @endif

                            @if (Auth::user()->can('blog.menu'))
                                <li><a href="{{ route('posts.categories') }}"
                                        class="slide-item {{ Route::currentRouteName() === 'posts.categories' ? 'active' : '' }}">
                                        Post Categories </a>
                                </li>
                            @endif

                            @if (Auth::user()->can('blog.menu'))
                                <li><a href="{{ route('posts.tags') }}"
                                        class="slide-item {{ Route::currentRouteName() === 'posts.tags' ? 'active' : '' }}">
                                        tags </a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                <li class="sub-category">
                    <h3>Movies Manage</h3>
                </li>

                <li class="slide">
                    <a class="side-menu__item {{ in_array(Route::currentRouteName(), ['movies']) ? 'active' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fe fe-file-text"></i>
                        <span class="side-menu__label">Movies</span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul
                        class="slide-menu {{ in_array(Route::currentRouteName(), ['movies']) ? 'display: block;' : '' }}">
                        <li class="side-menu-label1">
                            <a href="javascript:void(0)">Movies Manage</a>
                        </li>

                        <li><a href="{{ route('movies') }}"
                                class="slide-item {{ Route::currentRouteName() === 'movies' ? 'active' : '' }}">
                                All Movies
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('movies.create') }}"
                                class="slide-item {{ Route::currentRouteName() === 'movies.create' ? 'active' : '' }}">
                                Add New Movie
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fe fe-file-text"></i>
                        <span class="side-menu__label">Series</span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1">
                            <a href="javascript:void(0)">Series Manage</a>
                        </li>

                        <li><a href="{{ route('series') }}" class="slide-item ">
                                All Series
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('series.create') }}"
                                class="slide-item {{ Route::currentRouteName() === 'movies.create' ? 'active' : '' }}">
                                Add New Series
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fe fe-file-text"></i>
                        <span class="side-menu__label">Games</span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1">
                            <a href="javascript:void(0)">Games Manage</a>
                        </li>

                        <li><a href="{{ route('games') }}" class="slide-item ">
                                All Games
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('games.create') }}"
                                class="slide-item {{ Route::currentRouteName() === 'movies.create' ? 'active' : '' }}">
                                Add New Games
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link {{ Route::currentRouteName() === 'genres' ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('genres') }}">
                        <i class="side-menu__icon fe fe-home"></i>
                        <span class="side-menu__label">Genre</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link {{ Route::currentRouteName() === 'categories' ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('categories') }}">
                        <i class="side-menu__icon fe fe-home"></i>
                        <span class="side-menu__label">Categories</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link {{ Route::currentRouteName() === 'casts' ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('casts') }}">
                        <i class="side-menu__icon fe fe-home"></i>
                        <span class="side-menu__label">Casts</span>
                    </a>
                </li>

                <li class="sub-category">
                    <h3>Order Manage</h3>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fe fe-file-text"></i>
                        <span class="side-menu__label">Order</span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1">
                            <a href="javascript:void(0)">Order Manage</a>
                        </li>

                        <li><a href="{{ route('orders') }}" class="slide-item ">
                                All Order
                            </a>
                        </li>

                        <li><a href="{{ route('pending.orders') }}" class="slide-item ">
                                Pending Order
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('complete.orders') }}" class="slide-item ">
                                Complete Order
                            </a>
                        </li>

                    </ul>
                </li>

                @if (Auth::user()->can('role.permission.menu'))
                    <li class="sub-category">
                        <h3>Role & Permission</h3>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item {{ in_array(Route::currentRouteName(), ['all.permission', 'all.roles', 'add.roles.permission', 'all.roles.permission']) ? 'active' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0)"><i
                                class="side-menu__icon fe fe fe-unlock"></i><span class="side-menu__label">Role &
                                Permission</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu"
                            style="{{ in_array(Route::currentRouteName(), ['all.permission', 'all.roles', 'add.roles.permission', 'all.roles.permission']) ? 'display: block;' : '' }}">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Role & Permission</a></li>
                            <li><a href="{{ route('all.permission') }}"
                                    class="slide-item {{ Route::currentRouteName() === 'all.permission' ? 'active' : '' }}">
                                    All Permission</a></li>
                            <li><a href="{{ route('all.roles') }}"
                                    class="slide-item {{ Route::currentRouteName() === 'all.roles' ? 'active' : '' }}">
                                    All Role</a></li>
                            <li><a href="{{ route('add.roles.permission') }}"
                                    class="slide-item{{ Route::currentRouteName() === 'add.roles.permission' ? 'active' : '' }}">
                                    Roles in
                                    Permission</a></li>
                            <li><a href="{{ route('all.roles.permission') }}"
                                    class="slide-item {{ Route::currentRouteName() === 'all.roles.permission' ? 'active' : '' }}">
                                    All Roles in
                                    Permission </a></li>
                        </ul>
                    </li>
                @endif


            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>
<!-- APP-SIDEBAR END -->
