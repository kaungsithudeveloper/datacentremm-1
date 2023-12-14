<style>

</style>


@if ($products->isEmpty())

    <h6 class="p-2 mt-2 text-center text-light">
        Your Search Not Found
    </h6>
@else 
    <div class="container" id="container">

        <div class="col-md-12" id="col">
            <div class="card" id="card">
                @foreach ($products as $item)
                    <div class="widget-cart-item mb-1">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h6 class="widget-product-title mt-3 mb-3">
                                    <a href="{{ route('dc.detail', $item->id) }}" id="h-a">{{ $item->title }}</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>


@endif
