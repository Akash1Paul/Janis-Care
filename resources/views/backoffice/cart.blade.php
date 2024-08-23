@include('backoffice.header')

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <div class="main-content">
            @yield('header')
            @include('backoffice.navbar')


            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18"> Backoffice</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->



                    <div class="row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title">Cart</h4>
                                    </div>
                                    @if (count($carts) > 0)
                                        <table class="table" id="cart">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Image</th>
                                                    <th scope="col"
                                                        style="
                                            width: 185px;
                                        ">
                                                        Product Name</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col"
                                                        style="
                                            width: 193px;
                                        ">
                                                        QTY</th>
                                                    <th scope="col"
                                                        style="
                                            /* width: 100px; */
                                        ">
                                                        Amount</th>
                                                    <th scope="col">Remove</th>
                                                </tr>
                                            </thead>

                                            @php
                                                $total = 0;
                                            @endphp
                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                            <tbody>

                                                @foreach ($carts as $index => $item)
                                                    <tr id="hide{{ $item->product_id }}">

                                                        <input type="hidden" class="product_ids"
                                                            id="deleteid{{ $item->product_id }}"
                                                            value="{{ $item->product_id }}">

                                                        <input type="hidden"  value="{{ $item->price  }}">

                                                        <td scope="row"> <a href="#"><img
                                                                    src="{{ url('image/' . $item->image) }}"
                                                                    alt="#" style="height:40px; width:40px;"></a>
                                                            </th>
                                                        <td>
                                                            {{ $item->product_name }}
                                                        </td>
                                                        <td data-price="{{ $item->jsp }}">
                                                            {{ $item->jsp }}
                                                        </td>

                                                        <td style="width: 120px;">
                                                            <div class="cart-plus-minus">
                                                                <span class="minus">-</span>
                                                                <input type="text"
                                                                    value="{{ $item->min_order_quantity }}"
                                                                    name="qtybutton" class="cart-plus-minus-box moqs">
                                                                <span class="plus">+</span>
                                                            </div>
                                                        </td>
                                                        <td class="cart-product-subtotal">
                                                            {{ $item->jsp * $item->min_order_quantity }}.00
                                                        </td>
                                                        @php
                                                        $total += $item->jsp * $item->min_order_quantity; @endphp
                                                        <td class="cart-product-remove"
                                                            id="deletecart{{ $item->product_id }}">x</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <table class="table" id="discountscarts" style="display: none">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Image</th>
                                                    <th scope="col"
                                                        style="
                                            width: 185px;
                                        ">
                                                        Product Name</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col"
                                                        style="
                                            width: 193px;
                                        ">
                                                        QTY</th>
                                                    <th scope="col"
                                                        style="
                                            /* width: 100px; */
                                        ">
                                                        Amount</th>
                                                    <th scope="col">Remove</th>
                                                </tr>
                                            </thead>

                                            {{-- @php
                                            $total = 0;
                                        @endphp --}}

                                            <tbody id="carts-details"></tbody>

                                        </table>



                                        <div class="liton__shoping-cart-area mb-120">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="shoping-cart-inner">
                                                            <div class="shoping-cart-table table-responsive">


                                                            </div>
                                                            <div class="form-row">

                                                                <input type="hidden" name="roles" value="customer">

                                                                <div class="col-md-4 mb-3">
                                                                    <label for="validationCustom01">Select Customer
                                                                        <span style="color: red">*</span></label>
                                                                    <select name="customer" class="form-control select2"
                                                                        id="customers">
                                                                        <option value="" disabled selected>Select
                                                                            Customer</option>
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
                                                                    <select name="outlet" class="form-control select"
                                                                        id="outlets">
                                                                        <option value="">Select outlet</option>

                                                                    </select>
                                                                    <br>

                                                                </div>
                                                                {{-- <div class="col-md-4 mb-3">
                                                                <label for="validationCustom01"><span
                                                                        style="color: red"></span></label>
                                            
                                                            </div> --}}

                                                                <input type="hidden" class="form-control"
                                                                    id="gst" placeholder="GST Number">
                                                                <br>
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="validationCustom01">Phone<span
                                                                            style="color: red">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        id="phone" placeholder="Phone">
                                                                    <br>

                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="validationCustom01">Delivery
                                                                        Address<span
                                                                            style="color: red">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Delivey Address"
                                                                        id="delivery_address">
                                                                    <br>

                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="validationCustom01">Billing
                                                                        Address<span
                                                                            style="color: red">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Billing Address"
                                                                        id="billing_address">
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
                                                                    <label for="validationCustom01">Outlet Spoc
                                                                        Number<span style="color: red">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Outlet Spoc number"
                                                                        id="outlet_spoc_number">
                                                                    <br>

                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="validationCustom01">Relationship
                                                                        Manager<span
                                                                            style="color: red">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Relationship Manager"
                                                                        id="relationship_manager">
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
                                                                    <label for="">Pincode <span
                                                                            style="color: red">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        id="pincode" placeholder="Pincode">
                                                                </div>


                                                                <input type="hidden" id="credit_period">

                                                            </div>

                                                            <div class="shoping-cart-total mt-50">
                                                                <p id="errors" class="text-center"
                                                                    style="color: red">
                                                                </p>
                                                                <h4>Cart Totals</h4>

                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Subtotal</td>
                                                                            <td><strong
                                                                                    id="sub_total">{{ $total }}</strong>
                                                                            </td>
                                                                            <br>

                                                                            <td>Delivery Charge</td>
                                                                            <td><strong
                                                                                    id="deliveryCharge">{{ $total < 1000 ? 150 : 0 }}</strong>
                                                                            </td>


                                                                            <td><strong>Total</strong></td>
                                                                            <td><strong
                                                                                    id="order-total">{{ $total < 1000 ? $total + 150 : $total }}</strong>

                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                                <div class="btn-wrapper text-right">
                                                                    <button id="order"
                                                                        class="checkout-button btn btn-success">Proceed
                                                                        to
                                                                        checkout</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @else
                                        <p>Please Add Item from <a
                                                href="{{ url('backoffice/products') }}">Products</a></p>
                                    @endif
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card -->
                        </div>
                    </div>

                </div>
                <!--end row-->

            </div>
            <!-- container-fluid -->
        </div>

        <!-- End Page-content -->


        <script>
            $(document).ready(function() {
                $('#customers').change(function() {

                    const customer = $('#customers').val();
                    jQuery.ajax({
                        url: '{{ url('backoffice/get-outlets') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            customer: customer,
                        },

                        success: function(response) {

                            $('#outlets').html(response.data);

                            if (response.html != '') {
                                $('#carts-details').html(response.html);
                                $('#cart').hide();
                                $('#discountscarts').show();
                                $('#deliveryCharge').text(response.delivery_charge);

                            }
                            if (response.total != '') {
                                $('#order-total').html(response.total);
                            }
                        }

                    });
                });


                $('#outlets').change(function() {

                    const outlet = $('#outlets').val();
                    const customer = $('#customers').val();
                    jQuery.ajax({
                        url: '{{ url('backoffice/get-outlets') }}',
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


                $('#order').click(function() {
                    var status = 'Received';
                    var customer_email = $('#customers').val();
                    var outlet_name = $('#outlets').val();
                    var relationship_manager = $('#relationship_manager').val();
                    var city = $('#city').val();
                    var state = $('#state').val();
                    var phone = $('#phone').val();
                    var delivery_address = $('#delivery_address').val();
                    var billing_address = $('#billing_address').val();
                    var status = $('#status').val();
                    var spoc_number = $('#outlet_spoc_number').val();
                    var spoc_name = $('#outlet_spoc').val();
                    var totalprice = $('#order-total').text();
                    var pincode = $('#pincode').val();
                    var gst = $('#gst').val();
                    //alert(gst );return;
                    var product_ids = []; // Array to store product IDs
                    var prices = []; // Array to store prices
                    var moqs = []; // Array to store MOQs
                    var mrp = []; // Array to store MRP
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
                    $('.mrp').each(function() {
                        mrp.push($(this).val()); // Add MRP to the array
                    });


                    jQuery.ajax({
                        url: '{{ url('backoffice/create-orders') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {

                            outlet_name: outlet_name,
                            customer_email: customer_email,
                            relationship_manager: relationship_manager,
                            spoc_name: spoc_name,
                            spoc_number: spoc_number,
                            city: city,
                            delivery_address: delivery_address,
                            billing_address: billing_address,
                            status: status,
                            state: state,
                            phone: '+91' + phone,
                            product_id: product_ids, // Send the product IDs as an array
                            price: prices, // Send the prices as an array
                            moq: moqs, // Send the MOQs as an array
                            totalprice: totalprice,
                            pincode: pincode,
                            gst: gst,
                            mrp:mrp,
                        },
                        success: function(response) {
                            if (response.url) {
                                window.location.href = response.url;
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


            });
        </script>
        <script>
            $(document).ready(function() {
                var total = 0;
                $('.cart-plus-minus').each(function() {
                    var $input = $(this).find('.cart-plus-minus-box');
                    var $plus = $(this).find('.plus');
                    var $minus = $(this).find('.minus');
                    var $subtotal = $(this).closest('tr').find('.cart-product-subtotal');
                    var moq = parseInt($input.data('moq'), 10); // Retrieve moq from data attribute

                    function updateSubtotal() {
                        var currentValue = parseInt($input.val(), 10);

                        if (isNaN(currentValue) || currentValue < moq) {
                            currentValue = moq; // Set to minimum if NaN or less than moq
                        }

                        var price = parseFloat($input.closest('tr').find('td[data-price]').data('price'));
                        var subtotal = price * currentValue;
                        $subtotal.text(subtotal.toFixed(2));

                        // Calculate the total by iterating through all subtotals
                        total = 0;
                        $('.cart-product-subtotal').each(function() {
                            var subtotalValue = parseFloat($(this).text());
                            total += subtotalValue;
                        });

                        // Update the String Total with the total value
                        $('#sub_total').text(total.toFixed(2));

                        if (total < 1000) {
                            total = (total + 150).toFixed(2);
                            $('#deliveryCharge').text(150);
                            $('#order-total').text(total);
                        } else {
                            $('#deliveryCharge').text(0);
                            $('#order-total').text(total.toFixed(2));
                        }

                    }

                    $plus.click(function() {
                        var currentValue = parseInt($input.val(), 10);
                        $input.val(currentValue + 1);
                        updateSubtotal();
                    });

                    $minus.click(function() {
                        var currentValue = parseInt($input.val(), 10);
                        // if (currentValue > moq) {
                        $input.val(currentValue - 1);
                        updateSubtotal();
                        // } else {
                        //     alert('Warning! You Have To Cart Minimum ' + moq + ' Items');
                        // }
                    });

                    $input.on('input', updateSubtotal);
                });
            });
        </script>

        <script>
            function deleteProduct(productId) {

                $('#hide' + productId).hide();
                var id = productId;

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
                        $('#carts').html(response.total_carts);
                        location.reload();
                    }
                });
            }

            function changeMoq(productId) {
                $(document).ready(function() {
                    var total = 0;

                    var container = $('.cart-plus-minus' + productId);
                    var $input = container.find('.cart-plus-minus-box' + productId);
                    var $plus = container.find('.plus' + productId);
                    var $minus = container.find('.minus' + productId);
                    var $subtotal = container.closest('tr').find('.cart-product-subtotal' + productId);
                    var moq = parseFloat($('.moq' + productId).val());
                    var price = parseFloat($('.price' + productId).val());

                    console.log('moq:', moq); // Debugging statement for moq
                    console.log('price:', price); // Debugging statement for price

                    function updateSubtotal() {
                        var currentValue = parseInt($input.val(), 10);
                        currentValue = isNaN(currentValue) || currentValue < moq ? moq : currentValue;

                        var subtotal = price * currentValue;
                        console.log(subtotal);
                        $subtotal.text(subtotal.toFixed(2));

                        updateTotal(); // Call updateTotal to recalculate the total
                    }

                    function updateTotal() {
                        var subtotalValue = parseFloat($subtotal.text());
                        total = subtotalValue;

                        $('#sub_total').text(total.toFixed(2));

                        if (total < 1000) {
                            total = (total + 150).toFixed(2);
                            $('#deliveryCharge').text(150);
                        } else {
                            $('#deliveryCharge').text(0);
                        }

                        $('#order-total').text(total);
                    }

                    // Call updateSubtotal to initialize subtotal when the page loads
                    updateSubtotal();

                    $plus.click(function() {
                        var currentValue = parseInt($input.val(), 10);
                        $input.val(currentValue + 1);
                        updateSubtotal();
                    });

                    $minus.click(function() {
                        var currentValue = parseInt($input.val(), 10);

                        $input.val(currentValue - 1);
                        updateSubtotal();

                    });

                    $input.on('input', updateSubtotal);
                });
            }
        </script>

        {{-- delete-cart --}}
        @foreach ($carts as $item)
            <script>
                $(document).ready(function() {

                    $('#deletecart{{ $item->product_id }}').click(function() {
                        $('#hide{{ $item->product_id }}').hide();
                        var id = $('#deleteid{{ $item->product_id }}').val();

                        jQuery.ajax({
                            url: '{{ url('backoffice/delete-carts') }}',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                $('#carts').html(response.total_carts);
                                location.reload();
                            }
                        });
                    });
                });
            </script>
        @endforeach

        @include('backoffice.footer')

    </div>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $('.select2').select2();
        $('.select').select2();
    </script>
</body>

</html>
