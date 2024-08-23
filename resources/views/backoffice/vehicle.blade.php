@include('backoffice.header')

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div class="main-content">

                @yield('header')
                @include('backoffice.navbar')             

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
                                            <h4 class="card-title">Vehicle Details</h4>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text"  id="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                    </div>
                                                    <div class="mx-3">
                                                        <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                    </div>
                                                    <a href="{{url('backoffice/addvehicle')}}"><button type="button" class="btn btn-primary waves-effect waves-light ml-3">Add</button></a>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    <form action="{{url('backoffice/vehiclesimport') }}"
                                        method="POST"
                                        enctype="multipart/form-data" class="d-flex mt-4 justify-content-end">
                                      @csrf
                                      <input type="file" name="file"
                                             class="form-control" style="width: 30%">
                                      <br>
                                      <button class="btn btn-success ml-3">
                                            Import
                                         </button>
                                      <a class="btn btn-warning ml-3"
                                         href="{{ url('backoffice/vehiclesexport') }}">
                                                Export
                                        </a>
                                    </form>
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
                                                        <th>Warehouse Email</th>
                                                        <th>Driver Name</th>
                                                        <th>Phone Number</th>
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
                                                        <td>{{$item->warename}}</td>
                                                        <td>{{$item->drivarname}}</td>
                                                        <td>{{$item->drivarnumber}}</td>
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
                </div>
                <!-- End Page-content -->

@include('backoffice.footer')
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