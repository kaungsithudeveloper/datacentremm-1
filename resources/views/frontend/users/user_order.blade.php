@extends('frontend.layout.layout')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="py-3" id="page-title">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-1">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap"><a href="#">User</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-2 text-center text-lg-left">
                <h1 class="h3 mb-0 text-white"> user </h1>
            </div>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-3 mt-4">
        <div class="row">
            <!-- Sidebar-->
            <aside class="col-lg-4 pt-2 pt-lg-0">
                <div class="cz-sidebar-static rounded-lg box-shadow-lg px-0 pb-0 mb-5 mb-lg-0"
                    style="background-color: #233a50;">
                    <div class="px-4 mb-4">
                        <div class="media align-items-center">
                            <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;">
                                <img class="rounded-circle"
                                    src="{{ !empty($user->photo) ? url('upload/user_images/' . $user->photo) : url('upload/profile.jpg') }}"
                                    alt="User">
                            </div>
                            <div class="media-body pl-3">
                                <h3 class="font-size-base mb-0" id="h-a">{{ $user->name }}</h3>
                                <span class="text-accent font-size-sm">{{ $user->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-secondary px-4 py-3">
                        <h3 class="font-size-sm mb-0 text-muted">Account settings</h3>
                    </div>
                    <ul class="list-unstyled mb-0">
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3"
                                href="{{ route('user.account.page') }}" id="h-a">
                                <i class="czi-user opacity-60 mr-2"></i>
                                Profile info
                            </a>
                        </li>
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3"
                                href="{{ route('user.password.page') }}" id="h-a">
                                <i class="czi-locked opacity-60 mr-2"></i>
                                Password Update
                            </a>
                        </li>
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ route('user.orders') }}"
                                id="h-a">
                                <i class="czi-bag opacity-60 mr-2"></i>Orders
                                <span class="font-size-sm text-muted ml-auto">{{ $ordersCount }}</span>
                            </a>
                        </li>
                        <li class="border-bottom mb-0">
                            <a class="nav-link-style d-flex align-items-center px-4 py-3 active"
                                href="{{ route('wishlist') }}" id="h-a">
                                <i class="czi-heart opacity-60 mr-2"></i>Wishlist
                                <span class="font-size-sm text-muted ml-auto">{{ $wishQty }}</span>
                            </a>
                        </li>

                        <li class="m-3">
                            <a class="btn btn-primary btn-shadow btn-block mt-4" href="{{ route('user.logout') }}">
                                <i class="czi-sign-out mr-2"></i>Sign
                                out</a>
                        </li>
                    </ul>

                    <div class="cz-sidebar  ml-lg-auto" id="blog-sidebar" style="background-color: #233a50;">
                        <br>
                        <div class="cz-sidebar-header box-shadow-sm">
                            <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close">
                                <span class="d-inline-block font-size-xs font-weight-normal align-middle">Close
                                    sidebar</span>
                                <span class="d-inline-block align-middle ml-2" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- Content  -->
            <section class="col-lg-8 mt-4">
                <div class="table-responsive font-size-md">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="text-light">Order #</th>
                                <th class="text-light">Date Purchased</th>
                                <th class="text-light">Status</th>
                                <th class="text-light">Total</th>
                                <th class="text-light text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td class="py-3">
                                        <a class="nav-link-style font-weight-medium  font-size-sm" href="#order-details"
                                            data-toggle="modal">
                                            {{ $order->invoice_no }}
                                        </a>
                                    </td>
                                    <td class="py-3 font-weight-medium  font-size-sm">
                                        {{ $order->order_date }}
                                    </td>
                                    <td class="py-3">
                                        @if ($order->status == 'pending')
                                            <span class="badge rounded-pill badge-primary">Pending</span>
                                        @elseif($order->status == 'confirm')
                                            <span class="badge rounded-pill badge-info">Confirm</span>
                                        @elseif($order->status == 'processing')
                                            <span class="badge rounded-pill badge-dark">Processing</span>
                                        @elseif($order->status == 'deliverd')
                                            <span class="badge rounded-pill badge-success">Deliverd</span>

                                            @if ($order->return_order == 1)
                                                <span class="badge rounded-pill " style="background:red;">Return</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="py-3 font-weight-medium  font-size-sm">
                                        {{ $order->amount }}Ks
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('user/order_details/' . $order->id) }}"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="czi-edit"></i> View
                                        </a>
                                        <a href="{{ route('order.delete', $order->id) }}" class="btn btn-outline-info btn-sm">
                                            <i class="czi-download"></i> Invoice
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr class="pb-4">
                <!-- Pagination-->
                <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
                    <ul class="pagination">
                        @if ($orders->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="czi-arrow-left mr-2"></i>Prev</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->previousPageUrl() }}"><i
                                        class="czi-arrow-left mr-2"></i>Prev</a>
                            </li>
                        @endif
                    </ul>

                    <ul class="pagination">
                        <li class="page-item d-sm-none">
                            <span class="page-link page-link-static">{{ $orders->currentPage() }} /
                                {{ $orders->lastPage() }}</span>
                        </li>
                        @foreach (range(1, $orders->lastPage()) as $page)
                            @if ($page == $orders->currentPage())
                                <li class="page-item active d-none d-sm-block" aria-current="page">
                                    <span class="page-link">{{ $page }}<span
                                            class="sr-only">(current)</span></span>
                                </li>
                            @else
                                <li class="page-item d-none d-sm-block">
                                    <a class="page-link" href="{{ $orders->url($page) }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>

                    <ul class="pagination">
                        @if ($orders->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Next">Next<i
                                        class="czi-arrow-right ml-2"></i></a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next<i class="czi-arrow-right ml-2"></i></span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </section>
        </div>
    </div>
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
@endsection
