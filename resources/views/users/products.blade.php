@include('users.header')

<body>
    <!-- Body main wrapper start -->
    <div class="body-wrapper">

        @yield('header')
        @yield('mobile-header')
        @include('users.cart')
        @yield('mobile-menu')

        <div class="ltn__utilize-overlay"></div>
        <!-- PRODUCT DETAILS AREA START -->
        <div class="ltn__product-area ltn__product-gutter mt-5 mb-120">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="ltn__shop-options">
                            <ul>
                                <li>
                                    <div class="ltn__grid-list-tab-menu ">
                                        <div class="nav">
                                            <a class="active show" data-bs-toggle="tab" href="#liton_product_grid"><i
                                                    class="fas fa-th-large"></i></a>
                                            <a data-bs-toggle="tab" href="#liton_product_list"><i
                                                    class="fas fa-list"></i></a>
                                        </div>
                                    </div>
                                </li>
                                <li>

                                </li>
                                <li>
                                    <div class="short-by text-center">
                                        <select class="nice-select" id="select-sorting">
                                            <option>Default sorting</option>
                                            <option value="new">Sort by new arrivals</option>
                                            <option value="lth">Sort by price: low to high</option>
                                            <option value="htl">Sort by price: high to low</option>
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">

                            <div class="tab-pane fade active show" id="liton_product_grid">
                                <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                    <div class="row" id="show">

                                        <div class="show"></div>
                                        @foreach ($products as $key => $item)
                                            <!-- ltn__product-item -->
                                            <div class="col-xl-3 col-lg-4 col-sm-6 col-6 searchproduct" id="hide">

                                                <div class="ltn__product-item ltn__product-item-3 text-center">
                                                    <div class="product-img">
                                                        <a href="#" title="Quick View" data-bs-toggle="modal"
                                                            data-bs-target="#quick_view_modal{{ $item->product_id }}"><img
                                                                src="{{ url('image/' . $item->image) }}"
                                                                alt="#"></a>

                                                        <div class="product-badge">
                                                            <ul>
                                                                <li class="sale-badge">New</li>
                                                            </ul>
                                                        </div>
                                                        <div class="product-hover-action">
                                                            <ul>
                                                                <li>
                                                                    <a href="#" title="Quick View"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#quick_view_modal{{ $item->product_id }}">
                                                                        <i class="far fa-eye"></i>
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-info">
                                                        <div class="product-ratting">
                                                            {{-- <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul> --}}
                                                            <ul>

                                                     
                                                                @if (auth()->check())
                                                                    @if ($item->discount_price)
                                                                        <div class="product-price">
                                                                            <span><span
                                                                                    id="price{{ $item->product_id }}">{{ $item->discount_price }}</span>
                                                                                INR </span>
                                                                            <del>{{ $item->price }} INR </del>
                                                                        </div>
                                                                    @else
                                                                        <div class="product-price">
                                                                            <span><span
                                                                                    id="price{{ $item->product_id }}">{{ $item->price }}</span>
                                                                                INR </span>

                                                                        </div>
                                                                    @endif
                                                                @endif
                                                                <div class="alert alert-warning alert-dismissible fade show"
                                                                    role="alert"
                                                                    id="login-alert{{ $item->product_id }}"
                                                                    style="display: none;">
                                                                    <strong>Warning!</strong> You must log in to access
                                                                    this
                                                                    feature.
                                                                    <button type="button"
                                                                        class="close{{ $item->product_id }}"
                                                                        data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <div class="alert alert-warning alert-dismissible fade show"
                                                                    role="alert"
                                                                    id="cart-alert{{ $item->product_id }}"
                                                                    style="display: none;">
                                                                    @if (auth()->check())
                                                                        <strong>Warning!</strong> You Have To Cart
                                                                        Minimum
                                                                        {{ isset($item->order_quantity) ? $item->order_quantity : $item->min_order_quantity }}
                                                                        {{ $item->product_name }}
                                                                    @endif
                                                                    <button type="button"
                                                                        class="close1{{ $item->product_id }}"
                                                                        data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                @if (auth()->check())
                                                                    <div class="cart-plus-minus">

                                                                        <input type="text"
                                                                            value="{{ $item->order_quantity != null ? $item->order_quantity : $item->min_order_quantity }}"
                                                                            name="no_of_products"
                                                                            id="no_of_products{{ $item->product_id }}"
                                                                            class="cart-plus-minus-box"
                                                                            oninput="validateMinimumValue(this, {{ $item->order_quantity != null ? $item->order_quantity : $item->min_order_quantity }})">

                                                                        <script>
                                                                            function validateMinimumValue(input, minValue) {
                                                                                if (input.value < minValue) {
                                                                                    input.value = minValue; // Set the input value to the minimum value
                                                                                }
                                                                            }
                                                                        </script>


                                                                    </div>
                                                                @endif
                                                                <input type="hidden" id="product_id{{ $item->product_id }}"
                                                                  name="" value="{{ $item->product_id }}">
                                                                  @if (auth()->check())
                                                                  @if ($item->discount_price)
                                                                      <input type="hidden"
                                                                          id="price{{ $item->product_id }}" name="price"
                                                                          min="{{ $item->discount_price }}"
                                                                          value="{{ $item->discount_price }}">
                                                                  @else
                                                                      <input type="hidden"
                                                                          id="price{{ $item->product_id }}" name="price"
                                                                          min="{{ $item->price }}"
                                                                          value="{{ $item->price }}">
                                                                  @endif
                                                              @endif
      
                                                              <li>
                                                                  @if (auth()->check())
                                                            
                                                                          <li><input type="checkbox" name=""
                                                                            id="cart2{{ $item->product_id }}"></li>
                                                                      <script>
                                                                          $(document).ready(function() {
                                                                              $('#cart2{{ $item->product_id }}').click(function() {
      
                                                                                  if ($('#no_of_products{{ $item->product_id }}').val() <
                                                                                      {{ $item->order_quantity != '' ? $item->order_quantity : $item->min_order_quantity }}
                                                                                      ) {
                                                                                      $("#cart-alert{{ $item->product_id }}").fadeIn();
                                                                                      $("#cart-alert{{ $item->product_id }} .close1{{ $item->product_id }}").click(
                                                                                      function() {
                                                                                          $("#cart-alert{{ $item->product_id }}").hide();
                                                                                      });
      
                                                                                      $.ajaxStop(); // Stop all AJAX requests
                                                                                  }
                                                                              });
                                                                          });
                                                                      </script>
                                                            
                                                                  
                                                                  @endif
      
      
      
                                                              </li>
                                                            </ul>

                                                        </div>

                                                        <h2 class="product-title name"> <a
                                                                href="{{ url('product/' . $item->product_id) }}">
                                                                {{ $item->product_name }} </a></h2>
                                                        {{-- <div class="product-price">
                                                    <span>$149.00</span>
                                                    <del>$162.00</del>
                                                </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="liton_product_list">
                                <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                    <div class="row " id="show2">

                                        @foreach ($products as $key => $item)
                                            <!-- ltn__product-item -->
                                            <div class="col-lg-12 searchproduct">
                                                <div class="ltn__product-item ltn__product-item-3">
                                                    <div class="product-img">

                                                        <a href="#" title="Quick View" data-bs-toggle="modal"
                                                            data-bs-target="#quick_view_modal{{ $item->product_id }}"><img
                                                                src="{{ url('image/' . $item->image) }}"
                                                                alt="#"></a>


                                                        <div class="product-badge">
                                                            <ul>
                                                                <li class="sale-badge">New</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-info">
                                                        <h2 class="product-title name"><a
                                                                href="{{ url('product/' . $item->product_id) }}">{{ $item->product_name }}</a>
                                                        </h2>
                                                        <div class="product-ratting">

                                                        </div>
                                                        <div class="product-price">

                                                            {{-- <span>$165.00</span>
                                                    <del>$1720.00</del> --}}
                                                        </div>
                                                        <div class="product-brief">
                                                            <p>{{ $item->description }}</p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <!--  -->
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                        class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($products as $key => $item)
        <!-- MODAL AREA START (Quick View Modal) -->
        <div class="ltn__modal-area ltn__quick-view-modal-area">
            <div class="modal fade" id="quick_view_modal{{ $item->product_id }}" tabindex="-1">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <!-- <i class="fas fa-times"></i> -->
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="ltn__quick-view-modal-inner">
                                <div class="modal-product-item">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">

                                            <div class="modal-product-img">
                                                <img src="{{ url('image/' . $item->image) }}" alt="#">
                                            </div>

                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="modal-product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        {{-- <div class="alert alert-warning alert-dismissible fade show"
                                                        role="alert" id="login-alert{{ $item->product_id }}"
                                                        style="display: none;">
                                                        <strong>Warning!</strong> You must log in to access this
                                                        feature.
                                                        <button type="button"
                                                            class="close{{ $item->product_id }}"
                                                            data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="alert alert-warning alert-dismissible fade show"
                                                        role="alert" id="cart-alert{{ $item->product_id }}"
                                                        style="display: none;">
                                                        @if (auth()->check())
                                                            <strong>Warning!</strong> You Have To Cart Minimum
                                                            {{ isset($item->order_quantity) ? $item->order_quantity : $item->min_order_quantity }}
                                                            {{ $item->product_name }}
                                                        @endif
                                                        <button type="button"
                                                            class="close1{{ $item->product_id }}"
                                                            data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div> --}}
                                                    </ul>
                                                </div>
                                                <h3>{{ $item->product_name }}</h3>
                                                @if (auth()->check())
                                                    {{-- @if ($item->discount_price)
                                                        <div class="product-price">
                                                            <span><span
                                                                    id="price{{ $item->product_id }}">{{ $item->discount_price }}</span>
                                                                INR </span>
                                                            <del>{{ $item->price }} INR </del>
                                                        </div>
                                                    @else
                                                        <div class="product-price">
                                                            <span><span id="price{{ $item->product_id }}">{{ $item->price }}</span>
                                                                INR </span>
                                                        </div>
                                                    @endif --}}
                                                @endif

                                                <div class="modal-product-meta ltn__product-details-menu-1">
                                                    <ul>
                                                        <li>
                                                            <strong>Categories:</strong>
                                                            <span>{{ $item->categories }}</span>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="ltn__product-details-menu-2">
                                                    <h3><span style="font-size:15px"></span></h3>
                                                    <ul>
                                                        <li>
                                                            @if (auth()->check())
                                                                <div class="cart-plus-minus">

                                                                    <input type="text"
                                                                        value="{{ $item->order_quantity != null ? $item->order_quantity : $item->min_order_quantity }}"
                                                                        name="no_of_products"
                                                                        id="no_of_products{{ $item->product_id }}"
                                                                        class="cart-plus-minus-box"
                                                                        oninput="validateMinimumValue(this, {{ $item->order_quantity != null ? $item->order_quantity : $item->min_order_quantity }})">

                                                                    <script>
                                                                        function validateMinimumValue(input, minValue) {
                                                                            if (input.value < minValue) {
                                                                                input.value = minValue; // Set the input value to the minimum value
                                                                            }
                                                                        }
                                                                    </script>


                                                                </div>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="ltn__product-details-menu-3">
                                                </div>
                                                <hr>

                                                <div class="ltn__social-media">
                                                    <ul>


                                                    </ul>
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
        <!-- MODAL AREA END -->
    @endforeach

    <script>
        $(document).ready(function() {
            $('#select-sorting').change(function() {
                var sort_value = $('#select-sorting').val();
                jQuery.ajax({
                    url: '{{ url('filter-products') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        sort_value: sort_value,
                    },
                    success: function(response) {
                        $('#show').html(response.data);
                        $('#show2').html(response.data1);

                    }
                });
            });
        })
    </script>

    @foreach ($products as $key => $item)
        <script>
            $(document).ready(function() {

                $("#add-to-cart-btn{{ $item->product_id }}").click(function() {
                    $("#login-alert{{ $item->product_id }}").fadeIn();

                });
                $("#login-alert{{ $item->product_id }} .close{{ $item->product_id }}").click(function() {
                    $("#login-alert{{ $item->product_id }}").hide();
                });


                $('#cart2{{ $item->product_id }}').click(function() {
                    var product_id = $('#product_id{{ $item->product_id }}').val();
                    var price = $('#price{{ $item->product_id }}').text();
                    var moq = $('#no_of_products{{ $item->product_id }}').val();
                    // alert(price);return;
                    jQuery.ajax({
                        url: '{{ url('cart/add') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            product_id: product_id,
                            moq: moq,
                            price: price
                        },
                        success: function(response) {
                            // $('#add_to_cart_modal1{{ $item->product_id }}').modal('show');
                            alert('Successfully added to your Cart');
                            location.reload();
                        }
                    });
                });

            });
        </script>
    @endforeach

    @include('users.footer')

</body>

</html>
