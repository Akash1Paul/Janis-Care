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
                        @foreach ($purchase as $index => $item)
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13"><a href="{{url('warehouse/receivedGoods')}}">Purchase Order</a> > <a href="{{url('warehouse/purchaseorderdetails/'.$item['purchase_id'])}}">All Details</a> > Edit Batch</h4>
                                </div>
                            </div>
                        </div> 
                        @endforeach    
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Edit Batch</h4>
                                        <form action="{{url('warehouse/update-multiple-batch/'.$id)}}" method="post">
                                            <input type="text" name="roles" value="runner" hidden>
                                            @csrf
                                            <div class="row" id="addbatch">
                                                @foreach ($purchase as $index => $item)
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
                                            @endforeach
                                        </div>
                                        <div class="my-3 text-right">
                                            <a href="javascript:void(0)" id="addmorebatch" class="add_input text-danger"><b>+</b></a>
                                        </div>

                                     
                                        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
                                        <script>
                                            $(document).ready(function() {
                                                var outletNumber = 1; // Initialize the outlet number

                                                $("#addmorebatch").click(function() {
                                                    // Create the new set of fields with the incremented outlet number
                                                    var newFields =
                                                        '<div class="col-12 px-0"><div class="row px-3 addbatch"> <div class=" form-group"><hr></div><div class="col-lg-3 "><label for="name">Batch Number <span style="color:red">*</span></label><input type="text" name="batch[]" class="form-control" placeholder="Enter Batch Number"  required></div><div class="col-lg-3 form-group"><label for="name">QTY <span style="color:red">*</span></label><input type="text" name="qty[]" class="form-control" placeholder="Enter QTY" required></div><div class="col-lg-3 form-group"><label for="name">Expiry Date <span style="color:red">*</span></label><input type="date" name="expdate[]" class="form-control" required></div>' +
                                                        '<button type="button" class="inputRemove mx-3 mt-4 mb-5"><i class="fa fa-trash" aria-hidden="true"></i></button></div>  </div>';


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
                                               
                                                
                                                
                                          
                                            
                                                      
                                          <div class="row mt-md-4 mt-3">
                                            <div class="col-12">
                                               <div class="btns d-inline-block">
                                                   <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                               </div>
                                               <div class="btns d-inline-block">
                                                   <a href="{{url('warehouse/purchaseorderdetails/'.$item->purchase_id)}}"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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

                        
                    </div>  <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                <script>
                    function restrictNumber(e) {
                      var newValue = this.value.replace(new RegExp(/[^\d]/, 'ig'), "");
                      this.value = newValue;
                    }
                    
                    var userName = document.querySelector('#phone');
                    userName.addEventListener('input', restrictNumber);
                    </script>   
                    <script>
                     $('#phone').submit(function(e) {
                                e.preventDefault();
                                if(!$('#mobile').val().match('[0-9]{10}'))  {
                                    alert("Please put 10 digit mobile number");
                                    return;
                                }  
                    
                            });
                    </script> 
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