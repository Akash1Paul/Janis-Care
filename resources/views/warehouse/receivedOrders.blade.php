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
                                    <h4 class="mb-0 font-size-13">Received Orders</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Received Orders</h4>
                                            <div class="fields d-flex">
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" id="search"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="mx-2">
                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#exampleModal" id="send">Send Details to runner</button>
                                                </div>                                         
                                                <div>                                       
                                                    <select class="form-control mb-3"  id="status">
                                                        <option value="" disabled selected>Select Status</option>
                                                        <option value="all">All</option>
                                                        <option value="Dispatched">Dispatched</option>
                                                        <option value="Delivered">Delivered</option>
                                                        <option value="On-the-Way">On the Way</option>
                                                        <option value='Pending'>Pending</option>
                                                        <option value="Received">Received</option>
                                                    </select>
                                                </div>
                                                <div class="mx-2">
                                                    <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Order Date</th>
                                                        <th>Delivery Date</th>
                                                        <th>Customer</th>
                                                        <th>RM Email</th>
                                                        <th>Delivery Address</th>
                                                        <th>All Details</th>
                                                        <th>Invoice</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="filterorders">
                                                    @foreach ($orders as $item =>$value)
                                                    <tr>
                                                        <td>{{$item+1}}</td>
                                                        <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                                                        <td> @if($value['status']== 'Delivered')
                                                            {{date('d-m-Y',strtotime($value['updated_at']))}}
                                                        @else
                                                            -
                                                        @endif</td>
                                                        <td>{{$value->spoc_name}}</td>
                                                        <td>{{$value->relationship_manager}}</td>
                                                        <td>{{$value->delivery_address}}</td>
                                                      
                                                        <td>
                                                            <a href="{{ url('warehouse/orders-details/' . $value->id)}}">
                                                                <button type="button" class="btn btn-primary waves-effect waves-light"> <i class="fas fa-eye"></i></button>
                                                            </a>
                                                        </td>
                                                        <td><a
                                                            href="{{ url('warehouse/invoice/' . $value->id)}}">
                                                            <button type="button"
                                                                class="btn btn-success waves-effect waves-light">
                                                                <i class="fas fa-file-invoice"></i></button>
                                                        </a></td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-success waves-effect waves-light">{{ $value->status}}</button>
                                                        </td>
                                                        <th>
                                                            @if($value->status=='Delivered')
                                                            <input type="checkbox" name="check" class="send"  id="orderid" value="{{ $value->order_id }}" disabled>
                                                            @elseif($value->status=='On-the-Way')
                                                            <input type="checkbox" name="check" class="send"  id="orderid" value="{{ $value->order_id }}" disabled>
                                                            @else
                                                            <input type="checkbox" name="check" class="send"  id="orderid" value="{{ $value->order_id }}">
                                                            @endif
                                                        </th>
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

                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Select Runner & Vehicle</h5>
                                            <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <div class="fields">   
                                                    <h6 class="mt-2 mb-2">Select Runner</h6>                                         
                                                    <select class="form-control mb-3" id="runner">
                                                        <option disabled selected>Select One</option>
                                                        @foreach ($runnerDetails as $index => $item)
                                                        <option value="{{$item->email}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="fields">                                             
                                                    <h6 class="mt-4 mb-2">Select Vehicle</h6>                                         
                                                    <select class="form-control mb-3" id="vehicle">
                                                        <option disabled selected>Select One</option>
                                                        @foreach ($vehicles as $index => $item)
                                                        <option value="{{$item->number}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="fields">                                             
                                                    <h6 class="mt-4 mb-2" >Date</h6>                                         
                                                    <input type="date" name="date" id="date" class="form-control">
                                                </div>
                                              </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" id="submit">Submit</button>
                                            <button type="button" class="btn btn-dark waves-effect waves-light" aria-label="Close" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              
                <script>
                    $(document).ready(function() {
               
                        $('#submit').click(function() {
                            var order_id = $('#orderid').val();
                            var runner = $('#runner').val();
                            var vehicle = $('#vehicle').val();
                            var date = $('#date').val();
                            //alert(order_id);
                            jQuery.ajax({
                                url: '{{ url('warehouse/send-to-runner') }}',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    order_id: order_id,
                                    runner: runner,
                                    vehicle:vehicle,
                                    date:date,
                                },
                                success: function(response) {
                                    if(response.success){
                                        alert('Item send to the runner Successfully ');
                                        window.location.reload();
                                }
                                else{
                                    alert('Item not send to the runner Successfully ');
                                }
                            }
                            });
                        });
            
                    });
                </script>
                
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script>
                    jQuery(document).ready(function() {
            
            
                        $('#status').change(function() {
                            var status = $('#status').val();
                            if(status == 'all')
                            {
                                window.location.reload();
                            }
                            else{
                            jQuery.ajax({
                                url: '{{ url('warehouse/filter-orders') }}',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    status: status,
                                },
                                success: function(response) {
                                  
                                    $('#filterorders').html(response.data);
                                },
                                error: function(xhr, status, error) {
                                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                                    alert('Error - ' + errorMessage);
                                }
                            });
                        }
                        });
                    });
                </script>
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
                        function resetFilter() {
                    window.location.reload();
                  } 
              </script>
             
@include('warehouse.footer')
