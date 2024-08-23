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
                                    <h4 class="mb-0 font-size-18">Territory Manager</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Received Orders</h4>
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <h3>Customer Details With Product</h3>
                                                <h5 class="mt-3">From Back Office</h5>
                                            </div>
                                                <div class="col-md-6 mb-md-0 mb-4">
                                                    <div class="row mt-5">
                                                        <div class="col-6">
                                                            <div class="details">
                                                                <p>Date:</p>
                                                                <p>Customer Name:</p>
                                                                <p>Address:</p>
                                                                <p>Phone Number:</p>
                                                                <p>Email:</p>
                                                                <p>Product Id:</p>
                                                                <p>Product Name:</p>
                                                                <p>Product Type:</p>
                                                                <p>Quantity:</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="details">
                                                                <p>12-09-2023</p>
                                                                <p>Arman</p>
                                                                <p>Asansol, Dishergarh 713333</p>
                                                                <p>+91-989787997</p>
                                                                <p>abc@gmail.com</p>
                                                                <p>212</p>
                                                                <p>Surgical Mask</p>
                                                                <p>Mask</p>
                                                                <p>20</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="img-box">
                                                        <img src="../assets/images/500-error.svg" alt="" class="img-fluid">
                                                    </div>
                                                </div>
                                          </div>

                                          <div class="col-md-6">
                                            <div class="fields">   
                                                <h6 class="mt-4 mb-2">Select</h6>                                         
                                                <select class="form-control mb-3">
                                                    <option disabled selected>Select One</option>
                                                    <option>Approve</option>
                                                    <option>Not Approve</option>
                                                    <option>Need Correction</option>
                                                </select>
                                            </div>
                                          </div>
                                          
                                          <div class="row px-3 mt-4">
                                             <div class="col-12">
                                                <div class="btns d-inline-block">
                                                    <a href="#"><button type="button" class="btn btn-primary waves-effect waves-light">Submit</button></a>
                                                </div>
                                                <div class="btns d-inline-block">
                                                    <a href="#"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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
@include('territory.footer')