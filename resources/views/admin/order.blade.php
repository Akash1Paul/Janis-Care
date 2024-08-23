@include('admin.header')

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <div class="main-content">
            @yield('header')
            @yield('topnav')

            @if ($layout == 0)
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13">Orders</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">

                                            <h4 class="card-title">Orders</h4>
                                            <div class="fields d-flex">
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" id="search"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="mx-2">
                                                    <select class="form-control mb-3" id="status">
                                                        <option value="" selected disabled>Select Status</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Dispatched">Dispatched</option>
                                                        <option value="Delivered">Delivered</option>
                                                        <option value="On-the-Way">On the Way</option>
                                                        <option value="Received">Received</option>
                                                        {{-- <option value="tm-approval">TM Approval</option> --}}
                                                    </select>
                                                </div>
                                                <div class="mx-2">
                                                    <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                </div>
                                                <div class="mr-1">
                                                    <a href="{{ url('admin/carts') }}"><button type="button" class="btn btn-primary waves-effect waves-light"> Add Order</button></a>
                                                </div>                                       
                                            </div>
                                           
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Order Date</th>
                                                        <th>Delivery Date</th>

                                                        <th>Customer</th>
                                                     
                                                        <th>Delivery Address</th>
                                                        <th>Days Lapsed</th>
                                                        <th>All Details</th>
                                                        <th>Invoice</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="filterorders">
                                                    @foreach ($orders as $index => $value)
                                                    <tr >
                                                        <td>{{$index+1}}</td>
                                                        <td>{{ date('d-m-Y',strtotime($value->created_at)) }}</td>
                                                        <td> @if($value['status']== 'Delivered')
                                                            {{date('d-m-Y',strtotime($value['updated_at']))}}
                                                        @else
                                                            -
                                                        @endif</td>
                                                        <td>{{$value->spoc_name}}</td>
                                                      
                                                       <td>{{ $value->delivery_address }}</td>

                                                       @php
                                                       $todayDate = date('d-m-Y');
                                                       $created_Date = date('d-m-Y', strtotime($value->created_at));
                                                       $diff_days = strtotime($todayDate) - strtotime($created_Date);
                                                       $diff_days = floor($diff_days / (60 * 60 * 24)); // Convert the difference to days
                                                       
                                                    //    dd($diff_days);
                                                       @endphp
                                                       
                                                        <td>{{ $diff_days }} {{$diff_days<=1?'Day':'Days'}} </td>
                                                     
                                                   
                                                   
                                                        <td>
                                                            <a
                                                                href="{{ url('admin/orders-details/' . $value->id)}}">
                                                                <button type="button"
                                                                    class="btn btn-primary waves-effect waves-light">
                                                                    <i class="fas fa-eye"></i></button>
                                                            </a>
                                                        </td>
                                                        <td><a
                                                            href="{{ url('admin/invoice/' . $value->id)}}">
                                                            <button type="button"
                                                                class="btn btn-success waves-effect waves-light">
                                                                <i class="fas fa-file-invoice"></i></button>
                                                        </a></td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-outline-success waves-effect waves-light">{{ $value->status }}</button>
                                                        </td>
                                                    </tr>
                                                    
                                                
                                                    @endforeach
                                                </tbody>
                                            </table>
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

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Runner & Vehicle</h5>
                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <div class="fields">
                                            <h6 class="mt-2 mb-2">Select Runner</h6>
                                            <select class="form-control mb-3">
                                                <option disabled selected>Select One</option>
                                                <option>Runner</option>
                                            </select>
                                        </div>
                                        <div class="fields">
                                            <h6 class="mt-4 mb-2">Select Vehicle</h6>
                                            <select class="form-control mb-3">
                                                <option disabled selected>Select One</option>
                                                <option>Bike</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#"><button type="button"
                                            class="btn btn-primary waves-effect waves-light"
                                            data-dismiss="modal">Submit</button></a>
                                    <a href="#"><button type="button"
                                            class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- container-fluid -->
            @elseif($layout == 1)
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Super Admin</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add Orders</h4>
                                        <form action="{{ url('admin/add-orders/') }}" method="POST">
                                           @csrf
                                            <div class="row mt-4">


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Categories</label>
                                                        <select name="categories"  class="form-control">
                                                            <option value="">Select Category</option>
                                                            @foreach ($categories as $item)
                                                                <option value="{{ $item->category_name }}">
                                                                    {{ $item->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span style="color:red"> @error('categories')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Product name</label>
                                                        <select name="product_name" id="showprducts"
                                                            class="form-control">
                                                            <option value="">Select Product</option>
                                                        </select>
                                                    </div>
                                                    <span style="color:red"> @error('product_name')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Product Quantity</label>
                                                        <input type="text" name="no_of_products"
                                                            class="form-control" placeholder="product quantity">
                                                    </div>
                                                    <span style="color:red"> @error('no_of_products')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Phone Number</label>
                                                        <input type="text" name="phone" id="phone"
                                                            class="form-control" placeholder="Enter Number">
                                                    </div>
                                                    <span style="color:red"> @error('phone')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Enter Name" id="name">
                                                    </div>
                                                    <span style="color:red"> @error('name')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Email</label>
                                                        <input type="email" name="email" id="email"
                                                            class="form-control" placeholder="Enter email">
                                                    </div>
                                                    <span style="color:red"> @error('email')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Address</label>
                                                        <input type="text" name="address" id="address"
                                                            class="form-control" placeholder="Enter Address"
                                                            id="address">
                                                    </div>
                                                    <span style="color:red"> @error('address')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Pincode</label>
                                                        <input type="text" name="pincode" class="form-control"
                                                            placeholder="Enter Pincode" id="pincode">
                                                    </div>
                                                    <span style="color:red"> @error('pincode')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">City</label>
                                                        <input type="text" name="city" id="city"
                                                            class="form-control" placeholder="Enter City">
                                                    </div>
                                                    <span style="color:red"> @error('city')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>





                                            </div>


                                            <div class="row mt-md-4 mt-3">
                                                <div class="col-12">
                                                    <div class="btns d-inline-block">
                                                        <a href="#"><button type="submit"
                                                                class="btn btn-primary waves-effect waves-light">Submit</button></a>
                                                    </div>
                                                    <div class="btns d-inline-block">
                                                        <a href="{{ url('admin/orders') }}"><button
                                                                type="button"
                                                                class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <!-- end card-body-->
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                        <!-- end row-->
                    </div>
                    <!--end row-->
                </div>
                <!-- container-fluid -->
            @elseif($layout == 2)
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Super Admin</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add Orders</h4>
                                        <form action="{{ url('admin/add-orders/') }}" method="POST">
                                            <div class="row mt-4">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Product name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Enter Product Name">
                                                    </div>
                                                    <span style="color:red"> @error('name')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Enter Name">
                                                    </div>
                                                    <span style="color:red"> @error('name')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Phone Number</label>
                                                        <input type="text" name="phone" class="form-control"
                                                            placeholder="Enter Number">
                                                    </div>
                                                    <span style="color:red"> @error('phone')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Address</label>
                                                        <input type="text" name="address" class="form-control"
                                                            placeholder="Enter Address">
                                                    </div>
                                                    <span style="color:red"> @error('address')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Pincode</label>
                                                        <input type="text" name="pincode" class="form-control"
                                                            placeholder="Enter Pincode">
                                                    </div>
                                                    <span style="color:red"> @error('pincode')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">City</label>
                                                        <input type="text" name="city" class="form-control"
                                                            placeholder="Enter City">
                                                    </div>
                                                    <span style="color:red"> @error('city')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>


                                            </div>


                                            <div class="row mt-md-4 mt-3">
                                                <div class="col-12">
                                                    <div class="btns d-inline-block">
                                                        <a href="#"><button type="submit"
                                                                class="btn btn-primary waves-effect waves-light">Submit</button></a>
                                                    </div>
                                                    <div class="btns d-inline-block">
                                                        <a href="{{ url('admin/orders') }}"><button
                                                                type="button"
                                                                class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <!-- end card-body-->
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                        <!-- end row-->
                    </div>
                    <!--end row-->
                </div>
            @elseif ($layout == 3)
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-13"><a href="{{url('admin/orders')}}">Orders</a> > Order Details</h4>
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
                                            <h6>Address : {{ $order_details->delivery_address }}</h6>
                                            <h6>City : {{ $order_details->city }}</h6>
                                            <h6>SPOC Name : {{ $order_details->spoc_name }}</h6>
                                            <h6>SPOC Number : {{ $order_details->spoc_number }}</h6>
                                            <h6>TM Name : {{isset($territory['name'])?$territory['name']:"Not Found"}}</h6>

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
                                                    <td>{{ $moq[$index]*$price[$index] }}</td>
<td></td>    
                                                </tr>
                                                 
                                                @endforeach
                                                
                                                <tr style="background-color: aliceblue;">
                                                    <th></th>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    {{-- <td></td> --}}
                                                    <td>Total Amount {{ $order_details->total_price }}</td>
                                                  
                                                </tr>
                                            </tbody>
                                        </table>
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
            <!-- End Page-content -->
            @endif


        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

    </div>




    @if($layout==0)
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        jQuery(document).ready(function() {


            $('#status').change(function() {
                var status = $('#status').val();
               
                jQuery.ajax({
                    url: '{{ url('admin/filter-orders') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        status: status,
                    },
                    success: function(response) {
                      
                        $('#filterorders').html(response.data);
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
        jQuery(document).ready(function() {


            $('#phone').keyup(function() {
                var phone = $('#phone').val();

                jQuery.ajax({
                    url: '{{ url('admin/fetch-user-details') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        phone: phone,
                    },
                    success: function(response) {
                        // Assuming that response is an array and you want to get the first item
                        var user = response[0];

                        // Check if user exists and has an email
                        if (user) {
                            $('#name').val(user.name);
                            $('#email').val(user.email);
                            $('#address').val(user.address);
                            $('#pincode').val(user.pincode);
                            $('#city').val(user.city);
                        } else {
                            // Handle the case where no user with the specified phone number was found
                            $('#email').val('User not found');
                        }
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        //    alert('Error - ' + errorMessage);
                    }
                });
            });
        });
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script>
     $("#search-button").click(function(){
                $.each($("#datatable tbody tr"), function() {

                    if($(this).text().toLowerCase().indexOf($('#search').val().toLowerCase()) === -1)
                        $(this).hide();
                    else
                        $(this).show();                
                });
            });
            function resetFilter() {
        window.location.reload();
      } 
  </script>
@endif



    <!-- END layout-wrapper -->
    @include('admin.footer')

</body>

</html>
