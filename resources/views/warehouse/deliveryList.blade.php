@include('warehouse.header')

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div class="main-content">

               
                @yield('header')
                @include('warehouse.navbar')                
                       

                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13">Delivered List</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Delivery Details</h4>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" id="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="search-button" type="submit"><i class="mdi mdi-magnify"></i></button>
                                                    </div>
                                                    <div class="mx-3">
                                                        <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive mt-4">
                                            @if($delivery_list->count() > 0)
                                            <table class="table table-bordered mb-0" id="table">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Order Date</th>
                                                        <th>Customer</th>
                                                        <th>Phone Number</th>
                                                        <th>Driver Name</th>
                                                        <th>Runner Name</th>
                                                        <th>Vehicle No</th>
                                                        <th>Delivered Date</th>
                                                        <th>All Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($delivery_list as $item => $value)
                                                    <tr>
                                                        <td>{{$item+1}}</td>
                                                        <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                                                        <td>{{$value->spoc_name}}</td>
                                                        <td>{{$value->phone}}</td>
                                                        <td>{{$vehicles[$item]->drivarname}}</td>
                                                        <td>{{$runner[$item]->name}}</td>
                                                        <td>{{$value->vehicle}}</td>
                                                        <td>{{date('d-m-Y',strtotime($value->updated_at))}}</td>
                                                        <td>
                                                            <a href="{{url('warehouse/delivery-order-details/'.$value->id)}}">
                                                                <button type="button" class="btn btn-primary waves-effect waves-light"> <i class="fas fa-eye"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @else
                                            <div>
                                                <p class="text-danger text-center">Data Not Found</p>
                                            </div>
                                            @endif
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

               
@include('warehouse.footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
   $("#search-button").click(function(){
              $.each($("#table tbody tr"), function() {

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