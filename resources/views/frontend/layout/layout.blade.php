<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DataCentre </title>

    <!-- SEO Meta Tags-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="DataCentre | Movies, Series, Pc Games">
    <meta name="keywords" content="bootstrap, datacentre, movie, series,">
    <meta name="author" content="DataCentre">


    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon and Touch Icons-->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <script src="https://www.youtube.com/iframe_api"></script>

    <link rel="shortcut icon" type="image/x-icon" href="{{ url('backend/images/brand/favicon.ico') }}" />

    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="{{ url('frontend/css/vendor.min.css') }}">

    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" id="main-styles" href="{{ url('frontend/css/theme.min.css') }}">

    <!-- View Message CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <style>
        .dropdown-menu {
            background-color: #233a50;
            border: 0px;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #fff;
        }

        .font-size-sm {
            color: #9f9f9f;
        }

        #page-title {
            background-color: #233a50;
        }

        #btn-tag {
            background-color: #fe696a;
            border: 0px;
            color: #fff;
        }

        #btn-tag:hover {
            background-color: #fff;
            border: 0px;
            color: #000000;
        }

        @media (max-width: 990px) {
            .widget-list-link {
                color: #fff;
                /* Change the color for mobile and tablet */
            }
        }
    </style>
</head>
<!-- Body-->

<body style="background-color: #0f2133;">

    <!-- Sign in / sign up modal-->
    @include('frontend.layout.model')

    <!-- Navbar -->
    @include('frontend.layout.header')



    <!-- Content  -->
    @yield('content')




    <!-- Footer-->
    @include('frontend.layout.footer')

    <!-- Toolbar for handheld devices-->
    @include('frontend.layout.handheld')

    <!-- Back To Top Button-->
    <a class="btn-scroll-top" href="#top" data-scroll>
        <span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2">Top</span>
        <i class="btn-scroll-top-icon czi-arrow-up"></i>
    </a>

    <!-- Toast: Added to Cart-->
    <div class="toast-container toast-bottom-center">
        <div class="toast mb-3" id="cart-toast" data-delay="5000" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header bg-success text-white"><i class="czi-check-circle mr-2"></i>
                <h6 class="font-size-sm text-white mb-0 mr-auto">Added to cart!</h6>
                <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="toast-body">This item has been added to your cart.</div>
        </div>
    </div>

    <!-- JavaScript libraries, plugins and custom scripts-->
    <script src="{{ url('frontend/js/vendor.min.js') }}"></script>
    <script src="{{ url('frontend/js/theme.min.js') }}"></script>




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;
                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;
                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;
                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

    <!-- navbar user dropdown-->
    <script>
        document.addEventListener('click', function(event) {
            var dropdownToggles = document.querySelectorAll('[data-bs-toggle="dropdown"]');

            dropdownToggles.forEach(function(dropdownToggle) {
                var dropdownMenu = dropdownToggle.nextElementSibling;

                if (dropdownToggle === event.target) {
                    var bootstrapDropdown = new bootstrap.Dropdown(dropdownToggle);
                    if (dropdownMenu.classList.contains('show')) {
                        bootstrapDropdown.hide();
                    } else {
                        bootstrapDropdown.show();
                    }
                } else if (!dropdownMenu.contains(event.target)) {
                    var bootstrapDropdown = new bootstrap.Dropdown(dropdownToggle);
                    bootstrapDropdown.hide();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /// Start Add To Cart Prodcut

        function addToCartDetails(movieId) {
            // Get the product information
            var movieName = $('#mname_' + movieId).text();
            var quantity = $('#qty_' + movieId).val();

            if (!quantity) {
                quantity = 1;
            }

            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    quantity: quantity,
                    movie_name: movieName
                },
                url: "/dcart/data/store/" + movieId,
                success: function(data) {
                    //console.log(data);

                    miniCart();

                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success,
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.error,
                        });
                    }
                    // End Message
                },
                error: function(error) {
                    console.error('Error adding to cart:', error);
                }
            });
        }

        function addToCart(movieId) {
            // Get the product information
            var movieName = $('#mname_' + movieId).text();
            var quantity = $('#qty_' + movieId).val();

            if (!quantity) {
                quantity = 1;
            }

            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    quantity: quantity,
                    movie_name: movieName
                },
                url: "/cart/data/store/" + movieId,
                success: function(data) {
                    //console.log(data);

                    miniCart();

                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success,
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.error,
                        });
                    }
                    // End Message
                },
                error: function(error) {
                    console.error('Error adding to cart:', error);
                }
            });
        }

        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/movie/mini/cart',
                dataType: 'json',
                success: function(response) {
                    //console.log(response);


                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('#cartQty').text(response.cartQty);

                    var miniCart = "";
                    $.each(response.carts, function(key, value) {
                        miniCart += `
                        <div class="widget-cart-item pb-2 border-bottom">
                            <button class="close text-danger" type="button" aria-label="Remove">
                                <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)" >
                                    <span aria-hidden="true" style="color: red !important; font-size: 18px !important;">&times;</span>
                                </a>
                            </button>
                            <div class="media align-items-center">
                                <a class="d-block mr-2" href="shop-single-v1.html">
                                    <img style="width:50px;height:70px;" src="/upload/product_images/${value.options.image}" alt="Product" />
                                </a>
                                <div class="media-body">
                                    <h6 class="widget-product-title">
                                        <a href="shop-single-v1.html">${value.name}</a>
                                    </h6>
                                    <div class="widget-product-meta">
                                        <span class="text-accent mr-2">${value.price}Ks</span>
                                        <span class="text-muted">x ${value.qty}</span>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    });
                    $('#miniCart').html(miniCart);
                },
                error: function(error) {
                    console.error('Error fetching mini cart:', error);
                }
            });
        }
        miniCart();
        /// End Add To Cart Prodcut

        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/movie/remove/' + rowId,
                dataType: 'json',
                success: function(data) {
                    miniCart();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        })
                    } else {

                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        })
                    }
                    // End Message
                }
            })
        }
    </script>

    <!--  // Start Load MY Cart // -->
    <script type="text/javascript">
        function cart() {
            $.ajax({
                type: 'GET',
                url: '/get-cart-product',
                dataType: 'json',
                success: function(response) {
                    // console.log(response)

                    var cartTotalWithSymbol = response.cartTotal + ' Ks';

                    $('h3[id="cartSubTotal"]').text(cartTotalWithSymbol);

                    var rows = ""
                    $.each(response.carts, function(key, value) {
                        rows += `

                                <div class="col-4 col-md-2 px-2 mb-4">
                                    <div class="card product-card card-static" id="custom-card">
                                        <a class=" d-block overflow-hidden" href="">
                                            <img src="/upload/product_images/${value.options.image}" alt="Product">
                                        </a>
                                        <div class="d-flex justify-content-between font-size-sm mt-1 mb-2">
                                            <a class="product-meta d-block font-size-xs mr-1" id="h-a">
                                                <div class="movie-title">
                                                    Price- ${value.price}Ks
                                                </div>
                                            </a>
                                        </div>

                                        <a href="">
                                            <div class="movie-title font-size-sm" id="h-a">
                                                ${value.name}
                                            </div>
                                        </a>

                                        <a type="submit" class="btn btn-outline-danger btn-sm btn-block mt-1" id="h-btn" onclick="cartRemove('${value.rowId}')">
                                           Remove
                                        </a>

                                    </div>
                                </div>

                                `
                    });
                    $('#cartPage').html(rows);
                }
            })
        }

        function cart2() {
            $.ajax({
                type: 'GET',
                url: '/get-cart-product',
                dataType: 'json',
                success: function(response) {
                    // console.log(response)

                    var cartTotalWithSymbol = response.cartTotal + ' Ks';

                    $('h3[id="cartSubTotal"]').text(cartTotalWithSymbol);

                    var rows = ""
                    $.each(response.carts, function(key, value) {
                        rows += `

                                <div class="col-3 col-lg-3 px-2 mb-4">
                                    <div class="card product-card card-static" id="custom-card">
                                        <a class=" d-block overflow-hidden" href="">
                                            <img src="/upload/product_images/${value.options.image}" alt="Product">
                                        </a>

                                        <a href="">
                                            <div class="movie-title font-size-sm" id="h-a">
                                                ${value.name}
                                            </div>
                                        </a>


                                    </div>
                                </div>

                                `
                    });
                    $('#cartPage2').html(rows);
                }
            })
        }

        cart();

        cart2();
        // Cart Remove Start
        function cartRemove(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/cart-remove/" + id,
                success: function(data) {
                    cart();
                    miniCart();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success,
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.error,
                        });
                    }
                    // End Message
                }
            })
        }
        // Cart Remove End
    </script>
    <!--  // End Load MY Cart // -->

    <!--  // wishlist  // -->
    <script type="text/javascript">
        /// Start Wishlist Data
        function addToWishList(movie_id) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/add-to-wishlist/" + movie_id,
                success: function(data) {
                    // Start Message
                    wishlist();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success,
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.error,
                        });
                    }
                    // End Message
                }
            });
        }

        /// Start Load Wishlist Data
        function wishlist() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get-wishlist-movie/",
                success: function(response) {


                    $('#wishQty').text(response.wishQty);

                    var rows = ""
                    $.each(response.wishlist, function(key, value) {
                        rows += `
                            <div class="d-sm-flex justify-content-between mb-4 pb-3 pb-sm-2 border-bottom">
                                <div class="media media-ie-fix d-block d-sm-flex text-center text-sm-left">
                                    <a class="d-inline-block mx-auto mr-sm-4" href="shop-single-v1.html" style="width: 7rem;">
                                        <img src="/upload/product_images/${value.product.photo}" alt="Product">
                                    </a>
                                    <div class="media-body pt-2">
                                        <h3 class="product-title font-size-base mb-2"><a href="shop-single-v1.html">
                                            ${value.product.title}</a>
                                        </h3>

                                        <div class="font-size-sm">
                                            <span class="text-muted mr-2">Categories:</span>
                                            ${value.product.categories
                                                ? value.product.categories.map(category => `<span class="tag tag-blue">${category.name}</span>`).join('')
                                                : 'No categories available'
                                            }
                                        </div>
                                        <div class="font-size-sm">
                                            <span class="text-muted mr-2">Genres:</span>
                                            ${value.product.genres
                                                ? value.product.genres.map(genre => `<span class="tag tag-blue">${genre.name}, </span>`).join('')
                                                : 'No categories available'
                                            }
                                        </div>

                                        <div class="font-size-lg text-accent pt-2">
                                            ${value.product.discount_price == null
                                            ? `${value.product.selling_price}Ks`
                                            : `${value.product.discount_price}Ks`
                                            }
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 pl-sm-3 mx-auto mx-sm-0 text-center">
                                    <button class="btn btn-outline-danger btn-sm" type="submit"
                                        id="${value.id}" onclick="wishlistRemove(this.id)">
                                        <i class="czi-trash mr-2"></i>Remove</button>
                                </div>
                            </div>
                        `
                    });
                    $('#wishlist').html(rows);
                }
            })
        }
        wishlist();

        // Wishlist Remove Start
        function wishlistRemove(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/wishlist-remove/" + id,
                success: function(data) {
                    wishlist();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success,
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.error,
                        });
                    }
                    // End Message
                }
            })
        }
        // Wishlist Remove End
    </script>

    <!--Search Js -->
    <script src="{{ url('frontend/js/search.js') }}"></script>


</body>

</html>
