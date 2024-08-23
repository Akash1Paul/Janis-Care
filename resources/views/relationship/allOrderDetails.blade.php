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
                                    <h4 class="mb-0 font-size-13">Orders</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Orders</h4>
                                            <div class="fields d-flex">  
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" id="search"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                            </div>
                                                    </div>
                                                </div>                                     
                                                <div class="ml-3">                                       
                                                    <select class="form-control mb-3" id="status">
                                                        <option value="" disabled selected>Select Status</option>
                                                        <option value="all">All</option>
                                                        <option value="Dispatched">Dispatched</option>
                                                        <option value="Delivered">Delivered</option>
                                                        <option value="On-the-Way">On the Way</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Received">Received</option>
                                                    </select>
                                                </div> 
                                                <div class="mx-3">
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
                                                        <th>Spoc Name</th>
                                                       
                                                        <th>Address</th>
                                                        <th>Days Lapsed</th>
                                                        <th>All Details</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="filterorders">
                                                    @foreach ($orders as $index => $item)
                                                    <tr>
                                                        <td>{{ $index+1 }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($item->created_at))}}</td>
                                                        <td> @if($item['status']== 'Delivered')
                                                            {{date('d-m-Y',strtotime($item['updated_at']))}}
                                                        @else
                                                            -
                                                        @endif</td>
                                                        <td>{{ $item->spoc_name}}</td>
                                                      
                                                        <td>{{ $item->delivery_address}}</td>
                                                        @php
                                                        $todayDate = date('d-m-Y');
                                                        $created_Date = date('d-m-Y', strtotime($item->created_at));
                                                        $diff_days = strtotime($todayDate) - strtotime($created_Date);
                                                        $diff_days = floor($diff_days / (60 * 60 * 24)); 
                                                        @endphp
                                                        <td>{{ $diff_days }} {{$diff_days<=1?'Day':'Days'}}</td>
                                                        <td>
                                                            <a href="{{ url('relation/orders-details/' . $item->id)}}">
                                                                <button type="button" class="btn btn-primary waves-effect waves-light"> <i class="fas fa-eye"></i></button>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-success waves-effect waves-light">{{ $item->status}}</button>
                                                        </td>
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
                url: '{{ url('relation/filter-orders') }}',
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