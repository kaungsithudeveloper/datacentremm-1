<div class="cz-handheld-toolbar">
    <div class="d-table table-fixed w-100">
        <a class="d-table-cell cz-handheld-toolbar-item" href="{{ route('wishlist') }}">
            <span class="cz-handheld-toolbar-icon" style="color: red !important">
                <i class="czi-heart" id="wishQty"></i>
            </span>

            <span class="cz-handheld-toolbar-label" style="color: red !important">Wishlist</span>
        </a>
        <a class="d-table-cell cz-handheld-toolbar-item" href="#navbarCollapse" data-toggle="collapse"
            onclick="window.scrollTo(0, 0)">
            <span class="cz-handheld-toolbar-icon" style="color: red !important">
                <i class="czi-menu"></i>
            </span>
            <span class="cz-handheld-toolbar-label" style="color: red !important">Menu</span>
        </a>
        <a class="d-table-cell cz-handheld-toolbar-item" href="{{ route('mycart') }}">
            <span class="cz-handheld-toolbar-icon" style="color: red !important">
                <i class="czi-cart"></i>
            </span>
            <span class="cz-handheld-toolbar-label" style="color: red !important">Cart</span>

        </a>
    </div>
</div>
