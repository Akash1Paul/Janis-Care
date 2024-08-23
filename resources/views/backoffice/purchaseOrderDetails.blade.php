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
                                    <h4 class="mb-0 font-size-13"><a href="{{url('backoffice/purchaseorders')}}">Purchase Orders</a> > All Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <!-- <h4 class="card-title">Received Orders</h4> -->
                                        <div class="row">
                                            
                                            <div class="col-12">
                                                <h5 >Purchase Orders Details</h5>
                                                <div class="mb-3">
                                                    <h6><u>Final GRN</u></h6>
                                                    @foreach($purchasedeatails as $pur)
                                                    @if($pur->status=='Received')
                                                        <p>Status : All Product Received Successfully</p>
                                                    @elseif($pur->status=='Defective')
                                                        <p>Status : Defective</p>
                                                    @elseif($pur->status=='Mismatch')
                                                        <p>Status : QTY Mismatch</p>
                                                    @else
                                                        <p>Status : Not Received</p>
                                                    @endif
                                                        <p class="mb-3">GRN : {{$pur->grn ? $pur->grn: 'Not Received'}}</p>
                                                    @endforeach
                                                   
                                                </div>
                                                <button id="btnExport" class="btn btn-primary float-right" onclick="fnExcelReport();"> EXPORT </button>
                                            </div>
                                           
                                            <div class="table-responsive">
                                                <table class="table table-bordered mb-0" id="headerTable">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Date</th>
                                                            <th>Product Name</th>
                                                            <th>Manufacturer</th>
                                                            <th>Pack Size</th>
                                                            <th>HSN Number</th>
                                                            <th>MRP</th>
                                                            <th>Rate</th>
                                                            <th>QTY</th>
                                                            <th>GRN Status</th>
                                                            <th>GRN</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
        
                                                      
        
                                                        @isset($purchase)
                                                        @foreach($purchase as $index => $item)
                                                        <tr>
                                                            <td>{{ $index+1 }}</td>
                                                            <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
                                                            <td>{{$proname[$index]}}</td>
                                                            <td>{{$item->manufacturer}}</td>
                                                            <td>{{$item->packsize}}</td>
                                                            <td>{{$item->hsn}}</td>
                                                            <td>{{$item->mrp}}</td>
                                                            <td>{{$item->rate}}</td>
                                                            <td>{{$item->qty}}</td> 
                                                            <td>{{$item->grn ? $item->grn:'Not Received'}}</td>
                                                            <td>{{$item->grn_status ? $item->grn_status:'Not Received'}}</td>
                                                        </tr>
                                                         
                                                        @endforeach
                                                        @endisset
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                               
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
                <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

                <script>
                function fnExcelReport() {
    var tab = document.getElementById('headerTable'); // id of table
    var headingRow = tab.rows[0]; // Assuming the heading is the first row
    for (var i = 0; i < headingRow.cells.length; i++) {
        headingRow.cells[i].style.fontWeight = 'bold';
    }
    // Create a new workbook
    var wb = XLSX.utils.book_new();
    
    // Convert table to worksheet
    var ws = XLSX.utils.table_to_sheet(tab);
    
    // Add the worksheet to the workbook
    XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
    
    // Convert the workbook to an Excel file
    var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }

    // Create a Blob object for the workbook data
    var blob = new Blob([s2ab(wbout)], { type: 'application/octet-stream' });

    // Trigger a download of the file
    saveAs(blob, 'purchaseorder.xlsx'); // Change 'YourFileName.xlsx' to the desired file name
}

                </script>
                <!-- End Page-content -->
@include('backoffice.footer')