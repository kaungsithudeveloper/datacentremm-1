@extends('backend.layout.layout')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Order Detail</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row">
                    <div class="col-xl-4 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order infomation</h3>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <h4 class="fw-semibold">{{ $order->name }}</h4>
                                    <p>{{ $order->email }} </p>
                                    <p>{{ $order->adress }}</p>
                                    <p>{{ $order->order_date }}</p>
                                    <p class="mb-0">{{ $order->phone }} </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $order->invoice_no }}</h3>
                            </div>
                            <div class="card-body">
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
                                                                    <th class="bg-transparent border-bottom-0"> Photo</th>
                                                                    <th class="bg-transparent border-bottom-0">
                                                                        Categories
                                                                    </th>
                                                                    <th class="bg-transparent border-bottom-0"> Code</th>
                                                                    <th class="bg-transparent border-bottom-0"> Title</th>
                                                                    <th class="bg-transparent border-bottom-0"> Price</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($orderItem as $key => $item)
                                                                    <tr class="border-bottom">
                                                                        <td class="text-center">
                                                                            <div class="mt-0 mt-sm-2">
                                                                                <h6 class="mb-0 fs-14 fw-semibold">
                                                                                    {{ $key + 1 }} </h6>
                                                                            </div>
                                                                        </td>

                                                                        <td>
                                                                            <div class="d-flex">
                                                                                <div class="mt-0 mt-sm-3 d-block">
                                                                                    <img src="{{ !empty($item->product->photo) ? url('upload/product_images/' . $item->product->photo) : url('upload/blog_images.png') }}"
                                                                                        >
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        <td>
                                                                            <div class="d-flex">
                                                                                <div class="mt-0 mt-sm-3">
                                                                                    @if ($item->product->type == 'movie')
                                                                                        @foreach ($item->product->categories as $category)
                                                                                            <a class="pb-1 text-dark"

                                                                                                href="{{ route('dc.movies.categories', ['id' => $category->id]) }}">
                                                                                                {{ $category->name }}
                                                                                            </a>
                                                                                        @endforeach
                                                                                    @elseif ($item->product->type == 'serie')
                                                                                        @foreach ($item->product->series_categories as $category)
                                                                                            <a class=" pb-1 text-dark"

                                                                                                href="{{ route('dc.series.categories', ['id' => $category->id]) }}">
                                                                                                {{ $category->name }}
                                                                                            </a>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        <td>
                                                                            <div class="d-flex">
                                                                                <div class="mt-0 mt-sm-3">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                                        {{ $item->product->code }}
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        <td>
                                                                            <div class="d-flex">
                                                                                <div class="mt-0 mt-sm-3">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                                        {{ $item->product->title }}
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        <td>
                                                                            <div class="d-flex">
                                                                                <div class="mt-0 mt-sm-3">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                                        {{ $item->product->selling_price }}
                                                                                    </h6>
                                                                                </div>
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
                            <div class="card-footer text-center">
                                <h3 class="card-title text-dark">Total - {{ $order->amount }}Ks</h3>
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
