@include('warehouse.header')

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div class="main-content">

                @yield('header')
                @include('warehouse.navbar')                        
                @if ($layout == 0)
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13">Vehicles</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Vehicles Details</h4>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" id="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                    </div>
                                                    {{-- <div class="mx-3">
                                                        <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                    </div> --}}
                                                    <a href="{{url('warehouse/addvehicle')}}"><button type="button" class="btn btn-primary waves-effect waves-light ml-3">Add</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive mt-4">
                                            @if ($vehicles->count() > 0)
                                            <table class="table table-bordered mb-0" id="table">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Vehicle Name</th>
                                                        <th>Vehicle Number</th>
                                                        <th>Vehicle Type</th>
                                                        <th>City</th>
                                                        <th>Driver Name</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($vehicles as $index => $item)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{$item->name}}</td>
                                                        <td>{{$item->number}}</td>
                                                        <td>{{$item->type}}</td>
                                                        <td>{{$item->warecity}}</td>
                                                        <td>{{$item->drivarname}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @else
                                            <div>
                                                <p class="text-danger text-center">No Data Found</p>
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
                    @elseif($layout == 1)
                    <div class="page-content">
                        <div class="container-fluid">
                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0 font-size-13"><a href="{{url('warehouse/vehicle')}}">Vehicles</a> > Add Vehicle</h4>
                                    </div>
                                </div>
    
    
                            </div>     
                            <!-- end page title -->
        
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Add Vehicle</h4>
                                            <form action="{{url('warehouse/addvehicle')}}" method="POST">
                                                @csrf
                                                @foreach ($warehouse as $item)
                                                    <input type="text" name="warecity" id="warecity" value="{{$item->city}}" hidden>
                                                    <input type="text" name="warename" id="warename" value="{{$item->email}}" hidden>
                                                @endforeach
                                                <div class="row mt-4">
                                                    <div class="col-md-4 form-group">
                                                        <label for="name">Vehicle Name</label>
                                                        <input type="text" id="Vehicle" name="name" class="form-control" placeholder="Enter Name">
                                                        @error('name')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                    </div>
        
                                                    <div class="col-md-4 form-group">
                                                        <label for="Address">Vehicle Number</label>
                                                        <input type="text" id="Number" name="number" class="form-control" placeholder="Enter Number">
                                                        @error('number')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                    </div>
        
                                                    <div class="col-md-4 form-group">
                                                        <label for="Address">Vehicle Type</label>
                                                        <input type="text" id="type" name="type" class="form-control" placeholder="Enter Type">
                                                        @error('type')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                    </div>
    
                                                    <div class="col-md-4 form-group">
                                                        <label for="Address">Driver Name</label>
                                                        <input type="text" id="driver" name="drivarname" class="form-control" placeholder="Driver Name">
                                                        @error('drivarname')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="Address">Driver Number</label>
                                                        <input type="text" name="drivarnumber" id="driverNumber" class="form-control" placeholder="Driver Number">
                                                        @error('drivarnumber')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>
                                                
                                                          
                                              <div class="row mt-md-4 mt-3">
                                                <div class="col-12">
                                                   <div class="btns d-inline-block">
                                                       <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                   </div>
                                                   <div class="btns d-inline-block">
                                                       <a href="{{url('backoffice/vehicle')}}"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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
                    @endif
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
