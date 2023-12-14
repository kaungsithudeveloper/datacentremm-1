<!-- app-Header -->
<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="#"></a>
            <!-- sidebar-toggle-->
            <a class="logo-horizontal " href="index.html">
                <img src="{{ url('backend/images/brand/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ url('backend/images/brand/logo-3.png') }}" class="header-brand-img light-logo1"
                    alt="logo">
            </a>
            <!-- LOGO -->

            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <!-- SEARCH -->
                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                </button>

                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">
                            <div class="dropdown d-lg-none d-flex">
                                <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                    <i class="fe fe-search"></i>
                                </a>
                                <div class="dropdown-menu header-search dropdown-menu-start">
                                    <div class="input-group w-100 p-2">
                                        <input type="text" class="form-control" placeholder="Search....">
                                        <div class="input-group-text btn btn-primary">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Theme-Layout -->
                            <div class="d-flex">
                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                    <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                    <span class="light-layout"><i class="fe fe-sun"></i></span>
                                </a>
                            </div>

                            <!-- Notifications -->
                            <div class="dropdown  d-flex notifications">
                                <a class="nav-link icon" data-bs-toggle="dropdown">
                                    <i class="fe fe-bell"></i>
                                    <span class="badge bg-secondary header-badge">
                                        @php
                                            $ncount = Auth::user()->unreadNotifications()->count()
                                        @endphp
                                        {{ $ncount }}
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading border-bottom">
                                        <div class="d-flex">
                                            <h6 class=" mb-0 fs-16 fw-semibold text-dark">Notifications
                                            </h6>
                                            <div class="ms-auto">
                                            <a href="{{ route('markAllAsRead') }}" class="badge header-badge fs-14 text-dark">
                                                Marks all as read
                                            </a>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="notifications-menu">

                                        @php
                                            $user = Auth::user();
                                        @endphp

                                        @forelse($user->notifications as $notification)
                                            @if (!$notification->read_at)
                                                <a class="dropdown-item d-flex" href="notify-list.html">
                                                    <div class="me-3 notifyimg bg-primary brround box-shadow-primary">
                                                        <i class="fe fe-mail"></i>
                                                    </div>
                                                    <div class="mt-1 wd-80p">
                                                        <h5 class="notification-label mb-1">{{ $notification->data['message'] }}</h5>
                                                        <span class="notification-subtext">
                                                            {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                </a>
                                            @endif
                                        @empty

                                        @endforelse

                                    </div>
                                    <div class="dropdown-divider m-0"></div>

                                </div>
                            </div>

                            <!-- Fullscreen -->
                            <div class="dropdown d-flex">
                                <a class="nav-link icon full-screen-link nav-link-bg">
                                    <i class="fe fe-minimize fullscreen-button"></i>
                                </a>
                            </div>

                            @php
                                $id = Auth::user()->id;
                                $adminData = App\Models\User::find($id);
                            @endphp
                            <!-- SIDE-MENU -->
                            <div class="dropdown d-flex profile-1">
                                <a href="#" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                    <img src="{{ (!empty($adminData->photo))?url('upload/admin_images/'.$adminData->photo):url('upload/profile.jpg') }}" alt="profile-user"
                                            class="avatar  profile-user brround cover-image"
                                        >
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold">{{ Auth::user()->name }}</h5> <small class="text-muted">{{ Auth::user()->email }}</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                        <i class="dropdown-icon fe fe-user"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                        <i class="dropdown-icon fe fe-mail"></i> Change Password
                                    </a>
                                    <a class="dropdown-item" href="{{ url('admin/logout') }}">
                                        <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /app-Header -->
