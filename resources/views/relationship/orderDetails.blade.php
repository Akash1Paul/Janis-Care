@include('relationship.header')

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div class="main-content">
                @yield('header')
                @include('relationship.navbar')               

                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13"><a href="{{url('relation/orders')}}">Orders</a> > Order Details</h4>
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
                                                <h6>TM Name : {{$territory['name']}}</h6>
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
                                                        <td></td>
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

                        
                    </div>  <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

@include('relationship.footer')