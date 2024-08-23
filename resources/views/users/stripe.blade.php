<script>
    $(document).ready(function() {
        $('#order').click(function () {
    var status = 'Received';
    var customer_name = $('#customers').val();
    var outlet_name = $('#outlets').val();
    var relationship_manager = $('#relationship_manager').val();
    var city = $('#city').val();
    var state = $('#state').val();
    var phone = $('#phone').val();
    var delivery_address = $('#delivery_address').val();
    var billing_address = $('#billing_address').val();
    var spoc_number = $('#outlet_spoc_number').val();
    var spoc_name = $('#outlet_spoc').val();
    var totalprice = $('#order-total').text();
    var pincode = $('#pincode').val();
    var gst=$('#gst').val();
    var product_ids = [];
    var prices = [];
    var moqs = [];
    var amount = $('#order-total').text();

    $('.product_id').each(function () {
        product_ids.push($(this).val());
    });

    $('.price').each(function () {
        prices.push($(this).val());
    });

    $('.moq').each(function () {
        moqs.push($(this).val());
    });

    var handler = StripeCheckout.configure({
        key: 'pk_test_51NCWyOEx6x1r8ew5BEtTZIR6oppYb5BUjBnDzBNKsQxJc5Yql5HWukZuzQ299z989bACNXRPTAL3VjyKOVKMLpsL00VDsVO3hx',
        locale: 'auto',
        token: function (token) {
            $.ajax({
                url: '{{ url('users/create-orders') }}',
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    token: token.id,
                    amount: amount,
                    outlet_name: outlet_name,
                    customer_name: customer_name,
                    relationship_manager: relationship_manager,
                    spoc_name: spoc_name,
                    spoc_number: spoc_number,
                    city: city,
                    delivery_address: delivery_address,
                    billing_address:billing_address,
                    status: status,
                    state: state,
                    phone: phone,
                    product_id: product_ids,
                    price: prices,
                    moq: moqs,
                    totalprice: totalprice,
                    gst:gst,
                },
                success: function (response) {
                    if (response.url) {
                        console.log("Status update successful!");
                        window.location.href = response.url;
                    } else if (response.error) {
                        console.error("Status update failed:", response.error);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', xhr.status);
                }
            });
        }
    });

    handler.open({
        description: 'Purchase',
        amount: amount * 100,
        currency: 'INR',
        email: false,
        // shippingAddress: true,
        // billingAddress: true,
        // zipCode: true,
        allowRememberMe: true,
        billingAddressCollection: 'required',
        locale: 'auto',
        verifyZipCode: true,
        billingAddressOptions: {
            format: 'full'
        },
        cvc: true
    });
});

    });

    function handlePaymentStatus(paymentStatus) {
        console.log('Payment status:', paymentStatus);
    }
</script>
