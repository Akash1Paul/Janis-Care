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
                                    <h4 class="mb-0 font-size-13">List Of Customers</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h4 class="card-title">List Of Customers</h4>
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
                                            <table class="table table-bordered mb-0" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Customer</th>
                                                        <th>City</th>
                                                        <th>Contact</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($customer as $index => $item)
                                                    <tr>
                                                        <td>{{ $index+1 }}</td>
                                                        <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
                                                        <td>{{$item->name}}</td>
                                                        <td>{{$item->city}}</td>
                                                        <td>+91-{{$item->phone}}</td>
                                                        <td> @if($item->status == 'Approved')
                                                            <button type="button" class="btn btn-outline-success waves-effect waves-light">Approved</button>
                                                        @elseif($item->status == 'NotApproved')
                                                            <button type="button" class="btn btn-outline-danger waves-effect waves-light">Not Approved</button>
                                                        @elseif($item->status == 'Correction')
                                                            <button type="button" class="btn btn-outline-danger waves-effect waves-light">Need Correction</button>
                                                        @endif</td>
                                                    </tr>
                                                    @endforeach
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

@include('relationship.footer')
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