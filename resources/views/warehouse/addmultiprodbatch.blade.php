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
                                    <h4 class="mb-0 font-size-13"><a href="{{url('warehouse/receivedGoods')}}">Purchase Order</a> > <a href="{{url('warehouse/purchaseorderdetails/'.$item['purchase_id'])}}">All Details</a> > Add Batch</h4>
                                </div>
                            </div>
                        </div> 
                        @endforeach  
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add Batch</h4>
                                        <form action="{{url('warehouse/add-multiple-batch/'.$id)}}" method="post">
                                            <input type="text" name="roles" value="runner" hidden>
                                            @csrf
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
                                            <a href="javascript:void(0)" id="addmore" class="add_input text-danger"><b>+</b></a>
                                        </div>

                                     
                                        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
                                        <script>
                                            $(document).ready(function() {
                                               // var outletNumber = 1; // Initialize the outlet number

                                                $("#addmore").click(function() {
                                                    // Create the new set of fields with the incremented outlet number
                                                    var newFields =
                                                        '<div class="col-12"><div class="row px-3 required_inp"> <div class="col-12 form-group"><hr></div><div class="col-md-4 form-group"><label for="name">Batch Number <span style="color:red">*</span></label><input type="text" name="batch[]" class="form-control" placeholder="Enter Batch Number"  required></div><div class="col-md-4 form-group"><label for="name">QTY <span style="color:red">*</span></label><input type="text" name="qty[]" class="form-control" placeholder="Enter QTY" required></div><div class="col-md-4 form-group"><label for="name">Expiry Date <span style="color:red">*</span></label><input type="date" name="expdate[]" class="form-control" required></div>' +
                                                        '<input type="button" class="inputRemove mx-3 mb-5" value="Remove"/></div></div>  ';


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
                                               
                                               <div class="row mt-md-4 mt-3">
                                                <div class="col-12">
                                                   <div class="btns d-inline-block">
                                                       <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                   </div>
                                                   @foreach ($purchase as $index => $item)
                                                   <div class="btns d-inline-block">
                                                       <a href="{{url('warehouse/purchaseorderdetails/'.$item['purchase_id'])}}"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                                   </div>
                                                   @endforeach
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