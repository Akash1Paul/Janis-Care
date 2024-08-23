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
                                    <h4 class="mb-0 font-size-13">Correction</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                                     <!--yet to be approved-->
                                     <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <h4 class="card-title">Yet To Be Approved</h4>
                                                        <div>
                                                            <div class="input-group">
                                                                <input type="text" id="search"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered mb-0"
                                                        id="datatable"
                                                        >
                                                            <thead>
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Date</th>
                                                                    <th>From</th>
                                                                    <th>Customer</th>
                                                                    <th>Email</th>
                                                                    <th>Type Of Approval</th>
                                                                    <th>All Details</th>
                                                                    <th>Stage</th>
                                                                    <th>Created At</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
            
                                                                @isset($customers)
                                                                @foreach ($customers as $key => $item)
                                                             
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td>{{ date('d-m-Y',strtotime($item->created_at))}}</td>
                                                                    <td>Back Office</td>
                                                                    <td>{{ $item->company_name }}</td>
                                                                    <td>{{  $item->email }}</td>
                                                                    <td>New Customer</td>
                                                                    <td>
                                                                        <a href="{{url('territory/customerapproval/'.$item->email)}}">
                                                                            <button type="button" class="btn btn-primary waves-effect waves-light"> <i class="fas fa-eye"></i></button>
                                                                        </a>
                                                                    </td>
                                                                    <td>First Time</td>
                                                                    <td>{{ $days[$key] }} days ago</td>
                                                                    <td>
                                                                        @if ($item->status == 'NotApproved')
                                                                        <button type="button" class="btn btn-outline-danger waves-effect waves-light">Yet To Be Approved</button>
                                                                  
                                                                    @elseif($item->status == 'Correction')
                                                                        <button type="button" class="btn btn-outline-danger waves-effect waves-light">Need Correction</button>
                                                                    @endif
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
                                    </div>
                                    <!-- end row-->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h4 class="card-title">Approved</h4>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" id="search2"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="search-button2"><i class="mdi mdi-magnify"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0"  id="datatable2">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Date</th>
                                                        <th>From</th>
                                                        <th>Customer</th>
                                                        <th>Address</th>
                                                        <th>Type Of Approval</th>
                                                        <th>All Details</th>
                                                        <th>Stage</th>
                                                        <th>Created At</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @isset($approvedcustomers)
                                                    @foreach ($approvedcustomers as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($item->created_at))}}</td>
                                                        <td>Back Office</td>
                                                        <td>{{ $item->spoc_name }}</td>
                                                        <td>{{  $item->delivery_address }}</td>
                                                        <td>New Customer</td>
                                                        <td>
                                                            <a href="{{url('territory/customerapproval/'.$item->email)}}">
                                                                <button type="button" class="btn btn-primary waves-effect waves-light"> <i class="fas fa-eye"></i></button>
                                                            </a>
                                                        </td>
                                                        <td>First Time</td>
                                                        <td>{{ $appdays[$key] }} days ago</td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-success waves-effect waves-light">Approved</button>
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
                        </div>
                        <!-- end row-->
        

                        </div>
                        <!--end row-->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
@include('territory.footer')
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
                </script>  
                <script>
                    $("#search-button2").click(function(){
                               $.each($("#datatable2 tbody tr"), function() {
                 
                                   if($(this).text().toLowerCase().indexOf($('#search2').val().toLowerCase()) === -1)
                                       $(this).hide();
                                   else
                                       $(this).show();                
                               });
                           }); 
                 </script>  