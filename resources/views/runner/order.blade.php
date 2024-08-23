@include('runner.header')

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div class="main-content">

                @yield('header')
                @include('runner.navbar')                  

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
                        
                      
                    
                          
                        <div id="recaptcha-container"></div>
           
                        {{-- <a class="btn" data-toggle="modal" href="#myModal">Launch Modal</a> --}}
                        
                        {{-- <div class="form-group" style="display:none" id="OTP">

                            <label id="otp-new" for="verificationCode"><i class="bi bi-phone-fill"></i></label>
                            <input type="phone" placeholder="Enter OTP" id="verificationCode"
                                autocomplete="one-time-code">
                            <button type="button" class="form-submit submit-new" onclick="codeverify();">Verify Otp</button>
    
                        </div> --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h4 class="card-title">Orders</h4>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" id="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                    </div>
                                                    <div class="mx-3">
                                                        <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0" id="table">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Received Date</th>
                                                        <th>Delivery Date</th>
                                                        <th>Customer</th>
                                                        <th>Phone</th>
                                                        <th>Address</th>
                                                        <th>Driver</th>
                                                        
                                                        <th>All Details</th>
                                                        <th>OTP</th>
                                                        <th>Status</th>
                                                        <th>OTP Status</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                    @foreach ($orders as $index =>$value)
                                                 
                                                    <tr>
                                                        <td>{{$index+1}}</td>
                                                        <td>{{date('d-m-Y',strtotime($value[0]['date']))}}</td>
                                                        <td>
                                                            @if($value[0]['status']== 'Delivered')
                                                                {{date('d-m-Y',strtotime($value[0]['updated_at']))}}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>{{ isset($value[0]['spoc_name'])? $value[0]['spoc_name']:'empty'}}</td>
                                                        <td>{{$value[0]['phone']}}</td>
                                                        <td>{{$value[0]['delivery_address']}}</td>
                                                        <td>{{$vehicle[0][0]['drivarname']}}</td>
                                                       
                                                        <td>
                                                            <a href="{{ url('runner/orders-details/' . $value[0]['id'])}}">
                                                                <button type="button" class="btn btn-primary waves-effect waves-light"> <i class="fas fa-eye"></i></button>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="" id="number" value="{{$value[0]['phone']}}" hidden>
                                                            <button type="button" class="btn btn-warning waves-effect waves-light" onclick="sendOTP()">Send</button>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-info waves-effect waves-light">{{ $value[0]['status']}}</button>
                                                        </td>
                                                        <td>
                                                            @if($value[0]['status'] == 'Delivered' ||$value[0]['status'] == 'Out For Delivery')
                                                            <button type="button" class="btn btn-outline-success waves-effect waves-light"  >Verified</button>
                                                            @else
                                                            <button type="button" class="btn btn-danger waves-effect waves-light"  data-toggle="modal" data-target="#exampleModal{{$value[0]['order_id']}}">Click to Verify</button>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter{{$value[0]['order_id']}}">
                                                            Add
                                                          </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @foreach ($orders as $index =>$value)
                                        <div class="modal fade" id="exampleModalCenter{{$value[0]['order_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLongTitle">Add Remarks</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <form action="{{url('runner/remarks')}}" method="POST">
                                                <div class="modal-body">
                                                    <input type="text" name="order_id" value="{{$value[0]['order_id']}}" hidden>
                                                    <div class="form-group">
                                                        <label for="remark">Remarks</label>
                                                        {{-- <input type="text" class="form-control" name="remark" id="remark" placeholder="Enter Remark" value="{{$value[0]['remarks']}}"> --}}
                                                        <select name="remark" id="remark" class="form-control">
                                                            <option value="" disabled selected>Select</option>
   
                                                            <option value="wrong_order" {{$value[0]['remarks']=='wrong_order'? 'selected' : ''}} >Wrong Order</option>
   
                                                            <option value="quantity_mistake_in_invoice" {{$value[0]['remarks']=='quantity_mistake_in_invoice'? 'selected' : ''}} >Quantity mistake in invoice</option>

                                                            <option value="CD_is_not_available" {{$value[0]['remarks']=='CD_is_not_available'? 'selected' : ''}} >CD is not available</option>

                                                            <option value="scheme_is_less" {{$value[0]['remarks']=='scheme_is_less'? 'selected' : ''}} >Scheme is less</option>

                                                            <option value="order_is_not_given_by_party" {{$value[0]['remarks']=='order_is_not_given_by_party'? 'selected' : ''}} >Order is not given by party</option>

                                                            <option value="damage_condition_goods" {{$value[0]['remarks']=='damage_condition_goods'? 'selected' : ''}} >Damage condition goods</option>                                                     

                                                            <option value="receiving_partial_goods" {{$value[0]['remarks']=='receiving_partial_goods'? 'selected' : ''}} >Receiving partial good</option>   
                                                            <option value="Delivered" {{$value[0]['remarks']=='Delivered'? 'selected' : ''}} >Delivered</option>
                                                            <option value="delivered_lately" {{$value[0]['remarks']=='delivered_lately'? 'selected' : ''}} >Delivered Lately</option>
                                                        </select>
                                                      </div>
                                                </div>
                                           
                                                @csrf
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-primary">Save</button>
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                              </div>
                                            </div>
                                          </div>
                                          @endforeach
                                    </div>
                                    <!-- end card-body-->
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                        <!-- end row-->
    <!-- Modal -->
    @foreach ($orders as $index =>$value)
    <div class="modal fade" id="exampleModal{{$value[0]['order_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verify OTP & Change Status</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <input type="text" id="order_id" value="{{$value[0]['order_id']}}" hidden >
                        <input type="text" id="contact_number" value="{{$value[0]['phone']}}" hidden >
                        <div class="form-group"  id="OTP">

                            <label for="verificationCode">Enter OTP</label>
                            <input type="phone" class="form-control mb-3" placeholder="Enter OTP" id="code"
                                autocomplete="one-time-code">
    
                        </div>
                        <div class="fields">                                             
                            <h6 class="mt-4 mb-2">Status</h6>                                         
                            <select class="form-control mb-3" id="status">
                                <option disabled selected>Select One</option>
                                {{-- <option value="Out For Delivery">Out For Delivery</option> --}}
                                <option value="Delivered">Delivered</option>
                            </select>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal"  onclick="verify()">Submit</button>
                    <button type="button" class="btn btn-dark waves-effect waves-light" aria-label="Close" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
                        </div>
                        <!--end row-->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

@include('runner.footer')

<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
   $("#search-button").click(function(){
              $.each($("#table tbody tr"), function() {

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
    function sendOTP(){

    const phonenumber = $('#number').val();
   
    jQuery.ajax({
        url: '{{ url('runner/sendOTP') }}',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            phonenumber: phonenumber,
        },

        success: function(response) {
            alert('OTP is Send');
        },
        error: function(response)
      {
        alert('OTP is Not Send');
      }

    });
};

function verify()
{
    const contact_number = $('#contact_number').val();
    const code =  $('#code').val();
    const status2 =  $('#status').val();
    const order_id =  $('#order_id').val();
//    alert(status2); return;
   jQuery.ajax({
       url: '{{ url('runner/changestatus') }}',
       type: 'POST',
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       data: {
        contact_number: contact_number,
        code:code,
        status2:status2,
        order_id:order_id,
       },

       success: function(response) {
           alert('Phone Number is Verified');
           location.reload();
       },
      error: function(response)
      {
        alert('Phone Number is Not Verified');
      }

   });
};

</script>

{{-- <script>
    var firebaseConfig = {
        apiKey: "AIzaSyAlLvem-EWRk-TsVTQ-IaycVvTdCTD8N2A",
        authDomain: "dilseheal-2ec0a.firebaseapp.com",
        projectId: "dilseheal-2ec0a",
        storageBucket: "dilseheal-2ec0a.appspot.com",
        messagingSenderId: "422161660819",
        appId: "1:422161660819:web:28b1785a6dc5506dd10666",
        measurementId: "G-X1J08FMS86"
    };
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
</script>
<script type="text/javascript">
    window.onload = function () {
        render();
    };
    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }
    function sendOTP() {
        var number = '+91' + document.getElementById('number').value;
        // it takes two parameter first one is number and second one is recaptcha
        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(result) {
            confirmationResult = result; // assign result to confirmationResult
            window.confirmationResult = confirmationResult;
            var verificationId = confirmationResult
                .verificationId; // extract verificationId from confirmationResult
            sessionStorage.setItem('verificationId', verificationId);
            alert("Message Send");
            document.getElementById('OTP').style.display = 'block'; // show OTP verification field
        }).catch(function(error) {
            alert(error.message);
        });
    }

    function verify() {
        var code = $('#verificationCode').val();
        var order_id = $('#order_id').val();
        var status = $('#status').val();
        console.log(code);
                            jQuery.ajax({
                                url: '{{ url('runner/changestatus') }}',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    order_id: order_id,
                                    status: status,
                                   
                                },
                            });
        // retrieve verificationId from URL query parameters
        // var urlParams = new URLSearchParams(window.location.search);
        // var verificationId = urlParams.get('verificationId');

        var verificationId = sessionStorage.getItem('verificationId');

        firebase.auth().signInWithCredential(firebase.auth.PhoneAuthProvider.credential(verificationId, code))
            .then(function(result) {
                alert("Phone number verified");
                window.location.reload();
                
                var input = document.getElementById("number");

            }).then(function() {
                // remove the 'verificationId' session variable
                sessionStorage.removeItem('verificationId');

            }).catch(function(error) {
                alert(error.message);
            });
    }
</script> --}}

