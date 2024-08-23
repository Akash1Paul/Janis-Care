@include('users.header')
<style>
    .nice-select {
        width: 370px;
        height: 65px;
        border: rgb(224, 231, 244) solid;
        border-radius: 0;
    }
</style>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <div class="main-content">

            @yield('header')
            @yield('topnav')

            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="mb-0 font-size-18 text-center">Checkout</h4>
                                    </div>
                                    <div class="liton__shoping-cart-area mb-120">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="shoping-cart-inner">
                                                        <div class="shoping-cart-table table-responsive">
                                                            <table class="table">
                                                                 <thead>
                                                                        <th style="width:16%">Image</th>
                                                                        <th class="cart-product-image" style="width:16%">Product</th>
                                                                        <th style="width:20%" class="cart-product-info">Price</th>
                                                                        <th style="width:35%">MOQ</th>
                                                                        <th style="width:46%" class="cart-product-price">Subtotal</th>
                                                                      

                                                                    </thead>
                                                                <tbody>
                                                                    @php
                                                                        $total = 0;
                                                                    @endphp

                                                                    @foreach ($carts as $key => $item)
                                                                        <tr id="hide{{ $item->product_id }}">

                                                                            <input type="hidden" class="product_id"
                                                                                id="deleteid{{ $productId[$key]->product_id }}"
                                                                                value="{{ $productId[$key]->product_id }}">

                                                                            
                                                                            <td class="cart-product-image">
                                                                                <a href="#"><img
                                                                                        src="{{ url('image/' . $item->image) }}"
                                                                                        alt="#" width="40px"></a>
                                                                            </td>
                                                                            <td class="cart-product-info">
                                                                                <h4><a
                                                                                        href="#">{{ $item->product_name }}</a>
                                                                                </h4>
                                                                            </td>
                                                                            <td class="cart-product-price"
                                                                                data-price="{{$item->cart_price }}">
                                                                                {{$item->cart_price }}
                                                                            </td>
                                                                            <input type="hidden" class="price"
                                                                                value="{{$item->cart_price }}">
                                                                            <td class="cart-product-quantity">


                                                                                <input type="text"
                                                                                    value="{{ $item->quantity}}"
                                                                                    name="qtybutton" readonly
                                                                                    class="cart-plus-minus-box moq">


                                                                            </td>
                                                                            <td class="cart-product-subtotal">
                                                                                {{ ($item->price) * ($item->quantity)}}
                                                                            </td>
                                                                            @php
                                                                                $total +=$item->cart_price*$item->quantity;
                                                                            @endphp
                                                                            
                                                                        </tr>
                                                                    @endforeach

                                                                    <tr class="cart-coupon-row">
                                                                        <td colspan="6">
                                                                            <div class="cart-coupon">
                                                                                <input type="text" name="cart-coupon"
                                                                                    placeholder="Coupon code">
                                                                                <button type="submit"
                                                                                    class="btn theme-btn-2 btn-effect-2 p-3">Apply
                                                                                    Coupon</button>
                                                                            </div>
                                                                        </td>

                                                                </tbody>
                                                            </table>
                                                        </div>


                                                        <div class="row mt-5">
                                                            <input type="hidden" name="roles"
                                                                value="{{ $customers->email }}" id="customers">

                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Customer <span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $customers->company_name }}">
                                                                <br>

                                                                @php
                                                                    $outlet_name = explode(',', $customers->outlet_name);
                                                                @endphp
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Outlet<span
                                                                        style="color: red">*</span></label>
                                                                <br>
                                                                <select name="outlet" class="nice-select"
                                                                    id="outlets" style="width: 400px">
                                                                    <option value="">Select Outlet</option>
                                                                    @foreach ($outlet_name as $item)
                                                                        <option value="{{ $item }}">
                                                                            {{ $item }}</option>
                                                                    @endforeach


                                                                </select>

                                                                <br>

                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Relationship
                                                                    Manager<span style="color: red">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Relationship Manager"
                                                                    id="relationship_manager"
                                                                    value="{{ $customers->relationship_manager }}">
                                                                <br>

                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Billing 
                                                                    Address<span style="color: red">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Billing Address"
                                                                    id="billing_address"
                                                                   >
                                                                <br>

                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Delivery 
                                                                    Address<span style="color: red">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Delivery Address"
                                                                    id="delivery_address"
                                                                    >
                                                                <br>

                                                            </div>

                                                            
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">phone<span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="phone" placeholder="Phone">
                                                                <br>

                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Address<span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Address" id="address">
                                                                <br>

                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Outlet Spoc<span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Outlet Spoc" id="outlet_spoc">
                                                                <br>
                                                            </div>

                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Outlet Spoc Number<span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Outlet Spoc number"
                                                                    id="outlet_spoc_number">
                                                                <br>
                                                            </div>
                                                            
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">City<span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="city" placeholder="City">
                                                                <br>

                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Pincode<span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="pincode" placeholder="Pincode">
                                                                <br>

                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">GST<span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="gst" placeholder="GST">
                                                                <br>

                                                            </div>
                                                        </div>


                                                        <div class="shoping-cart-total mt-50">
                                                            <h4>Cart Totals</h4>
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td><strong> Total</strong></td>
                                                                        <td><strong
                                                                                id="order-total">{{ $total }}</strong>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                            <span style="color: red" id="errors"></span>
                                                            <div class="btn-wrapper text-right">

                                                                <button id="order-status"
                                                                    class="mt-5 checkout-button btn btn-success">Proceed
                                                                    to checkout</button>

                                                                <button id="order" style="display: none"
                                                                    class="mt-5 checkout-button btn btn-success">Pay
                                                                    Now</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end row-->
                </div>
                <!--end row-->

            </div> <!-- container-fluid -->
        </div>


        @include('users.stripe')
        <!-- End Page-content -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <script>
            $(document).ready(function() {
                // Initialize the total to 0
                var total = 0;

                $('.cart-plus-minus').each(function() {
                    var $input = $(this).find('.cart-plus-minus-box');
                    var $plus = $(this).find('.inc');
                    var $minus = $(this).find('.dec');
                    var $subtotal = $(this).closest('tr').find('.cart-product-subtotal');

                    function updateSubtotal() {
                        var currentValue = parseInt($input.val(), 10);
                        var price = parseFloat($input.closest('tr').find('.cart-product-price').data('price'));
                        var subtotal = price * currentValue;
                        $subtotal.text(subtotal.toFixed(2));

                        // Calculate the total by iterating through all subtotals
                        total = 0;
                        $('.cart-product-subtotal').each(function() {
                            var subtotalValue = parseFloat($(this).text());
                            total += subtotalValue;
                        });

                        // Update the String Total with the total value
                        $('#order-total').text(total.toFixed(2));
                    }

                    $plus.click(function() {
                        var currentValue = parseInt($input.val(), 10);
                        $input.val(currentValue + 1);
                        updateSubtotal();
                    });

                    $minus.click(function() {
                        var currentValue = parseInt($input.val(), 10);
                        if (currentValue > 1) {
                            $input.val(currentValue - 1);
                            updateSubtotal();
                        }
                    });

                    $input.on('input', updateSubtotal);
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#outlets').change(function() {

                    const outlet = $('#outlets').val();
                    const customer = $('#customers').val();
                    jQuery.ajax({
                        url: '{{ url('users/get-outlets') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {

                            outlet: outlet,
                            customer: customer
                        },
                        success: function(response) {
                            if (response.data != '') {
                                $('#outlets').html(response.data);
                                $('#delivery_address').val(response.delivery_address);
                                $('#billing_address').val(response.billing_address);
                                $('#city').val(response.city);
                                $('#state').val(response.state);
                                $('#outlets').val(response.outlet_name);
                                $('#outlet_spoc').val(response.outlet_spoc);
                                $('#outlet_spoc_number').val(response.outlet_spoc_number);
                                $('#relationship_manager').val(response.relationship_manager);
                                $('#phone').val(response.phone);
                                $('#email').val(response.email);
                                $('#pincode').val(response.pincode);
                                $('#gst').val(response.gst);
                            }
                        }
                    });
                });

            })
        </script>

        <script>
            $(document).ready(function() {
                $('#order-status').click(function() {

                    var product_ids = [];
                    var prices = [];
                    var moqs = [];

                    $('.product_id').each(function() {
                        product_ids.push($(this).val());
                    });

                    $('.price').each(function() {
                        prices.push($(this).val()); // Add price to the array
                    });

                    $('.moq').each(function() {
                        moqs.push($(this).val()); // Add moq to the array
                    });

                    jQuery.ajax({
                        url: '{{ url('users/order-status') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data: {
                            product_id: product_ids, // Send the product IDs as an array
                            price: prices, // Send the prices as an array
                            moq: moqs, // Send the MOQs as an array
                            // totalprice: totalprice,
                            // pincode:pincode
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#order').show();
                                $('#order-status').hide();

                            } else {
                                $('#errors').text(response.error);
                            }

                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                            alert('Error - ' + errorMessage);
                        }
                    });
                });

            })
        </script>


        {{-- <script>
     $(document).ready(function() {
                $('#order').click(function() {
                    var status = 'Received';
                    var customer_name = $('#customers').val();
                    var outlet_name = $('#outlets').val();
                    var relationship_manager = $('#relationship_manager').val();
                    var city = $('#city').val();
                    var state = $('#state').val();
                    var phone = $('#phone').val();
                    var address = $('#address').val();
                    var status = $('#status').val();
                    var spoc_number = $('#outlet_spoc_number').val();
                    var spoc_name = $('#outlet_spoc').val();
                    var totalprice = $('#order-total').text();
                    var pincode = $('#pincode').val();
                    var product_ids = [];
                    var prices = []; 
                    var moqs = []; 
              
                    $('.product_id').each(function() {
                        product_ids.push($(this).val()); 
                    });

                    $('.price').each(function() {
                        prices.push($(this).val()); // Add price to the array
                    });

                    $('.moq').each(function() {
                        moqs.push($(this).val()); // Add moq to the array
                    });

                    jQuery.ajax({
                        url: '{{ url('users/create-orders') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        data: {
                            outlet_name: outlet_name,
                            customer_name: customer_name,
                            relationship_manager: relationship_manager,
                            spoc_name: spoc_name,
                            spoc_number: spoc_number,
                            city: city,
                            address: address,
                            status: status,
                            state: state,
                            phone: phone,
                            product_id: product_ids, // Send the product IDs as an array
                            price: prices, // Send the prices as an array
                            moq: moqs, // Send the MOQs as an array
                            totalprice: totalprice,
                            pincode:pincode
                        },
                        success: function(response) {
                            if(response.url){
                                window.location.href = response.url;
                            }
                           
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                            alert('Error - ' + errorMessage);
                        }
                    });
                });
            })       
</script> --}}







        {{-- delete-cart --}}
        @foreach ($carts as $item)
            <script>
                $(document).ready(function() {
                    $('#deletecart{{ $item->product_id }}').click(function() {
                        $('#hide{{ $item->product_id }}').hide();
                        var id = $('#deleteid{{ $item->product_id }}').val();
                        jQuery.ajax({
                            url: '{{ url('users/delete-carts') }}',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                $('#add_to_cart_modal{{ $item->id }}').modal('show');
                            }
                        });
                    });
                });
            </script>
        @endforeach

        @include('users.footer')
    </div>
    </div>
</body>

</html>
