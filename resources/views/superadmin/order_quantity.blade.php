
@include('supersuperadmin.header')

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div class="main-content">

             @yield('header')

            @yield('topnav')
                <div class="page-content">
                    <div class="container-fluid">
                      @if ($layout==0)
                      @if(session('status'))
                      <div class="alert alert-success fade show">
                          {{ session('status') }}
                      </div>
                      @elseif(session('delete'))
                      <div class="alert alert-danger fade show">
                          {{ session('delete') }}
                      </div>
                   
                  @endif
      
                  <script>
                      // Hide the success message alert after 2 seconds
                      setTimeout(function() {
                          $('.alert').alert('close');
                      }, 2000);
                  </script>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-6">
                <div class="card">
                    <div class="card-body">
                    
                        <div class="d-flex justify-content-between">
                            <a href="{{ url('superadmin/add-order-quantity') }}" style='text-decoration:none;'> <button
                                class="btn btn-primary" >Add Order-quantity</button></a>
                            <form>
                                 <div class="form-input">
                                    <input id="myInput" class='form-control' placeholder="Search...">
                                    <button type="submit" class=" form-control" ><i
                                            class='bx bx-search'></i></button>
                                </div> 
                            </form>
                        </div>
                            
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 mt-4">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order-Quanity </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id='myTable'>
                                    @isset($orderquan)
                                    @foreach ($orderquan as $key => $item)
                                    <tr>
                                        <td class="mt-2 mr-2">{{ $key+1 }}</td>
                                       <td>{{$item->order_quantity }}</td>
                                       
                                      <td>
                                    <a href="{{ url('superadmin/edit-order-quantity/'.$item->id) }}"><button class="btn btn-primary" style="color
                                    :white">Edit</button></a>
                                    <a href="{{ url('superadmin/delete-order-quantity/'.$item->id) }}"><button class="btn btn-primary">Delete</button></a>
                                    </td>
                                    </tr>
                                  @endforeach
                                    @endisset
                                  
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->       
    </div>
                        
                @elseif ($layout==1)
        <!-- start page title -->
        <div class="row">
          <div class="col-12">
              <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0 font-size-18">Add User</h4>

                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                          <li class="breadcrumb-item active">Add User</li>
                      </ol>
                  </div>
                  
              </div>
          </div>
      </div>     
      <!-- end page title -->

      <div class="row">
        <div class="col-xl-11 col-md-11 col-11 mt-5 ml-5">
            <h4 class="card-title"><a href="{{ url('superadmin/order-quantity') }}">Back</a></h4>
            <div class="card">
                <div class="card-body">
                    <h3>Add Order-Quantity</h3>
                   
                    <form action="{{ url('superadmin/add-order-quantity') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                          <div class="col-md-12 mb-3">
                            <label for="validationTooltip01"><b> Order-Quantity</b></label>
                            <input type="number" class="form-control" id="validationTooltip01" name="order_quantity" placeholder="Enter Order quantity"  >
                          </div>
                         </div>
                          <br>
                        <button class="btn btn-primary waves-effect waves-light" type="submit"> Add Order-Quantity</button>
                      </form>
                    
                </div> <!-- end card-body-->
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div> <!-- end row -->
      <!-- end row-->
      @elseif($layout==2)
              <!-- start page title -->
              <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Add User</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Add User</li>
                            </ol>
                        </div>
                        
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">
                    
                <div class="col-xl-11 col-md-11 col-11 mt-5 ml-5">
                  
                    <h4 class="card-title"><a href="{{ url('superadmin/order_quantity') }}">Back</a></h4>
                    <div class="card">

                        <div class="card-body">
                  
                            <h3>Update Order-Quantity</h3>
                            <form action="{{ url('superadmin/edit-order-quantity/' . $data['id']) }}" method="POST"
                    enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                  <div class="col-md-12 mb-3">
                                    <label for="validationTooltip01"><b>Order-quantity</b></label>
                                    <input type="text" name="order_quantity" class="form-control" value="{{ $data['order_quantity'] }}" placeholder="Enter Order Quantity">

                                  </div>
    
                                </div>
                           
                                <br>
                                <button class="btn btn-primary waves-effect waves-light" type="submit"> Update Category</button>
                              </form>
                            
                        </div> <!-- end card-body-->
                    </div> <!-- end card -->
                </div> <!-- end col-->
            </div> <!-- end row -->
      
            <!-- end row-->
                  
                @endif
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->

  @include('supersuperadmin.footer')

    </body>

</html>