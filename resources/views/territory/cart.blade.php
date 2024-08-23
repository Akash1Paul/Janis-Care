@include('territory.header')

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <div class="main-content">

            @yield('header')
            @include('territory.navbar')          

            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Territory</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title">Cart</h4>
                                    </div>
                                    <div class="liton__shoping-cart-area mb-120">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="shoping-cart-inner">
                                                        <div class="shoping-cart-table table-responsive">
                                                            <table class="table">
                                                                <!-- <thead>
                                                                        <th class="cart-product-remove">Remove</th>
                                                                        <th class="cart-product-image">Image</th>
                                                                        <th class="cart-product-info">Product</th>
                                                                        <th class="cart-product-price">Price</th>
                                                                        <th class="cart-product-quantity">Quantity</th>
                                                                        <th class="cart-product-subtotal">Subtotal</th>
                                                                    </thead> -->
                                                                <tbody>
                                                                    @php
                                                                        $total = 0;
                                                                    @endphp

                                                                    @foreach ($carts as $item)
                                                                        <tr id="hide{{ $item->product_id }}">
                                                                            <input type="hidden" class="product_id"
                                                                                id="deleteid{{ $item->product_id }}"
                                                                                value="{{ $item->product_id }}">
                                                                            <td class="cart-product-remove"
                                                                                id="deletecart{{ $item->product_id }}">x
                                                                            </td>
                                                                            <td class="cart-product-image">
                                                                                <a href="#"><img
                                                                                        src="{{ url('image/' . $item->image) }}"
                                                                                        alt="#"></a>
                                                                            </td>
                                                                            <td class="cart-product-info">
                                                                                <h4><a
                                                                                        href="#">{{ $item->product_name }}</a>
                                                                                </h4>
                                                                            </td>
                                                                            <td class="cart-product-price"
                                                                                data-price="{{ $item->price }}">
                                                                                {{ $item->price }}
                                                                            </td>
                                                                            <input type="hidden" class="price" value="{{ $item->price }}">
                                                                            <td class="cart-product-quantity">
                                                                                <div class="cart-plus-minus">
                                                                                    <span class="minus">-</span>
                                                                                    <input type="text"
                                                                                        value="{{ $item->min_order_quantity }}"
                                                                                        name="qtybutton"
                                                                                        class="cart-plus-minus-box moq">
                                                                                    <span class="plus">+</span>
                                                                                </div>
                                                                            </td>
                                                                            <td class="cart-product-subtotal">
                                                                                {{ $item->price * $item->min_order_quantity }}.00
                                                                            </td>
                                                                            @php
                                                                                $total += $item->price * $item->min_order_quantity;
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
                                                                        <!-- <td>
                                                                                <button type="submit" class="btn theme-btn-2 btn-effect-2-- disabled p-3">Update Cart</button>
                                                                            </td> -->
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="form-row">
                                                            <input type="hidden" name="roles" value="customer">

                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Select Customer <span
                                                                        style="color: red">*</span></label>
                                                                <select name="customer" class="form-control"
                                                                    id="customers">
                                                                    <option value="">Select Customer</option>
                                                                    @foreach ($customers as $item)
                                                                        <option value="{{ $item->email }}">
                                                                            {{ $item->company_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <br>


                                                            </div>


                                                           
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Choose Outlet <span
                                                                        style="color: red">*</span></label>
                                                                <select name="outlet"  class="form-control"
                                                                    id="outlets">
                                                                    <option value="">Select outlet</option>

                                                                </select>
                                                                <br>

                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">phone<span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control" id="phone" placeholder="Phone">
                                                                <br>

                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Address<span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Address" id="address">
                                                                <br>

                                                            </div>
                                                      
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Outlet Spoc<span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Outlet Spoc" id="outlet_spoc">
                                                                <br>

                                                            </div>
                                                                <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Outlet Spoc Number<span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Outlet Spoc number" id="outlet_spoc_number">
                                                                <br>

                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">Relationship Manager<span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Relationship Manager" id="relationship_manager">
                                                                <br>

                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01">City<span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" class="form-control" id="city" placeholder="City">
                                                                <br>

                                                            </div>
                                                        </div>

                                                        <div class="shoping-cart-total mt-50">
                                                            <h4>Cart Totals</h4>
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Cart Subtotal</td>
                                                                        <td>6618.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Shipping and Handing</td>
                                                                        <td>1115.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Vat</td>
                                                                        <td>00.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>String Total</strong></td>
                                                                        <td><strong
                                                                                id="order-total">{{ $total }}</strong>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="btn-wrapper text-right">
                                                                <button id="order"
                                                                    class="checkout-button btn btn-success">Proceed to
                                                                    checkout</button>
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
        <!-- End Page-content -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Initialize the total to 0

                var total = 0;

                $('.cart-plus-minus').each(function() {
                    var $input = $(this).find('.cart-plus-minus-box');
                    var $plus = $(this).find('.plus');
                    var $minus = $(this).find('.minus');
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


                $('#customers').change(function() {

                    const customer = $('#customers').val();
                    jQuery.ajax({
                        url: '{{ url('superadmin/get-outlets') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            customer: customer,


                        },
                        success: function(response) {
                            if (response.data != '') {
                                $('#outlets').html(response.data);
                            }
                        }
                    });
                });

                $('#outlets').change(function() {

                    const outlet = $('#outlets').val();
                    const customer = $('#customers').val();
                    jQuery.ajax({
                        url: '{{ url('superadmin/get-outlets') }}',
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
                                $('#address').val(response.address);
                                $('#city').val(response.city);
                                $('#state').val(response.state);
                                $('#outlets').val(response.outlet_name);
                                $('#outlet_spoc').val(response.outlet_spoc);
                                $('#outlet_spoc_number').val(response.outlet_spoc_number);
                                $('#relationship_manager').val(response.relationship_manager);
                                $('#phone').val(response.phone);
                                $('#email').val(response.email);
                            }
                        }
                    });
                });

                $('#order').click(function() {
                    var status='Received';
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
//    alert(spocnumber);return;
                    var product_ids = []; // Array to store product IDs
                    var prices = []; // Array to store prices
                    var moqs = []; // Array to store MOQs

                    // Loop through the elements with a class like 'product_id', 'price', and 'moq' (assuming they have these classes)
                    $('.product_id').each(function() {
                        product_ids.push($(this).val()); // Add product_id to the array
                    });

                    $('.price').each(function() {
                        prices.push($(this).val()); // Add price to the array
                    });

                    $('.moq').each(function() {
                        moqs.push($(this).val()); // Add moq to the array
                    });

                 
                    jQuery.ajax({
                        url: '{{ url('superadmin/create-orders') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {

                            outlet_name: outlet_name,
                            customer_name:customer_name,
                            relationship_manager:relationship_manager,
                            spoc_name:spoc_name,
                            spoc_number:spoc_number,
                            city: city,
                            address: address,
                            status:status,
                            state: state,
                            phone: phone,
                            product_id: product_ids, // Send the product IDs as an array
                            price: prices, // Send the prices as an array
                            moq: moqs, // Send the MOQs as an array
                            totalprice: totalprice,
                           
                        },
                        success: function(response) {
                            window.location.href = response.url;
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                            alert('Error - ' + errorMessage);
                        }
                    });
                });


            });
        </script>

        {{-- delete-cart --}}
        @foreach ($carts as $item)
            <script>
                $(document).ready(function() {

                    $('#deletecart{{ $item->product_id }}').click(function() {
                        $('#hide{{ $item->product_id }}').hide();
                        var id = $('#deleteid{{ $item->product_id }}').val();

                        jQuery.ajax({
                            url: '{{ url('superadmin/delete-carts') }}',
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




        @include('territory.footer')

    </div>
    </div>
</body>

</html>
