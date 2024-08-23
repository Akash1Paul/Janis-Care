@include('users.header')

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->
    <!-- Body main wrapper start -->
    <div class="body-wrapper">
        @yield('header')
        @yield('mobile-header')
        @include('users.cart')
        @yield('mobile-menu')

        <div class="ltn__utilize-overlay"></div>

        <!-- SHOP DETAILS AREA START -->
        <div class="ltn__shop-details-area pb-85">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 mt-5">
                        <div class="ltn__shop-details-inner mb-60">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ltn__shop-details-img-gallery">
                                        <div class="ltn__shop-details-large-img">
                                            <div class="single-large-img">
                                                <a href="{{ url('image/' . $product[0]->image) }}"
                                                    data-rel="lightcase:myCollection">
                                                    <img src="{{ url('image/' . $product[0]->image) }}" alt="Image"
                                                        id="main">
                                                </a>
                                            </div>
                                        </div>
                                        <script>
                                            const change = src => {
                                                document.getElementById('main').src = src
                                            }
                                        </script>
                                        <div class="ltn__shop-details-small-img slick-arrow-2">

                                            @foreach (explode(',', $product[0]->others_image) as $item)
                                                <div class="single-small-img">
                                                    <img style="height:150px;width:300px;"
                                                        src="{{ url('storage/' . $item) }}" alt="Image"
                                                        onclick="change(this.src)">
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="modal-product-info shop-details-info pl-0">

                                        <h3>{{ $product[0]->product_name }}</h3>
                                        @if (auth()->check())
                                            {{-- @if ($product[0]->discount_price)
                                                <div class="product-price">
                                                    <span>{{ $product[0]->discount_price }} INR</span>
                                                    <del>{{ $product[0]->price }}INR </del>
                                                </div>
                                            @else
                                                <div class="product-price">
                                                    <span>{{ $product[0]->price }} INR</span>

                                                </div>
                                            @endif --}}
                                        @endif
                                        <div class="modal-product-meta ltn__product-details-menu-1">
                                            <ul>
                                                <li>
                                                    <strong>Categories:</strong>
                                                    <span>
                                                        {{ $product[0]->categories }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="ltn__product-details-menu-2">
                                            @if (auth()->check())
                                                <ul>
                                                    {{-- <form action="{{ url('cart/add/'.$product[0]->id) }}" method="POST" enctype="mutipart/form-data">
                                            @csrf --}}
                                                    {{-- <li>
                                                        <div class="cart-plus-minus">
                                                            <input type="text"
                                                                value="{{ $product[0]->order_quantity != '' ? $product[0]->order_quantity : $product[0]->min_order_quantity }}"
                                                                name="no_of_products"  id="no_of_products"
                                                                class="cart-plus-minus-box">
                                                        </div>
                                                    </li> --}}

                                                    <li>
                                                        <input type="hidden" id="product_name" name="product_name"
                                                            value="{{ $product[0]->product_name }}">
                                                        <input type="hidden" id="image" name="image"
                                                            value="{{ $product[0]->image }}">
                                                        {{-- @if ($product[0]->discount_price)
                                                            <input type="hidden" id="price" name="price"
                                                                value="{{ $product[0]->discount_price }}">
                                                        @else
                                                            <input type="hidden" id="price" name="price"
                                                                value="{{ $product[0]->price }}">
                                                        @endif --}}

                                                        {{-- <div class="alert alert-warning alert-dismissible fade show"
                                                            role="alert" id="cart-alert" style="display: none;">
                                                            <strong>Warning!</strong> You Have To Cart Minimum
                                                            {{ $product[0]->order_quantity }}
                                                            {{ $product[0]->product_name }}
                                                            <button type="button" class="close1" data-dismiss="alert"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div> --}}

                                                        {{-- <button type="" class="theme-btn-1 btn btn-effect-1"
                                                            id="cart2"> <i class="fas fa-shopping-cart"></i>
                                                            <span>ADD TO CART</span></button> --}}
                                                        <script>
                                                            $(document).ready(function() {
                                                                $('#cart2').click(function() {
                                                                    if ($('#no_of_products').val() < {{ $product[0]->order_quantity!=''?$product[0]->order_quantity:$product[0]->min_order_quantity }}) {
                                                                        $("#cart-alert").fadeIn();
                                                                        $("#cart-alert .close1").click(function() {
                                                                            $("#cart-alert").hide();
                                                                        });
                                                                        $.ajaxStop(); // Stop all AJAX requests   
                                                                    }

                                                                });
                                                            });
                                                        </script>





                                                    </li>
                                                    {{-- </form> --}}
                                                </ul>
                                            @else
                                                <div class="alert alert-warning alert-dismissible fade show"
                                                    role="alert" id="login-alert" style="display: none;">
                                                    <strong>Warning!</strong> You must log in to access this feature.
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <button type="button" class="theme-btn-1 btn btn-effect-1"
                                                    id="add-to-cart-btn">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    <span>ADD TO CART</span>
                                                </button>

                                            @endif
                                        </div>

                                        <hr>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Shop Tab Start -->
                        <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                            <div class="ltn__shop-details-tab-menu">
                                <div class="nav">
                                    <a class="active show" data-bs-toggle="tab"
                                        href="#liton_tab_details_1_1">Description</a>

                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="liton_tab_details_1_1">
                                    <div class="ltn__shop-details-tab-content-inner">

                                        <p>
                                            {{ $product[0]->description }}
                                        </p>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="liton_tab_details_1_2">
                                    <div class="ltn__shop-details-tab-content-inner">
                                        <h4 class="title-2">Customer Reviews</h4>
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                            </ul>
                                        </div>
                                        <hr>
                                        <!-- comment-area -->
                                        <div class="ltn__comment-area mb-30">
                                            <div class="ltn__comment-inner">
                                                <ul>
                                                    <li>
                                                        <div class="ltn__comment-item clearfix">
                                                            <div class="ltn__commenter-img">
                                                                <img src="img/testimonial/1.jpg" alt="Image">
                                                            </div>
                                                            <div class="ltn__commenter-comment">
                                                                <h6><a href="#">Adam Smit</a></h6>
                                                                <div class="product-ratting">
                                                                    <ul>
                                                                        <li><a href="#"><i
                                                                                    class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i
                                                                                    class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i
                                                                                    class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i
                                                                                    class="fas fa-star-half-alt"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                    elit. Doloribus, omnis fugit corporis iste magnam
                                                                    ratione.</p>
                                                                <span class="ltn__comment-reply-btn">September 3,
                                                                    2020</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="ltn__comment-item clearfix">
                                                            <div class="ltn__commenter-img">
                                                                <img src="img/testimonial/3.jpg" alt="Image">
                                                            </div>
                                                            <div class="ltn__commenter-comment">
                                                                <h6><a href="#">Adam Smit</a></h6>
                                                                <div class="product-ratting">
                                                                    <ul>
                                                                        <li><a href="#"><i
                                                                                    class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i
                                                                                    class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i
                                                                                    class="fas fa-star"></i></a></li>
                                                                        <li><a href="#"><i
                                                                                    class="fas fa-star-half-alt"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i
                                                                                    class="far fa-star"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                    elit. Doloribus, omnis fugit corporis iste magnam
                                                                    ratione.</p>
                                                                <span class="ltn__comment-reply-btn">September 2,
                                                                    2020</span>
                                                            </div>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Shop Tab End -->
                    </div>

                </div>
            </div>
        </div>
        <!-- SHOP DETAILS AREA END -->


        <!-- CALL TO ACTION START (call-to-action-6) -->
        <div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="img/1.jpg--">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div
                            class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                            <div class="coll-to-info text-color-white">
                                <h1>Buy medical disposable face mask <br> to protect your loved ones</h1>
                            </div>
                            <div class="btn-wrapper">
                                <a class="btn btn-effect-3 btn-white" href="shop.html">Explore Products <i
                                        class="icon-next"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CALL TO ACTION END -->






        <!-- MODAL AREA START (Add To Cart Modal) -->
        <div class="ltn__modal-area ltn__add-to-cart-modal-area">
            <div class="modal fade" id="add_to_cart_modal9" tabindex="-1">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a href=""><button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button></a>
                        </div>
                        <div class="modal-body">
                            <div class="ltn__quick-view-modal-inner">
                                <div class="modal-product-item">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="modal-product-img">
                                                <img src="{{ url('image/' . $product[0]->image) }}" alt="#">
                                            </div>
                                            <div class="modal-product-info">
                                                <h5><a href=""></a></h5>
                                                <p class="added-cart"><i class="fa fa-check-circle"></i> Successfully
                                                    added to your Cart</p>

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
        <!-- MODAL AREA END -->



        <!-- MODAL AREA START (Wishlist Modal) -->
        <div class="ltn__modal-area ltn__add-to-cart-modal-area">
            <div class="modal fade" id="liton_wishlist_modal" tabindex="-1">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="ltn__quick-view-modal-inner">
                                <div class="modal-product-item">
                                    <div class="row">
                                        {{-- <div class="col-12">
                                        <div class="modal-product-img">
                                            <img src="{{url('img/product/7')}}.png" alt="#">
                                        </div>
                                         <div class="modal-product-info">
                                            <h5><a href="#">Digital Stethoscope</a></h5>
                                            <p class="added-cart"><i class="fa fa-check-circle"></i>  Successfully added to your Wishlist</p>
                                            <div class="btn-wrapper">
                                                <a href="wishlist.html" class="theme-btn-1 btn btn-effect-1">View Wishlist</a>
                                            </div>
                                         </div>
                                         <!-- additional-info -->
                                         <div class="additional-info d-none">
                                            <p>We want to give you <b>10% discount</b> for your first order, <br>  Use discount code at checkout</p>
                                            <div class="payment-method">
                                                <img src="img/icons/payment.png" alt="#">
                                            </div>
                                         </div>
                                    </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL AREA END -->

    </div>




    <script>
        $(document).ready(function() {
            $("#add-to-cart-btn").click(function() {
                $("#login-alert").fadeIn();
            });
            $("#login-alert .close").click(function() {
                $("#login-alert").hide();
            });

            $('#cart2').click(function() {
                var product_id = $('#product_id').val();
                var price = $('#price').val();
                var moq = $('#no_of_products').val();

                // alert(price);return;
                jQuery.ajax({
                    url: '{{ url('cart/add') }}',
                    type: 'POST',
                    
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data: {
                        product_id: product_id,
                        price: price,
                        moq: moq
                    },
                    
                    success: function(response) {
                        $('#add_to_cart_modal9').modal('show');
                    }
                });
            });
        });
    </script>


    <!-- Body main wrapper end -->
    @include('users.footer')
