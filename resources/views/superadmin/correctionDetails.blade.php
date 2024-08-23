@include('superadmin.header')

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div class="main-content">

                @yield('header')
          
                @yield('topnav')                

                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13"><a href="{{url('superadmin/correction')}}">Correction</a> > Correction Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
                        @isset($customers)
                      
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="card-title">Received Orders</h4> -->
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <h3>Correction</h3>
                                            </div>
                                          
                                                <div class="col-md-12 mb-md-0 mb-4">
                                                    <!-- <h4 class="text-center mt-3">OLD DATA</h4> -->
                                                    <div class="row mt-5">
                                                        <div class="col-12">
                                                            <table>
                                                                <tr>
                                                                    <td><p>Photo:</p></td>
                                                                    <td>
                                                                        @isset($customers->photo)
                                                                        <a href="{{url('image/'.$customers->photo)}}" target="_blank">
                                                                            <img src="{{url('image/'.$customers->photo)}}" height="50px" width="50px">
                                                                        </a>
                                                                        @endisset
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Date:</p></td>
                                                                    <td> <p>{{date('d-m-Y',strtotime($customers->created_at))}}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Customer:</p></td>
                                                                    <td><p>{{$customers->name}}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>SPOC name:</p></td>
                                                                    <td><p>{{$customers->spoc_name}}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>SPOC Number:</p></td>
                                                                    <td> <p>+91-{{$customers->spoc_number}}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Email:</p></td>
                                                                    <td><p>{{$customers->email}}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Brand Name:</p></td>
                                                                    <td><p>{{$customers->brand_name}}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Buisness Name:</p></td>
                                                                    <td><p>{{$customers->buisness_name}}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Company Name:</p></td>
                                                                    <td><p>{{$customers->company_name}}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Credit Period:</p></td>
                                                                    <td><p>{{$customers->credit_period}} Days</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Credit Ammount:</p></td>
                                                                    <td><p>Rs {{$customers->credit_amount}} ₹</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Notes:</p></td>
                                                                    <td><p>{{$customers->note}}</p></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                              
                                               
                                          </div>
                                          @php
                                          $outlet_name = explode(',', $customers['outlet_name']);
                                          $outlet_spoc = explode(',', $customers['outlet_spoc']);
                                          $outlet_spoc_number = explode(',', $customers['outlet_spoc_number']);
                                          $phone = explode(',', $customers['phone']);
                                          $gst = explode(',', $customers['gst']);
                                          $product_id = explode(',', $customers['product_id']);
                                          $discount_price = explode(',', $customers['discount_price']);
                                          $order_quantity = explode(',', $customers['order_quantity']);
                                          $document = explode(',', $customers['document']);
                                          $fda_license_number = explode(',', $customers['fda_license_number']);
                                          $expirydate = explode(',', $customers['expirydate']);
                                          $pincode = explode(',', $customers['pincode']);
                                          $billing_address = explode(',', $customers['billing_address']);
                                          $delivery_address = explode(',', $customers['delivery_address']);
                                          $outlet_email = explode(',', $customers['outlet_email']);
                                          $note = explode(',', $customers['note']);
                                          $state = explode(',', $customers['state']);
                                          $city = explode(',', $customers['city']);
                                        $todayDate = date('d-m-Y');
                                        $expiredcount = 0;
                                    @endphp
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h3>Outlets Details</h3>
                                        </div>
                                        @for ($i = 0; $i < count($outlet_name); $i++)
                                            <div class="col-md-6 mb-md-0 mb-4">
                                                <br>
                                                <h5>Outlet : {{$i+1}}</h5>
                                                <div class="row mt-5">
                                                    <div class="col-6">
                                                        <div class="details">
                                                            <table>
                                                                <tr>
                                                                    <td><p>Outlet Name:</p></td>
                                                                    <td><p>{{ $outlet_name[$i] }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Outlet SPOC:</p></td>
                                                                    <td><p>{{ $outlet_spoc[$i] }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Outlet SPOC Number</p></td>
                                                                    <td><p>{{ $outlet_spoc_number[$i] }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Email:</p></td>
                                                                    <td><p>{{ $outlet_spoc_number[$i] }}</p></td>
                                                                </tr>   
                                                                <tr>
                                                                    <td><p>Phone Number:</p></td>
                                                                    <td><p>{{ $phone[$i] }}</p></td>
                                                                </tr>  
                                                                @if($gst[$i]!='')
                                                                <tr>
                                                                    <td><p>GST:</p></td>
                                                                    <td><p>{{ $gst[$i] }}</p></td>
                                                                </tr>  
                                                                @endif
                                                                <tr>
                                                                    <td><p>FDA icense Number:</p></td>
                                                                    <td><p>{{ $fda_license_number[$i] }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>FDA License Expiry date:</p></td>
                                                                    <td><p>{{ date('d-m-Y',strtotime($expirydate[$i]))}} 
                                                           
                                                                        @if( date('d-m-Y',strtotime($expirydate[$i]))<$todayDate)
                                                                           <span style="color:red; font-weight:bold">(Expired)</span> 
                                                                          
                                                                        @endif
                                                                        </p></td>
                                                                </tr> 
                                                              
                                                                <tr>
                                                                    <td><p>Pin Code:</p></td>
                                                                    <td><p>{{ $pincode[$i] }}</p></td>
                                                                </tr> 
                                                                <tr>
                                                                    <td><p>State:</p></td>
                                                                    <td><p>{{ $state[$i] }}</p> </td>
                                                                </tr>   
                                                                <tr>
                                                                    <td><p>City:</p></td>
                                                                    <td><p>{{ $city[$i] }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Billing Address:</p></td>
                                                                    <td><p>{{ $billing_address[$i] }}</p></td>
                                                                </tr>
                                                                <tr> 
                                                                    <td><p>Delivery Address:</p></td>
                                                                    <td><p>{{ $delivery_address[$i] }}</p></td>
                                                                </tr>  
                                                                <tr>
                                                                    <td><p>Note:</p></td>
                                                                    <td> <p>{{ $note[$i] }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Document: </p></td>
                                                                    <td>
                                                                        @isset($document[$i])
                                
                                                                        @if(pathinfo($document[$i], PATHINFO_EXTENSION)== 'jpeg')
                                                                        <a href="{{url('image/'.$document[$i])}}" target="_blank">
                                                                            <img src="{{url('image/'.$document[$i])}}" height="50px" width="50px"></a>

                                                                        @elseif(pathinfo($document[$i], PATHINFO_EXTENSION)== 'jpg')
                                                                        <a href="{{url('image/'.$document[$i])}}" target="_blank">
                                                                            <img src="{{url('image/'.$document[$i])}}" alt=""  height="50px" width="50px"></a>

                                                                        @elseif(pathinfo($document[$i], PATHINFO_EXTENSION)== 'png')
                                                                        <a href="{{url('image/'.$document[$i])}}" target="_blank">
                                                                            <img src="{{url('image/'.$document[$i])}}" alt=""  height="50px" width="50px"></a>

                                                                        @elseif(pathinfo($document[$i], PATHINFO_EXTENSION) == 'pdf')
                                                                            <a href="{{ url('image/'.$document[$i]) }}" target="_blank">
                                                                                Open PDF
                                                                            </a>
                                                                      
                                                                        @endif
                                                                        @endisset
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                        </div>
                                                    </div>
                                             
                                                </div>
                                            </div>
                                            @endfor
                                        
    
                                    </div>
                                    <!-- end card-body-->
                                </div>
                                <form action="{{url('superadmin/changestatus/'.$customers->email)}}" method="post">
                                    @csrf
                                    @if($customers->status != 'Approved')
                                  <div class="col-md-6">
                                    <div class="fields">   
                                        <h6 class="mt-4 mb-2">Select</h6>                                         
                                        <select class="form-control mb-3" name="status" onchange="yesnoCheck(this);">
                                            <option disabled selected>Select One</option>
                                            <option value="Approved">Approve</option>
                                            <option value="NotApproved">Not Approve</option>
                                            <option value="Correction">Need Correction</option>
                                        </select>
                                    </div>
                                    <div class="form-group"  style="display: none;" id="note">
                                        <label for="name">Note</label>
                                        <textarea  class="form-control" name="note" id="Note" placeholder="Enter Note" cols="30" rows="5"></textarea>
                                    </div>
                                  </div>
                                  
                                  
                                  
                                  <div class="row px-3 mt-4">
                                     <div class="col-12">
                                        <div class="btns d-inline-block">
                                            <a href="#"><button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button></a>
                                        </div>
                                        <div class="btns d-inline-block">
                                            <a href="#"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                        </div>
                                     </div>
                                  </div>
                                  @endif
                                  </form>
                                <!-- end card -->
                            </div>
                        </div>
                        <!-- end row-->
                     
                        @endisset



                        </div>
                        <!--end row-->

                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
<script>
    function yesnoCheck(that) 
{
    if (that.value == "Approved") 
    {
        document.getElementById("note").style.display = "none";
    }
    else
    {
        document.getElementById("note").style.display = "block";
    }
    
}
</script>
    @include('superadmin.footer')

    </body>

</html>