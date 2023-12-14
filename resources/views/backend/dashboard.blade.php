@extends('backend.layout.layout')

@section('content')

<!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Admin Dashboard</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex ">
                                                    <div class="mt-2 ">
                                                        <h6 class="">Total Movies</h6>
                                                        <h4 class="mb-0 number-font">{{ $moviesCount }} Movies</h4>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Total Series</h6>
                                                        <h4 class="mb-0 number-font">{{ $seriesCount }} Series</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Total Games</h6>
                                                        <h4 class="mb-0 number-font">{{ $gamesCount }} Games</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Total Sale</h6>
                                                        <h4 class="mb-0 number-font">{{ number_format($totalAmount, 2) }}Ks</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ROW-1 END -->

                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title mb-0">Order Infomation</h3>
                                    </div>
                                    <div class="card-body pt-4">
                                        <div class="grid-margin">
                                            <div class="">
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
                                                                            <th class="bg-transparent border-bottom-0">
                                                                                Date</th>
                                                                            <th class="bg-transparent border-bottom-0">
                                                                                Invoice
                                                                            </th>
                                                                            <th class="bg-transparent border-bottom-0">
                                                                                Name
                                                                            </th>
                                                                            <th class="bg-transparent border-bottom-0">
                                                                                Total
                                                                            </th>
                                                                            <th class="bg-transparent border-bottom-0">
                                                                                Status
                                                                            </th>
                                                                            <th class="bg-transparent border-bottom-0 text-center "
                                                                                style="width: 10%;">
                                                                                Action
                                                                            </th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        @foreach ($orders as $key => $post)
                                                                            <tr class="border-bottom">
                                                                                <td class="text-center">
                                                                                    <div class="mt-0 mt-sm-2">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                                            {{ $key + 1 }} </h6>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold">
                                                                                                {{ $post->order_date }}
                                                                                            </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold">
                                                                                                {{ $post->invoice_no }}
                                                                                            </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold">
                                                                                                {{ $post->name }}
                                                                                            </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3">
                                                                                            <h6 class="mb-0 fs-14 fw-semibold">
                                                                                                {{ $post->amount }}
                                                                                            </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-1">
                                                                                            <span
                                                                                                class="badge bg-primary">{{ $post->status }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="g-2 text-center">

                                                                                        <a href="{{ route('orders') }}"
                                                                                            class="btn text-primary btn-sm"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="Go to Order Pages">
                                                                                            <span class="fe fe-edit fs-14"></span>
                                                                                        </a>

                                                                                        <a href="{{ route('order.delete', $post->id) }}"
                                                                                            class="btn text-danger btn-sm" id="delete" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                                                                            <span class="fe fe-trash-2 fs-14"></span>
                                                                                        </a>

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
