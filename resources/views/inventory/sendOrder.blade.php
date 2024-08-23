@include('inventory.header')

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div class="main-content">

                @yield('header')
                @include('inventory.navbar')              

                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Inventory</h4>
                                </div>
                            </div>


                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Send Order</h4>
                                        <form>
                                            <div class="row mt-4">
                                                <div class="col-md-6 form-group">
                                                    <label>Departure Center Name</label>
                                                    <input type="text" id="Departure" class="form-control" placeholder="Enter Departure Center Name">
                                                </div>
    
                                                <div class="col-md-6 form-group">
                                                    <label>Product Name</label>
                                                    <input type="text" id="Product" class="form-control" placeholder="Enter Product Name">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Quantity</label>
                                                    <input type="text" id="Quantity" class="form-control" placeholder="Enter Quantity">
                                                </div>
                                            </div>
                                            
                                                      
                                          <div class="row mt-md-4 mt-3">
                                            <div class="col-12">
                                               <div class="btns d-inline-block">
                                                   <a href="#"><button type="button" class="btn btn-primary waves-effect waves-light">Submit</button></a>
                                               </div>
                                               <div class="btns d-inline-block">
                                                   <a href="#"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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

                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
@include('inventory.footer')