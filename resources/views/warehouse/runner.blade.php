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
                                    <h4 class="mb-0 font-size-13">Runners</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Runners Details</h4>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" id="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                    </div>
                                                    <div class="mx-3">
                                                        <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                    </div>
                                                    <a href="{{url('warehouse/addrunner')}}"><button type="button" class="btn btn-primary waves-effect waves-light ml-3">Add</button></a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="table-responsive mt-4">
                                    @if ($runnerDetails->count() > 0)
                                            <table class="table table-bordered mb-0" id="table">
                                                <thead>
                                                    <tr>
                                                        <th>Empl ID</th>
                                                        <th>Runner Name</th>
                                                        <th>Phone Number</th>
                                                        <th>Email</th>
                                                        <th>Password</th>
                                                        <th>Address</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($runnerDetails as $index => $item)
                                                    <tr>
                                                        <td>{{ $item->empid }}</td>
                                                        <td>{{$item->name}}</td>
                                                        <td>{{$item->phone}}</td>
                                                        <td>{{$item->email}}</td>
                                                        <td>{{$item->showpassword}}</td>
                                                        <td>{{$item->workaddress}}</td>
                                                        <td> @if ($item->status == 'Approved')
                                                            <button type="button" class="btn btn-outline-success waves-effect waves-light">Approved</button>
                                                        @elseif('NotApproved')
                                                        <button type="button" class="btn btn-outline-success waves-effect waves-light">Not Approved</button>
                                                        @elseif('Correction')
                                                        <button type="button" class="btn btn-outline-success waves-effect waves-light">Need Correction</button>
                                                        @endif</td>
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