@include('admin.header')

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
                                    <h4 class="mb-0 font-size-13">Orders > Order Details</h4>
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
                                                <h5>Customer : John</h5>
                                                <h6>Address : Hutton Road</h6>
                                                <h6>City : Asansol</h6>
                                                <h6>SPOC Name : xyz</h6>
                                                <h6>SPOC Number : +914554545</h6>
                                                <h6>TM Name : Akash</h6>
                                                <h4 class="mt-3">Warehouse Id : 545</h4>

                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>SL NO</th>
                                                        <th>Product Name</th>
                                                        <th>Category</th>
                                                        <th>Product Quantity</th>
                                                        <th>MOQ</th>
                                                        <th>Single Price</th>
                                                        <th>Total Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>1</th>
                                                        <td>Mask</td>
                                                        <td>Normal Mask</td>
                                                        <td>799</td>
                                                        <td>500</td>
                                                        <td>12</td>
                                                        <td>2000</td>
                                                    </tr>
                                                    <tr>
                                                        <th>2</th>
                                                        <td>Mask</td>
                                                        <td>Sugical Mask</td>
                                                        <td>799</td>
                                                        <td>500</td>
                                                        <td>12</td>
                                                        <td>2000</td>
                                                    </tr>
                                                    <tr>
                                                        <th>3</th>
                                                        <td>Mask</td>
                                                        <td>Normal Mask</td>
                                                        <td>799</td>
                                                        <td>500</td>
                                                        <td>12</td>
                                                        <td>2000</td>
                                                    </tr>
                                                    <tr style="background-color: aliceblue;">
                                                        <th></th>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>Total Amount</td>
                                                        <td>6000</td>
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

                @include('admin.footer')
    </body>

</html>