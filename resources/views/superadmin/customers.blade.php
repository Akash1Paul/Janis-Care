@include('superadmin.header')

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <div class="main-content">

            @yield('header')
            @yield('topnav')
            <div class="page-content">
                <div class="container-fluid">

                    @if ($layout == 0)
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13">Customers</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Customers Details</h4>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" id="search" class="form-control"
                                                        placeholder="Search ..." aria-label="Recipient's username">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="search-button"><i
                                                                class="mdi mdi-magnify"></i></button>
                                                    </div>
                                                    <div class="mx-3">
                                                        <a><button class="btn btn-primary waves-effect waves-light"
                                                                onclick="resetFilter()">Reset</button></a>
                                                    </div>
                                                    <a href="{{ url('superadmin/add-customers') }}"><button
                                                            type="button"
                                                            class="btn btn-primary waves-effect waves-light ml-3">Add</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    <form action="{{ url('superadmin/importcustomers') }}"
                                        method="POST"
                                        enctype="multipart/form-data" class="d-flex mt-4 justify-content-end">
                                      @csrf
                                      
                                       
                                    <div>
                                            <label for="" >Customers</label>
                                    <div class="d-flex justify-content-end">
                                        <input type="file" name="file"
                                             class="form-control" style="width: 100%" required accept=".xls, .xlsx">
                                      <br>
                                      <button class="btn btn-success ml-3">
                                            Import
                                         </button>
                                      <a class="btn btn-warning ml-3"
                                         href="{{ url('superadmin/exportcustomers') }}">
                                                Export
                                        </a>
                                    </div>
                                </div>
                                    </form>
                                    <form action="{{ url('superadmin/outletsimport') }}"
                                        method="POST"
                                        enctype="multipart/form-data" class="d-flex mt-4 justify-content-end">
                                       
                                      @csrf
                                      <div>
                                        <label for="">Outlets</label>
                                            <div class="d-flex justify-content-end">
                                      <input type="file" name="file"
                                             class="form-control" style="width: 100%" required accept=".xls, .xlsx">
                                      <br>
                                      <button class="btn btn-success ml-3">
                                            Import
                                         </button>
                                      <a class="btn btn-warning ml-3"
                                         href="{{ url('superadmin/outletsexport') }}">
                                                Export
                                        </a>
                                    </div>
                                </div>
                                    </form>
                                    <form action="{{ url('superadmin/discountimport') }}"
                                        method="POST"
                                        enctype="multipart/form-data" class="d-flex mt-4 justify-content-end">
                                      
                                      @csrf
                                      <div>
                                        <label for="">Discount</label>
                                            <div class="d-flex justify-content-end">
                                      <input type="file" name="file"
                                             class="form-control" style="width: 100%" required accept=".xls, .xlsx">
                                      <br>
                                      <button class="btn btn-success ml-3">
                                            Import
                                         </button>
                                      <a class="btn btn-warning ml-3"
                                         href="{{ url('superadmin/discountexport') }}">
                                                Export
                                        </a>
                                    </div>
                                </div>
                                    </form>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0 mt-4" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Customer</th>
                                                        <th>Email </th>
                                                        <th>All Details</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="myTable">


                                                    @isset($customers)
                                                        @foreach ($customers as $key => $item)
                                                            <tr>
                                                                <td class="mt-2 mr-2">{{ $key + 1 }}</td>
                                                                <td>{{ $item->company_name }}</td>
                                                                <td>{{ $item->email }}</td>
                                                                <td>
                                                                    <a href="{{url('superadmin/customerdetails/'.$item->email)}}">
                                                                        <button type="button" class="btn btn-warning waves-effect waves-light"> <i class="fas fa-eye"></i></button>
                                                                    </a>
                                                                </td>

                                                                <td>
                                                                    <a
                                                                        href="{{ url('superadmin/discount-customers/' . $item->email) }}"><button
                                                                            class="btn btn-success"
                                                                            style="color :white">discount</button></a>
                                                                    <a
                                                                        href="{{ url('superadmin/edit-customers/' . $item->email) }}"><button
                                                                            class="btn btn-primary"
                                                                            style="color :white">Edit</button></a>
                                                                    <a
                                                                        href="{{ url('superadmin/delete-customers/' . $item->email) }}" onclick="return confirm('Are you sure you want to delete this customer?');"><button
                                                                            class="btn btn-danger">Delete</button></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endisset
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <!-- end card-body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                    @elseif ($layout == 1)
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13"><a href="{{url('superadmin/customers')}}">Customers</a> > Add Customer</h4>
                                </div>
                            </div>


                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add Customer</h4>
                                        <form action="{{ url('superadmin/add-customers') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mt-4" id="req_input">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Choose Relationship Manager <span
                                                                style="color: red">*</span></label>
                                                        <select name="relationship_manager" class="form-control mb-3"
                                                            required>
                                                          <option value=''>Select One</option>

                                                            @foreach ($relationship_managers as $item)
                                                                <option value="{{ $item->email }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                  @error('relationship_manager')  <span class="text-danger">{{ $message }}</span>@enderror

                                                    </div>
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label for="name">Brand name <span
                                                            style="color: red">*</span></label>
                                                    <input type="text" name="brand_name" id="Brandname"
                                                        class="form-control" value="{{ old('brand_name') }}" placeholder="Enter brand name" required>

                                                  @error('brand_name')  <span class="text-danger">{{ $message }}</span>@enderror
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label for="name">Business name <span
                                                            style="color: red">*</span></label>
                                                    <input type="text" name="buisness_name" id="Bname"
                                                        class="form-control" value="{{ old('buisness_name') }}" placeholder="Enter business name" required>
                                                  @error('buisness_name')  <span class="text-danger">{{ $message }}</span>@enderror

                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="name">Company name <span
                                                            style="color: red">*</span></label>
                                                    <input type="text" name="company_name" id="cName"
                                                        class="form-control" value="{{ old('company_name') }}" placeholder="Enter company name" required>
                                                  @error('company_name')  <span class="text-danger">{{ $message }}</span>@enderror

                                                </div>
                                               
                                         

                                                <div class="col-md-4 form-group">
                                                    <label for="name">Email <span
                                                            style="color: red">*</span></label>
                                                    <input type="email" name="email" id="email"
                                                        class="form-control" value="{{ old('email') }}" placeholder="Enter Email" required>
                                                  @error('email')  <span class="text-danger">{{ $message }}</span>@enderror

                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label for="name">SPOC Name <span
                                                            style="color: red">*</span></label>
                                                    <input type="text" name="spoc_name" id="spocUser"
                                                        class="form-control" value="{{ old('spoc_name') }}" placeholder="Enter SPOC Name" required>
                                                  @error('spoc_name')  <span class="text-danger">{{ $message }}</span>@enderror

                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="name">SPOC Contact <span
                                                            style="color: red">*</span></label>
                                                    <input type="number" name="spoc_number" id="spocContact"
                                                        class="form-control" value="{{ old('spoc_number') }}" placeholder="Enter SPOC Contact" required
                                                        maxlength="12" minlength="10">
                                                  @error('spoc_number')  <span class="text-danger">{{ $message }}</span>@enderror

                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="name">Credit Amount (Amount)<span
                                                            style="color: red">*</span></label>
                                                    <input type="number" name="credit_amount" id="creditAmount"
                                                        class="form-control" value="{{ old('credit_amount') }}"  placeholder="Enter Credit Amount"
                                                        required>
                                                  @error('credit_amount')  <span class="text-danger">{{ $message }}</span>@enderror
                                                        
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="name">Credit Period (Days)<span
                                                            style="color: red">*</span></label>
                                                    <input type="number" name="credit_period" id="creditPeriod"
                                                        class="form-control" value="{{ old('credit_period') }}" placeholder="Enter Credit Period"
                                                        required>
                                                  @error('credit_period')  <span class="text-danger">{{ $message }}</span>@enderror
                                                        
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Customer City <span style="color:red">*</span></label>
                                                        <select name="customer_city" class="form-control" required>
                                                            <option disabled selected>Select</option>
                                                            <option value="Pune">Pune</option>
                                                            <option value="Mumbai">Mumbai</option>
                                                            <option value="Delhi">Delhi</option>
                                                            <option value="Haridwar">Haridwar</option>
                                                            <option value="Navasari">Navasari</option>
                                                            <option value="Aurangabad">Aurangabad</option>
                                                            <option value="Goregaon">Goregaon</option>
                                                            <option value="Ghatkopar">Ghatkopar</option>
                                                            <option value="Lokhandwala">Lokhandwala</option>
                                                            <option value="RamMandir">Ram Mandir</option>
                                                        </select>
                                                        @error('customer_city')  <span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="name">Photo <span
                                                            style="color: red">*</span></label>
                                                    <input type="file" name="photo" id="creditPeriod"
                                                        class="form-control" placeholder="Upload Photo" accept="image/png, image/jpeg, image/jpg">
                                                
                                                        @error('photo')  <span class="text-danger">{{ $message }}</span>@enderror
                                                
                                                    </div>
                                               

                                            <div class="my-3 text-right">
                                                <a href="javascript:void(0)" id="addmore" class="add_input">Add
                                                    Outlet</a>
                                            </div>

                                         
                                            <script src="{{ url('assets/js/jquery.min.js') }}"></script>
                                            <script>
                                                $(document).ready(function() {
                                                    var outletNumber = 1; // Initialize the outlet number

                                                    $("#addmore").click(function() {
                                                        // Create the new set of fields with the incremented outlet number
                                                        var newFields =
                                                            '<div class="row px-3 required_inp"> <div class="col-12 form-group"><hr><h4>Outlet <span>' +
                                                            outletNumber +
                                                            '</span></h4></div><div class="col-md-4 form-group"><label for="name">Outlet Name <span style="color:red">*</span></label><input type="text" name="outlet_name[]" class="form-control" placeholder="Enter Outlet Name"  required></div><div class="col-md-4 form-group"><label for="name">Outlet SPOC <span style="color:red">*</span></label><input type="text" name="outlet_spoc[]" class="form-control" placeholder="Enter SPOC" required></div><div class="col-md-4 form-group"><label for="name">Outlet SPOC Number <span style="color:red">*</span></label><input type="text" name="outlet_spoc_number[]" class="form-control" placeholder="Enter Number" required></div><div class="col-md-4 form-group"><label for="simpleinput">Phone Number <span style="color:red">*</span></label><input type="number" name="phone[]" class="form-control" placeholder="Enter Number" required>@error("phone")<span class="text-danger">{{ $message }}@enderror</div><div class="col-md-4 form-group"><label for="simpleinput">GST Number</label><input type="text" name="gst[]" class="form-control gst-input" placeholder="Enter GST Number">@error("gst")<span class="text-danger">{{ $message }}</span>@enderror</div><div class="col-md-4 form-group"><label for="simpleinput">FDA license Number <span style="color:red">*</span></label><input type="text" name="fda_license_number[]"  class="form-control fda-input" placeholder="Enter FDA Number" required>@error("fda_license_number")<span class="text-danger">{{ $message }}</span>@enderror</div><div class="col-md-4 form-group"><label for="simpleinput">Date of Issue for FDA <span style="color:red">*</span></label><input type="date" name="issuedate[]" class="form-control" placeholder="Enter date of issue" required></div><div class="col-md-4 form-group"><label for="simpleinput">Expiry Date for FDA <span style="color:red">*</span></label><input type="date" name="expirydate[]" class="form-control" placeholder="Enter expiry date" required></div><div class="col-md-4"><div class="form-group"><label for="name">Pincode <span style="color:red">*</span></label><input type="text" name="pincode[]" class="form-control" placeholder="Enter Pincode" required></div></div><div class="col-md-4"><div class="form-group"><label for="name">State <span style="color:red">*</span></label><input type="text" class="form-control" name="state[]" placeholder="Enter State" required></div></div> <div class="col-md-4"><div class="form-group"><label for="name">City <span style="color:red">*</span></label><select name=city[] class="form-control"><option disabled selected>Select</option><option value="Pune">Pune</option><option value="Mumbai">Mumbai</option><option value="Delhi">Delhi</option><option value="Haridwar">Haridwar</option><option value="Navasari">Navasari</option><option value="Aurangabad">Aurangabad</option><option value="Goregaon">Goregaon</option><option value="Ghatkopar">Ghatkopar</option><option value="Lokhandwala">Lokhandwala</option><option value="RamMandir">Ram Mandir</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="name">Upload Document</label><input name="document[]" type="file" class="form-control" accept="image/*, .pdf"></div></div><div class="col-md-4"><div class="form-group"><label for="name">Billing Address <span style="color:red">*</span></label><input type="text" name="billing_address[]" class="form-control" placeholder="Enter Billing Address" required></div></div><div class="col-md-4"><div class="form-group"><label for="name">Delivery Address <span style="color:red">*</span></label><input type="text" class="form-control" name="delivery_address[]" placeholder="Enter Delivery Address" required></div></div><div class="col-md-4 form-group"><label for="email">Email address <span style="color:red">*</span></label><input type="email" name="outlet_email[]" class="form-control" id="email" placeholder="name@example.com" required>@error("outlet_email")<span class="text-danger">{{ $message }}@enderror</div><div class="col-md-12"><div class="form-group"><label for="name">Note</label><textarea class="form-control" name="note[]" id="Note" placeholder="Enter Note" cols="30" rows="5"></textarea></div></div>' +
                                                            '<input type="button" class="inputRemove mx-3 mb-5" value="Remove"/></div>  ';


                                                        // Append the new fields to the #req_input div
                                                        $("#req_input").append(newFields);

                                                        $('body').on('keyup', '.fda-input', function() {
                                                            var fda_number = $(this).val();
                                                            
                                                          // var outletNumber = $(this).attr('data-outlet'); // Get the outlet number from the attribute


                                                            jQuery.ajax({
                                                                url: '{{ url('superadmin/check-fda-number') }}',
                                                                type: 'POST',
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                },
                                                                data: {
                                                                    fda_number: fda_number,
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                    $('.fda-error').html(response.errors.fda_number[0]); // Display the first error message
                                                                },
                                                                error: function(xhr, status, error) {
                                                                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                                                                    // alert('Error - ' + errorMessage);
                                                                }
                                                            });
                                                        });

                                                        $('body').on('keyup', '.gst-input', function() {
                                                            var gst_number = $(this).val();
                                                            
                                                            jQuery.ajax({
                                                                url: '{{ url('superadmin/check-gst-number') }}',
                                                                type: 'POST',
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                },
                                                                data: {
                                                                    gst_number: gst_number,
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                    // $('.gst-error').html(response.errors.fda_number[0]); // Display the first error message
                                                                },
                                                                error: function(xhr, status, error) {
                                                                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                                                                    // alert('Error - ' + errorMessage);
                                                                }
                                                            });
                                                        });
                                                        // Increment the outlet number for each new set of fields
                                                        outletNumber++;
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
                                            <input type="hidden" id="outletNumberInput" name="outletNumber"
                                                value="1">
                                            <div class="row mt-md-4 mt-3">
                                                <div class="col-12">
                                                    <div class="btns d-inline-block">
                                                        <a href="#"><button type="submit"
                                                                class="btn btn-primary waves-effect waves-light">Submit</button></a>
                                                    </div>
                                                    <div class="btns d-inline-block">
                                                        <a href="{{ url('superadmin/customers') }}"><button
                                                                type="button"
                                                                class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                     <!-- end card-body-->
                                </div>
                                 <!-- end card-->
                            </div>
                             <!-- end col -->
                        </div>
                        <!-- end row-->
                    @elseif($layout == 2)
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13"> <a href="{{url('superadmin/customers')}}">Customers</a> > Edit Customers</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">


                                        <form action="{{ url('superadmin/edit-customers/' . $customer['email']) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf

                                            {{-- <input type="hidden" name="password"
                                                value="{{ $customer['password'] }}"> --}}
                                            <div class="row mt-4" id="req_input">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Choose Relationship Manager <span
                                                                style="color: red">*</span></label>
                                                        <select name="relationship_manager" class="form-control mb-3">
                                                            @foreach ($relationship_managers as $item)
                                                            @if($customer['relationship_manager']==$item->email)
                                                            <option value="{{ $customer['relationship_manager']  }}" selected>
                                                                {{$item->name }}
                                                             
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                            @foreach ($relationship_managers as $item)
                                                                <option value="{{ $item->email }}">
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4 form-group">
                                                    <label for="name">Brand name <span
                                                            style="color: red">*</span></label>
                                                    <input type="text" name="brand_name" id="Brandname"
                                                        class="form-control" placeholder="Enter brand name"
                                                        value="{{ $customer['brand_name'] }}">
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label for="name">Business name <span
                                                            style="color: red">*</span></label>
                                                    <input type="text" name="buisness_name"
                                                        value="{{ $customer['buisness_name'] }}" id="Bname"
                                                        class="form-control" placeholder="Enter business name">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="name">Company name <span
                                                            style="color: red">*</span></label>
                                                    <input type="text" name="company_name" id="cName"
                                                        value="{{ $customer['company_name'] }}" class="form-control"
                                                        placeholder="Enter company name">
                                                </div>
                                       
                                                <div class="col-md-4 form-group">
                                                    <label for="name">Email <span
                                                            style="color: red">*</span></label>
                                                    <input type="email" name="email"
                                                        value="{{ $customer['email'] }}" id="email"
                                                        class="form-control" placeholder="Enter Email">
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label for="name">SPOC Name <span
                                                            style="color: red">*</span></label>
                                                    <input type="text" name="spoc_name"
                                                        value="{{ $customer['spoc_name'] }}" id="spocUser"
                                                        class="form-control" placeholder="Enter SPOC Name">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="name">SPOC Contact <span
                                                            style="color: red">*</span></label>
                                                    <input type="number" name="spoc_number"
                                                        value="{{ $customer['spoc_number'] }}" id="spocContact"
                                                        class="form-control" placeholder="Enter SPOC Contact">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="name">Credit Amount (Amount)<span
                                                            style="color: red">*</span></label>
                                                    <input type="number" name="credit_amount" id="creditAmount"
                                                        class="form-control" value="{{ $customer['credit_amount'] }}"
                                                        placeholder="Enter Credit Amount">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="name">Credit Period (Days)<span
                                                            style="color: red">*</span></label>
                                                    <input type="number" name="credit_period" id="creditPeriod"
                                                        class="form-control" value="{{ $customer['credit_period'] }}"
                                                        placeholder="Enter Credit Period">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Customer City <span
                                                                style="color: red">*</span></label>
                                                       
                                                            <select name=customer_city class="form-control">
                                                                <option disabled selected>Select</option>
                                                                <option value="Pune" {{ $customer['customer_city'] == 'Pune' ? 'selected' : '' }}>Pune</option>
                                                                <option value="Mumbai"  {{ $customer['customer_city'] == 'Mumbai' ? 'selected' : '' }}>Mumbai</option>
                                                                <option value="Delhi" {{ $customer['customer_city'] == 'Delhi' ? 'selected' : '' }}>Dilhi</option>
                                                                <option value="Haridwar"  {{ $customer['customer_city'] == 'Haridwar' ? 'selected' : '' }}>Haridwar</option>
                                                                <option value="Navasari"  {{ $customer['customer_city'] == 'Navasari' ? 'selected' : '' }}>Navasari</option>
                                                                <option value="Aurangabad"  {{ $customer['customer_city'] == 'Aurangabad' ? 'selected' : '' }}>Aurangabad</option>
                                                                <option value="Goregaon" {{ $customer['customer_city'] == 'Goregaon' ? 'selected' : '' }}>Goregaon</option>
                                                                <option value="Ghatkopar" {{ $customer['customer_city'] == 'Ghatkopar' ? 'selected' : '' }}>Ghatkopar</option>
                                                                <option value="Lokhandwala" {{ $customer['customer_city'] == 'Lokhandwala' ? 'selected' : '' }}>Lokhandwala</option>
                                                                <option value="RamMandir" {{ $customer['customer_city'] == 'RamMandir' ? 'selected' : '' }}>Ram Mandir</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="name">Photo </label>
                                                    <input type="file" name="photo" id="photo"
                                                        class="form-control" placeholder="Upload Photo" accept="image/png, image/jpeg, image/jpg">
                                                </div>
                                         
                                                @php
                                                    $outlet_name = explode(',', $customer['outlet_name']);
                                                    $outlet_spoc = explode(',', $customer['outlet_spoc']);
                                                    $outlet_spoc = explode(',', $customer['outlet_spoc']);
                                                    $outlet_spoc_number = explode(',', $customer['outlet_spoc_number']);
                                                    $phone = explode(',', $customer['phone']);
                                                    $gst = explode(',', $customer['gst']);
                                                    $product_id = explode(',', $customer['product_id']);
                                                    $discount_price = explode(',', $customer['discount_price']);
                                                    $order_quantity = explode(',', $customer['order_quantity']);
                                                    $document = explode(',', $customer['document']);
                                                    $fda_license_number = explode(',', $customer['fda_license_number']);
                                                    $pincode = explode(',', $customer['pincode']);
                                                    $billing_address = explode(',', $customer['billing_address']);
                                                    $delivery_address = explode(',', $customer['delivery_address']);
                                                    $issuedate = explode(',', $customer['issuedate']);
                                                    $expirydate = explode(',', $customer['expirydate']);
                                                    $outlet_email = explode(',', $customer['outlet_email']);
                                                    $note = explode(',', $customer['note']);
                                                    $state = explode(',', $customer['state']);
                                                    $city = explode(',', $customer['city']);

                                                @endphp

                                                <div class="row px-3 required_inp">


                                                    @for ($i = 0; $i < count($outlet_name); $i++)
                                                        <div class="col-12 form-group">
                                                            <hr>
                                                            <h4>Outlet{{ $i + 1 }}<span></span></h4>
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label for="name">Outlet Name <span
                                                                    style="color: red">*</span></label>
                                                            <input type="text" value="{{ $outlet_name[$i] }}"
                                                                name="outlet_name[]" class="form-control"
                                                                placeholder="Enter Outlet Name">
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label for="name">Outlet SPOC <span
                                                                    style="color: red">*</span></label>
                                                            <input type="text" value="{{ $outlet_spoc[$i] }}"
                                                                name="outlet_spoc[]" class="form-control"
                                                                placeholder="Enter SPOC">
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label for="name">Outlet SPOC Number <span
                                                                    style="color: red">*</span></label>
                                                            <input type="text"
                                                                value="{{ $outlet_spoc_number[$i] }}"
                                                                name="outlet_spoc_number[]" class="form-control"
                                                                placeholder="Enter Number">
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label for="outlet_email">Phone Number <span
                                                                    style="color: red">*</span></label>
                                                            <input type="number" value="{{ $phone[$i] }}"
                                                                name="phone[]" class="form-control"
                                                                placeholder="Enter Number">
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label for="simpleinput">GST Number <span
                                                                    style="color: red">*</span></label>
                                                            <input type="text" value="{{ $gst[$i] }}"
                                                                name="gst[]" class="form-control"
                                                                placeholder="Enter GST Number">
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label for="simpleinput">FDA License Number</label>
                                                            <input type="text"
                                                                value="{{ $fda_license_number[$i] }}"
                                                                name="fda_license_number[]" class="form-control"
                                                                placeholder="Enter FDA Number">
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label for="simpleinput">Date of Issue for FDA <span class="text-danger"> *</span></label>
                                                            <input type="date"
                                                                value="{{ $issuedate[$i] }}"
                                                                name="issuedate[]" class="form-control"
                                                                placeholder="Enter FDA Number">
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label for="simpleinput">Expiry Date for FDA<span class="text-danger"> *</span></label>
                                                            <input type="date"
                                                                value="{{ $expirydate[$i] }}"
                                                                name="expirydate[]" class="form-control"
                                                                placeholder="Enter FDA Number">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="name">Pincode <span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" value="{{ $pincode[$i] }}"
                                                                    name="pincode[]" class="form-control"
                                                                    placeholder="Enter Pincode">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="name">State <span
                                                                        style="color: red">*</span></label>
                                                                <input type="text" value="{{ $state[$i] }}"
                                                                    class="form-control" name="state[]"
                                                                    placeholder="Enter State">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="name">City <span
                                                                        style="color: red">*</span></label>
                                                               
                                                                    <select name=city[] class="form-control">
                                                                        <option disabled selected>Select</option>
                                                                        <option value="Pune" {{ $city[$i] == 'Pune' ? 'selected' : '' }}>Pune</option>
                                                                        <option value="Mumbai"  {{ $city[$i] == 'Mumbai' ? 'selected' : '' }}>Mumbai</option>
                                                                        <option value="Delhi" {{ $city[$i] == 'Delhi' ? 'selected' : '' }}>Dilhi</option>
                                                                        <option value="Haridwar"  {{ $city[$i] == 'Haridwar' ? 'selected' : '' }}>Haridwar</option>
                                                                        <option value="Navasari"  {{ $city[$i] == 'Navasari' ? 'selected' : '' }}>Navasari</option>
                                                                        <option value="Aurangabad"  {{ $city[$i] == 'Aurangabad' ? 'selected' : '' }}>Aurangabad</option>
                                                                        <option value="Goregaon" {{ $city[$i] == 'Goregaon' ? 'selected' : '' }}>Goregaon</option>
                                                                        <option value="Ghatkopar" {{ $city[$i] == 'Ghatkopar' ? 'selected' : '' }}>Ghatkopar</option>
                                                                        <option value="Lokhandwala" {{ $city[$i] == 'Lokhandwala' ? 'selected' : '' }}>Lokhandwala</option>
                                                                        <option value="RamMandir" {{ $city[$i] == 'RamMandir' ? 'selected' : '' }}>Ram Mandir</option>
                                                                    </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="name">Upload Document</label>
                                                                <input name="document[]" type="file"
                                                                    class="form-control"  accept="image/*, .pdf">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="name">Billing Address</label>
                                                                <input type="text"
                                                                    value="{{ $billing_address[$i] }}"
                                                                    name="billing_address[]" class="form-control"
                                                                    placeholder="Enter Billing Address">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="name">Delivery Address</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $delivery_address[$i] }}"
                                                                    name="delivery_address[]"
                                                                    placeholder="Enter Delivery Address">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label for="email">Email address</label>
                                                            <input type="email" value="{{ $outlet_email[$i] }}"
                                                                name="outlet_email[]" class="form-control"
                                                                id="email" placeholder="name@example.com">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="name">Note</label>
                                                                <textarea class="form-control" name="note[]" id="Note" placeholder="Enter Note" cols="30"
                                                                    rows="5">{{ $note[$i] }}</textarea>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                

                                            </div>

                                            {{-- <input type="button" class="inputRemove mx-3 mb-5" value="Remove" /> --}}

                                            <div class="my-3 text-right">
                                                <a href="javascript:void(0)" id="addmore" class="add_input">Add
                                                    Outlet</a>
                                            </div>
                                            <div class="row mt-md-4 mt-3">
                                                <div class="col-12">
                                                   <div class="btns d-inline-block">
                                            <button class="btn btn-primary waves-effect waves-light"
                                                type="submit">Update Customer</button>
                                                   </div>
                                                <div class="btns d-inline-block">
                                                    <a href="{{ url('superadmin/customers') }}"><button
                                                            type="button"
                                                            class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                        for ($i = 0; $i < count($outlet_name); $i++)
                                        {
                                           $existoutletnumber =    $i + 2 ;
                                        }
                                     @endphp
                                            <script src="{{ url('assets/js/jquery.min.js') }}"></script>
                                            <script>
                                                $(document).ready(function() {
                                                    var outletNumber = {{$existoutletnumber}}; // Initialize the outlet number

                                                    $("#addmore").click(function() {
                                                        // Create the new set of fields with the incremented outlet number
                                                        var newFields =
                                                            '<div class="row px-3 required_inp"> <div class="col-12 form-group"><hr><h4>Outlet <span>' +
                                                            outletNumber +
                                                            '</span></h4></div><div class="col-md-4 form-group"><label for="name">Outlet Name</label><input type="text" name="outlet_name[]" class="form-control" placeholder="Enter Outlet Name"></div><div class="col-md-4 form-group"><label for="name">Outlet SPOC</label><input type="text" name="outlet_spoc[]" class="form-control" placeholder="Enter SPOC"></div>    <div class="col-md-4 form-group"><label for="name">Outlet SPOC Number</label><input type="text" name="outlet_spoc_number[]" class="form-control" placeholder="Enter Number"></div><div class="col-md-4 form-group"><label for="simpleinput">Phone Number</label><input type="number" name="phone[]" class="form-control" placeholder="Enter Number"></div><div class="col-md-4 form-group"><label for="simpleinput">GST Number</label><input type="text" name="gst[]" id="gst" class="form-control" placeholder="Enter GST Number"></div><div class="col-md-4 form-group"><label for="simpleinput">FDA license Number <span style="color:red">*</span></label><input type="text" name="fda_license_number[]" class="form-control" placeholder="Enter FDA Number"></div><div class="col-md-4 form-group"><label for="simpleinput">Date of Issue for FDA <span style="color:red">*</span></label><input type="date" name="issuedate[]" class="form-control" placeholder="Enter date of issue" required></div><div class="col-md-4 form-group"><label for="simpleinput">Expiry Date for FDA <span style="color:red">*</span></label><input type="date" name="expirydate[]" class="form-control" placeholder="Enter expiry date" required></div><div class="col-md-4"><div class="form-group"><label for="name">Pincode</label><input type="text" name="pincode[]" class="form-control" placeholder="Enter Pincode"></div></div><div class="col-md-4"><div class="form-group"><label for="name">State</label><input type="text" class="form-control" name="state[]" placeholder="Enter State"></div></div>  <div class="col-md-4"><div class="form-group"><label for="name">City</label><select name=city[] class="form-control"><option disabled selected>Select</option><option value="Pune">Pune</option><option value="Mumbai">Mumbai</option><option value="Delhi">Delhi</option><option value="Haridwar">Haridwar</option><option value="Navasari">Navasari</option><option value="Aurangabad">Aurangabad</option><option value="Goregaon">Goregaon</option><option value="Ghatkopar">Ghatkopar</option><option value="Lokhandwala">Lokhandwala</option><option value="RamMandir">Ram Mandir</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="name">Upload Document</label><input name="document[]" type="file" class="form-control"  accept="image/*, .pdf"></div></div><div class="col-md-4"><div class="form-group"><label for="name">Billing Address</label><input type="text" name="billing_address[]" class="form-control" placeholder="Enter Billing Address"></div></div><div class="col-md-4"><div class="form-group"><label for="name">Delivery Address</label><input type="text" class="form-control" name="delivery_address[]" placeholder="Enter Delivery Address"></div></div><div class="col-md-4 form-group"><label for="email">Email address</label><input type="email" name="outlet_email[]" class="form-control" id="email" placeholder="name@example.com"></div><div class="col-md-12"><div class="form-group"><label for="name">Note</label><textarea  class="form-control" name="note[]" id="Note" placeholder="Enter Note" cols="30" rows="5"></textarea></div></div>' +
                                                            '<input type="button" class="inputRemove mx-3 mb-5" value="Remove"/></div>';

                                                        // Append the new fields to the #req_input div
                                                        $("#req_input").append(newFields);
                                                        // Increment the outlet number for each new set of fields
                                                        outletNumber++;
                                                    });

                                                    $('body').on('click', '.inputRemove', function() {
                                                        // Remove the parent div of the clicked Remove button
                                                        $(this).parent('div.required_inp').remove();
                                                        // Decrement the outlet number when removing a set of fields (if needed)
                                                        outletNumber--;
                                                    });
                                                });
                                            </script>
                                        </form>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->
                    @elseif($layout == 3)
                        <!-- start page title -->
                  
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13"><a href="{{url('superadmin/customers')}}">Customers</a> > Discount Customer</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">


                                        <form
                                            action="{{ url('superadmin/discount-customers/' . $customer['email']) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf



                                            <div class="table-responsive">
                                                <table class="table table-bordered mb-0 mt-4">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Product Name</th>
                                                            <th>MRP</th>
                                                            <th>JDP ( Janis Discount Price )</th>
                                                            <th>Minimum Order Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="myTable">


                                                        @php
                                                            $customer['product_id'] = explode(',', $customer['product_id']);
                                                            $customer['discount_price'] = explode(',', $customer['discount_price']);
                                                            $customer['order_quantity'] = explode(',', $customer['order_quantity']);
                                                        @endphp
                                                        @foreach ($products as $key => $item)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>
                                                                    <input type="hidden" name="product_id[]"
                                                                        value="{{ $item->product_id }}"
                                                                        class="form-control">
                                                                    <input type="text"
                                                                        value="{{ $item->product_name }}"
                                                                        class="form-control">
                                                                </td>

                                                                <td>
                                                                    <input type="text" value="{{ $item->price }}"
                                                                        readonly class="form-control">
                                                                </td>

                                                                     @php
                                                                $discount_price = isset($customer['discount_price'][$key]) && $customer['discount_price'][$key] != null ? $customer['discount_price'][$key] : $item->jsp;
                                                                $order_quantity = isset($customer['order_quantity'][$key]) && $customer['order_quantity'][$key] != null ? $customer['order_quantity'][$key] : $item->min_order_quantity;
                                                            @endphp
                                                                <td>
                                                                    <input type="number" class="form-control"
                                                                        name="discount_price[]"
                                                                        value="{{ $discount_price }}"
                                                                        placeholder="Enter discount price">
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control"
                                                                        value="{{ $order_quantity }}"
                                                                        name="order_quantity[]"
                                                                        placeholder="Enter Order Quantity">
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="row mt-md-4 mt-3">
                                                <div class="col-12">
                                            <div class="btns d-inline-block">
                                            <button class="btn btn-primary waves-effect waves-light"
                                                type="submit">Discount Customer</button>
                                            </div>
                                                <div class="btns d-inline-block">
                                                    <a href="{{ url('superadmin/customers') }}"><button
                                                            type="button"
                                                            class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                                </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->
                        @elseif($layout == 4)
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13"><a href="{{url('superadmin/customers')}}">Customers</a> > All Details</h4>
                                </div>
                            </div>
                        </div>     
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="card-title">Received Orders</h4> -->
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <h3>Customer Details</h3>
                                            </div>
                                                <div class="col-md-6 mb-md-0 mb-4">
                                                    <div class="row mt-5">
                                                        <div class="col-12">
                                                            <div class="details">
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
                                                                        <td><p>Phone Number:</p></td>
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
                                          $todayDate = new  DateTime(date('d-m-Y'));
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
                                                               
                                                                            
                                                              
                                                                    @php
                                                                        $expiryDateObj = new DateTime(date('d-m-Y',strtotime($expirydate[$i])));
                                                                      
                                                                    @endphp

                                                                    @if ($expiryDateObj < $todayDate)
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
                                    </div>
                                    <!-- end card-body-->
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                    @endif



                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    @include('superadmin.footer')
    @if ($layout == 0)
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            $("#search-button").click(function() {
                $.each($("#datatable tbody tr"), function() {

                    if ($(this).text().toLowerCase().indexOf($('#search').val().toLowerCase()) === -1)
                        $(this).hide();
                    else
                        $(this).show();
                });
            });

            function resetFilter() {
                window.location.reload();
            }
        </script>
  
    @endif

</body>

</html>
