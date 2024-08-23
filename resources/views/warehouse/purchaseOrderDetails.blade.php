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
                                    <h4 class="mb-0 font-size-13"><a href="{{url('warehouse/receivedGoods')}}">Purchase Orders</a> > All Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="card-title">Received Orders</h4> -->
                                        <div class="row mt-2">
                                            <div class="col-12 d-flex justify-content-between mb-3">
                                                <h5 class="mt-3">Purchase Orders Details</h5>
                                                {{-- <input type="button" class="btn btn-primary" value="Create PDF" id="btPrint" onclick="createPDF()" style="height:35px;" /> --}}
                                            
                                             

                                                <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#maingrnmodal" style="height:35px;">Final GRN</button>
                                                <div class="modal fade" id="maingrnmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Add Goods Received Notes</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                @foreach ($finalgrn as $item)
                                                    <form action="{{url('warehouse/add-maingrn/'.$purchase_id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="status">Status<span style="color: red">*</span></label>
                                                              <select name="status" id="status"  class="form-control" >
                                                                <option value="" disabled selected>Select</option>
                                                                <option value="Received" {{ $item['status'] == 'Received' ? 'selected' : '' }}>All Product Received Successfully</option>
                                                                <option value="Defective" {{ $item['status'] == 'Defective' ? 'selected' : '' }}>Defective</option>
                                                                <option value="Mismatch" {{ $item['status'] == 'Mismatch' ? 'selected' : '' }}>QTY Mismatch</option>
                                                              </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="manufacturer">Goods Received Notes</label>
                                                               <textarea name="grn" class="form-control" cols="30" rows="10" placeholder="Enter Goods Received Notes">{{$item->grn}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                    @endforeach
                                                      </div>
                                                    </div>
                                                  </div>
                                             
                                              
                                            </div>
                                        
                                            <div class="table-responsive" id="tbl">
                                                <table class="table table-bordered mb-0" >
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="2">#</th>
                                                            <th rowspan="2">Date</th>
                                                            <th rowspan="2">Product Name</th>
                                                            <th rowspan="2">Manufacturer</th>
                                                            <th rowspan="2">Pack Size</th>
                                                            <th rowspan="2">HSN Number</th>
                                                            <th rowspan="2">MRP</th>
                                                            {{-- <th>Rate</th> --}}
                                                            <th rowspan="2">QTY</th>
                                                            <th colspan="3" class="text-center" style="color: red">Action</th>
                                                            <th rowspan="2">Batch</th>
                                                        </tr>
                                                        <tr>
                                                            
                                                            <th style="color: red">Batch No & Exp Date</th>
                                                            <th style="color: red">Receive</th>
                                                            <th style="color: red">GRN</th>
                                                            
                                                        </tr>
                                                        
                                                       
                                                    </thead>
                                                    <tbody>
        
                                                      
        
                                                        @isset($purchase)
                                                        @foreach($purchase as $index => $item)
                                                        <tr>
                                                            <td>{{ $index+1 }}</td>
                                                            <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
                                                            <td>
                                                                {{$proname[$index]}}
                                                            </td>
                                                            <td>{{$item->manufacturer}}</td>
                                                            <td>{{$item->packsize}}</td>
                                                            <td>{{$item->hsn}}</td>
                                                            <td>{{$item->mrp}}</td>
                                                            {{-- <td>{{$item->rate}}</td> --}}
                                                            <td>
                                                                <form action="{{url('warehouse/updateqty/'.$item->id)}}" method="post"> 
                                                                    @csrf
                                                            <input type="text" name="qty" value="{{$item->qty}}" style="width:30px;"> 
                                                                </form>
                                                            </td>
                                                        
                                                            @if($item->batch != NULL && $item->batch != '')
                                                            <td >
                                                                {{-- <form action="{{url('warehouse/updatebatch/'.$item->id)}}" method="post"> 
                                                                @csrf<span class="font-weight-bold">B.No:</span> 
                                                                
                                                                <input type="text" name="batch" value="{{$item->batch}}" style="width:70px;">
                                                                </form>
                                                                <span class="font-weight-bold">E. Date:</span> {{date('d-m-Y',strtotime($item->expiry_date))}} --}}
                                                                @isset($jsonData)
                                                                @foreach ($jsonData as $index => $value)
                                                                
                                                                  <span class="multiple-batch"> B.No: {{ $value['batch'] }} , 
                                                                  QTY:  {{ $value['qty'] }} , 
                                                                 E. Date: {{ $value['expdate'] }}</span> 
                                                                @endforeach
                                                                @endisset
                                                            </td>
                                                            @else
                                                            <td>
                                                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$item->product_name}}">Add</button> --}}
                                                            </td>
                                                            @endif
                                                            <td>
                                                                @if($item->received_status==1)
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input astro{{$item->id}}" type="radio" name="inlineRadioOptions{{$item->id}}" id="updatereceived" value="1" onclick="return confirm('Are you sure?');"  checked>
                                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input no{{$item->id}}" type="radio" name="inlineRadioOptions{{$item->id}}" id="updatereceived" onclick="return confirm('Are you sure?');" value="0">
                                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                                  </div>
                                                                @elseif($item->received_status==0)
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input astro{{$item->id}}" onclick="return confirm('Are you sure?');" type="radio" name="inlineRadioOptions{{$item->id}}" id="updatereceived" value="1">
                                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input no{{$item->id}}" onclick="return confirm('Are you sure?');" type="radio" name="inlineRadioOptions{{$item->id}}" id="updatereceived" value="0" checked>
                                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                                  </div>
                                                                @else
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input astro{{$item->id}}" type="radio" name="inlineRadioOptions{{$item->id}}" id="updatereceived" onclick="return confirm('Are you sure?');" value="1">
                                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                                </div>
                                                                  <div class="form-check form-check-inline">
                                                                    <input class="form-check-input no{{$item->id}}" type="radio" name="inlineRadioOptions{{$item->id}}" id="updatereceived" onclick="return confirm('Are you sure?');" value="0">
                                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                                  </div>
                                                                @endif()
                                                                
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#GRNModal{{ $item->id }}" style="height:35px;">GRN</button>
                                                            </td>
                                                            <td>
                                                                @if($item->products_batchwise == NULL || $item->products_batchwise == '')
                                                                <a href="{{url('warehouse/addmultiprodbatch/'.$item->id)}}" class="btn btn-primary waves-effect waves-light" style="height:35px;">ADD</a>
                                                                @else
                                                                <a href="{{url('warehouse/editmultiprodbatch/'.$item->id)}}" class="btn btn-primary waves-effect waves-light" style="height:35px;">EDIT</a>
                                                                @endif 
                                                            </td>
                                                        </tr>
                                                        
                                                        @endforeach
                                                        @endisset
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                               
                                            </div>
                                            @foreach ($purchase as $index => $item)

                                            <div class="modal fade" id="exampleModal{{$item->product_name}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Edit Batch No</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <form action="{{url('warehouse/edit-batch/'.$item->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf

                                                     
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="manufacturer">Batch No<span
                                                                style="color: red">*</span></label>
                                                            <input type="text" name="batch" class="form-control" placeholder="Enter Batch No">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="manufacturer">Expiry Date<span
                                                                style="color: red">*</span></label>
                                                            <input type="date" name="expiry_date" class="form-control" placeholder="Enter expiry date">
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>


                                              <div class="mx-2">                 
                                                <div class="modal fade" id="GRNModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Add Goods Received Notes</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>

                                                    <form action="{{url('warehouse/add-grn/'.$item->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="status">Status<span style="color: red">*</span></label>
                                                              <select name="status" id="status"  class="form-control" >
                                                                <option value="" disabled selected>Select</option>
                                                                <option value="Received" {{ $item['grn_status'] == 'Received' ? 'selected' : '' }}>All Product Received Successfully</option>
                                                                <option value="Defective"  {{  $item['grn_status']== 'Defective' ? 'selected' : '' }}>Defective</option>
                                                                <option value="Mismatch"  {{  $item['grn_status'] == 'Mismatch' ? 'selected' : '' }}>QTY Mismatch</option>
                                                              </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="manufacturer">Goods Received Notes</label>
                                                               <textarea name="grn" class="form-control" cols="30" rows="10" placeholder="Enter Goods Received Notes">{{$item->grn}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>
                                            <div class="mx-2">                 
                                                <div class="modal fade" id="batchmodal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Add Batch</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>

                                                    <form action="{{url('warehouse/add-multiple-batch/'.$item->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row" id="req_input">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="status">Batch Number<span style="color: red">*</span></label>
                                                                        <input class="form-control" name="batch[]" type="text" placeholder="Enter Batch Number">
                                                                    </div>
                                                                </div>
                                                            
                                                            <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="manufacturer">QTY <span style="color: red">*</span></label>
                                                               <input type="text" name="qty[]" id="" class="form-control" placeholder="Enter QTY">
                                                            </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="manufacturer">Expiry Date <span style="color: red">*</span></label>
                                                               <input type="date" name="expdate[]" id="" class="form-control">
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="my-3 text-right">
                                                            <a href="javascript:void(0)" id="addmore{{$item->id}}" class="add_input text-danger"><b>+</b></a>
                                                        </div>
            
                                                     
                                                        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
                                                        <script>
                                                            $(document).ready(function() {
                                                               // var outletNumber = 1; // Initialize the outlet number
            
                                                                $("#addmore{{$item->id}}").click(function() {
                                                                    // Create the new set of fields with the incremented outlet number
                                                                    var newFields =
                                                                        '<div class="row px-3 required_inp"> <div class="col-12 form-group"><hr></div><div class="col-md-4 form-group"><label for="name">Batch Number <span style="color:red">*</span></label><input type="text" name="batch[]" class="form-control" placeholder="Enter Batch Number"  required></div><div class="col-md-4 form-group"><label for="name">QTY <span style="color:red">*</span></label><input type="text" name="qty[]" class="form-control" placeholder="Enter QTY" required></div><div class="col-md-4 form-group"><label for="name">Expiry Date <span style="color:red">*</span></label><input type="date" name="expdate[]" class="form-control" required></div>' +
                                                                        '<input type="button" class="inputRemove mx-3 mb-5" value="Remove"/></div>  ';
            
            
                                                                    // Append the new fields to the #req_input div
                                                                    $("#req_input").append(newFields);
            
                                                                    
            
                                                                    // Increment the outlet number for each new set of fields
                                                                  //  outletNumber++;
                                                                    // Bind the keyup event for the new FDA license number input field
                                                                });
            
                                                            });
            
            
                                                            $('body').on('click', '.inputRemove', function() {
                                                                // Remove the parent div of the clicked Remove button
                                                                $(this).parent('div.required_inp').remove();
                                                                // Decrement the outlet number when removing a set of fields (if needed)
                                                                outletNumber--;
                                                                $("#outletNumberInput").val(outletNumber);
                                                            });
                                                        </script>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>
                                            <div class="mx-2">                 
                                                <div class="modal fade" id="editbatchmodal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Add Batch</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>

                                                    <form action="{{url('warehouse/update-multiple-batch/'.$item->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                          
                                                            <div class="row" id="addbatch">
                                                                @isset($jsonData)
                                                                @foreach ($jsonData as $index => $value)
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="status">Batch Number<span style="color: red">*</span></label>
                                                                        <input class="form-control" name="batch[]" type="text" value=" {{$value['batch']}}" placeholder="Enter Batch Number">
                                                                    </div>
                                                                </div>
                                                            
                                                            <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="manufacturer">QTY <span style="color: red">*</span></label>
                                                               <input type="text" name="qty[]" id="" class="form-control" value=" {{$value['qty']}}" placeholder="Enter QTY">
                                                            </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="manufacturer">Expiry Date <span style="color: red">*</span></label>
                                                               <input type="date" value="{{$value['expdate']}}" name="expdate[]" id="" class="form-control">
                                                            </div>
                                                            </div>
                                                        <div class="col-lg-3 mt-4">
                                                        
                                                            <div class="form-group">
                                                       
                                                        
                                                            <input type="text" hidden name="id" id="batchrow{{$item->id}}" value="{{$item->id}}"> 

                                                            <input type="text" id="batchkey{{$item->id}}" hidden name="key" value="{{$index}}">

                                                            <button  type="button" id="batchdeletebut{{$index}}" class="inputRemove mx-3 mb-5"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                       
                                                            </div>
                                                            
                                                            
                                                        </div> 
                                                            @endforeach
                                                            @endisset
                                                        </div>
                                                        
                                                        <div class="my-3 text-right">
                                                            <a href="javascript:void(0)" id="addmorebatch{{$item->id}}" class="add_input text-danger"><b>+</b></a>
                                                        </div>
          
                                                     
                                                        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
                                                        <script>
                                                            $(document).ready(function() {
                                                                var outletNumber = 1; // Initialize the outlet number
            
                                                                $("#addmorebatch{{$item->id}}").click(function() {
                                                                    // Create the new set of fields with the incremented outlet number
                                                                    var newFields =
                                                                        '<div class="row px-3 addbatch"> <div class=" form-group"><hr></div><div class="col-lg-3 "><label for="name">Batch Number <span style="color:red">*</span></label><input type="text" name="batch[]" class="form-control" placeholder="Enter Batch Number"  required></div><div class="col-lg-3 form-group"><label for="name">QTY <span style="color:red">*</span></label><input type="text" name="qty[]" class="form-control" placeholder="Enter QTY" required></div><div class="col-lg-3 form-group"><label for="name">Expiry Date <span style="color:red">*</span></label><input type="date" name="expdate[]" class="form-control" required></div>' +
                                                                        '<button type="button" class="inputRemove mx-3 mt-4 mb-5"><i class="fa fa-trash" aria-hidden="true"></i></button></div>  ';
            
            
                                                                    // Append the new fields to the #req_input div
                                                                    $("#addbatch").append(newFields);
            
                                                                    $('body').on('keyup', '.fda-input', function() {
                                                                        var fda_number = $(this).val();
                                                                        
                                                                      // var outletNumber = $(this).attr('data-outlet'); // Get the outlet number from the attribute
            
            
                                                                    
                                                                    });
            
                                                                    // Increment the outlet number for each new set of fields
                                                                    outletNumber++;
                                                                    // Bind the keyup event for the new FDA license number input field
                                                                });
            
                                                            });
            
            
                                                            $('body').on('click', '.inputRemove', function() {
                                                                // Remove the parent div of the clicked Remove button
                                                                $(this).parent('div.addbatch').remove();
                                                                // Decrement the outlet number when removing a set of fields (if needed)
                                                                outletNumber--;
                                                                $("#outletNumberInput").val(outletNumber);
                                                            });
                                                        </script>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>
                                            @endforeach
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@foreach ($purchase as $index => $item)
<script>    
    $(".astro{{$item->id}}").change(function(){
        var val = $(".astro{{$item->id}}:checked").val();
        var id = {{$item->id}};
                jQuery.ajax({
                        url: '{{ url('warehouse/update-received') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            val:val,
                            id:id,
                        },
                        success: function(response) {
                           alert(response.success);
                        $('.success').text(response.success);
                        location.reload();
                        },
                        error:function(response)
                        {
                            // alert('error');
                        }
                    });
    });
    $(".no{{$item->id}}").change(function(){
        var val = $(".no{{$item->id}}:checked").val();
        var id = {{$item->id}};
       
      
                jQuery.ajax({
                        url: '{{ url('warehouse/update-no') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            val:val,
                            id:id,
                        },
                        success: function(response) {
                           alert(response.success);
                        $('.success').text(response.success);
                        location.reload();
                        },
                        error:function(response)
                        {
                            // alert('error');
                        }
                    });
    });
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
        win.document.write('<title>Purchase Orders Details</title>'); // <title> FOR PDF HEADER.
        win.document.write(style); // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable); // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');

        win.document.close(); // CLOSE THE CURRENT WINDOW.

        win.print(); // PRINT THE CONTENTS.
      }
</script>
@endforeach

@include('warehouse.footer')
@foreach ($purchase as $index => $item)
@isset($jsonData)
@foreach ($jsonData as $index => $value)
<script>
    jQuery(document).ready(function() {
        $('#batchdeletebut{{$index}}').on('click', function() {
            // Get the id and key values
            var id = $('#batchrow{{$item->id}}').val();
            var key = $('#batchkey{{$item->id}}').val();

            // Display confirmation dialog
            if (confirm("Are you sure you want to delete this batch item?")) {
                // Proceed with AJAX request if user confirms
                jQuery.ajax({
                    url: '{{ url('warehouse/batchdelete') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id,
                        key: key,
                    },
                    success: function(response) {
                        // Show success message
                        alert(response.message);
                        // Reload the page
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Show error message
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    });
</script>
@endforeach
@endisset
@endforeach