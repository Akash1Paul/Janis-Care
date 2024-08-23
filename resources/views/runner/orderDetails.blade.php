@include('runner.header')

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div class="main-content">

                @yield('header')
                @include('runner.navbar')              

                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13"><a href="{{url('runner/order')}}">Orders</a> > Order Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="mb-3">
                                                <h3 class="mb-3">Order Details</h3>
                                                <h5>Customer : {{ $order_details->outlet_name }}</h5>
                                                <h6>Address : {{ $order_details->address }}</h6>
                                                <h6>City : {{ $order_details->city }}</h6>
                                                <h6>SPOC Name : {{ $order_details->spoc_name }}</h6>
                                                <h6>SPOC Number : {{ $order_details->spoc_number }}</h6>
                                                {{-- <h6>TM Name : {{$territory['name']}}</h6> --}}
                                                {{-- <h4 class="mt-3">Warehouse Id : 545</h4> --}}
                                            </div>
                                            
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product Name</th>
                                                        <th>Category</th>
                                                        <th>MOQ</th>
                                                        <th>Price</th>
                
                                                        <th>Sub-total</th>
                                                       <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
    
                                                    @php
                                                        
                                                        $products=explode(',',$order_details->product_id);
                                                        $moq=explode(',',$order_details->moq);
                                                        $price=explode(',',$order_details->price);
    
                                                    @endphp
    
                                                    @foreach ($products as $index=> $item)
                                                    <tr>
                                                        <td>{{ $index+1 }}</td>
                                                        <td>{{ $product_details->product_name }}</td>
                                                        <td>{{ $product_details->categories }}</td>
                                                     
                                         
                                                        <td>{{ $moq[$index] }}</td>
                                                        <td>{{ $price[$index] }}</td>
                                                        {{-- <td>{{ $moq[$index]*$price[$index] }}</td> --}}
                                            <td></td>
                                                    </tr>
                                                     
                                                    @endforeach
                                                    
                                                    <tr style="background-color: aliceblue;">
                                                        <th></th>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>Total Amount {{ $order_details->total_price }}</td>
                                                      
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        {{-- <div class="col-md-6 mt-5">
                                            <div class="form-group">
                                              
                                                    <input type="text" value="{{ $order_details->order_id }}" id="order_id" hidden>
                                              
                                                <label>Status</label>
                                                <div>                                       
                                                    <select class="form-control mb-3" id="status">
                                                        <option disabled selected>Select One</option>
                                                        <option value="Delivered">Delivered</option>
                                                    </select>
                                                </div>    
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Enter OTP</label>
                                                <input type="text" class="form-control" placeholder="Enter OTP"  id="verificationCode">
                                            </div>
                                          </div>
                                          
                                          <div class="row px-3 mt-4">
                                             <div class="col-12">
                                                <div class="btns d-inline-block">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light"  onclick="verify()">Submit</button>
                                                </div>
                                                <div class="btns d-inline-block">
                                                    <a href="{{url('runner/order')}}"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                                </div>
                                             </div>
                                          </div>
     --}}
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

@include('runner.footer')
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
     function verify() {
        var code = document.getElementById('verificationCode').value;
        var order_id = $('#order_id').val();
        var status = $('#status').val();
        console.log(code);
                            jQuery.ajax({
                                url: '{{ url('runner/changestatus') }}',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    order_id: order_id,
                                    status: status,     
                                },
                            });
        // retrieve verificationId from URL query parameters
        // var urlParams = new URLSearchParams(window.location.search);
        // var verificationId = urlParams.get('verificationId');

        var verificationId = sessionStorage.getItem('verificationId');

        firebase.auth().signInWithCredential(firebase.auth.PhoneAuthProvider.credential(verificationId, code))
            .then(function(result) {
                alert("Phone number verified");
                window.location.reload();
               
                // var myButton = document.getElementById("reg");
                // myButton.disabled = false;
                var input = document.getElementById("number");

                input.readOnly = true;
                var user = result.user;
                console.log(user);
            }).then(function() {
                // remove the 'verificationId' session variable
                sessionStorage.removeItem('verificationId');
               

            }).catch(function(error) {
                alert(error.message);
            });
    }
</script>