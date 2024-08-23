@include('warehouse.header')
<style>
    input[type="checkbox"][readonly] {
  pointer-events: none;
}
</style>
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
                                    <h4 class="mb-0 font-size-13">Purchase Orders</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Purchase Orders</h4>
                                            <div class="fields d-flex">
                                                <div>
                                                    <div class="input-group">
                                                        <input type="text" id="search"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                            </div>
                                                    </div>
                                                </div>
                                                                                    
                                           
                                                <div class="mx-2 mb-3">
                                                    <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                </div> 
                                               
                                            </div>
                                        </div>
                                        <div class="table-responsive" id="tbl">
                                            <table class="table table-bordered mb-0" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Purchase Id</th>
                                                        <th>Print</th>
                                                        <th>View</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="filterorders">
                                                    @foreach ($purchase as $item =>$value)
                                                    <tr>
                                                        <td>{{$item+1}}</td>
                                                        <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                                                        <td>{{$value->purchase_id}}</td>
                                                        @if($value->invoice != NULL && $value->invoice != '')
                                                        <td>
                                                            <a href="{{url('warehouse/showpdf/'.$value->purchase_id)}}">
                                                                <button type="button"  class="btn fa fa-file-pdf" style="color: red;font-size:25px;"></button>
                                                            </a>
                                                            
                                                        </td>
                                                        @else
                                                        
                                                            <td>
                                                                <button type="button"class="btn btn-outline-success waves-effect waves-light" >Yet to Upload</button>
                                                            </td>
                                                        
                                                        @endif
                                                        
                                                        <td>
                                                            <a href="{{url('warehouse/purchaseorderdetails/'.$value->purchase_id)}}">
                                                                <button type="button" class="btn btn-primary waves-effect waves-light"> <i class="fas fa-eye"></i></button>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if($value->status == 'Received')
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked readonly>
                                                              </div>
                                                            @else
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" readonly>
                                                              </div>
                                                            @endif
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

                              <!-- Modal -->
                             

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
              
             <script>
    function createPDF() {
        var sTable = document.getElementById('tbl').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Helveticas;}";
        style = style + "table,tr, th, td {border: solid 1px #dee2e6;padding:15px; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=1000,width=1000');

        win.document.write('<html><head>');
        win.document.write('<title>Received Goods</title>'); // <title> FOR PDF HEADER.
        win.document.write(style); // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable); // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');

        win.document.close(); // CLOSE THE CURRENT WINDOW.

        win.print(); // PRINT THE CONTENTS.
      }
             </script>
@include('warehouse.footer')
