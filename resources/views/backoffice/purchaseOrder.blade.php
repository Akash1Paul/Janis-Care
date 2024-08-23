@include('backoffice.header')

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <div class="main-content">

            @yield('header')
            @include('backoffice.navbar')

            @if ($layout == 0)
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
                                                        <input type="text" id="search" class="form-control"
                                                            placeholder="Search ..." aria-label="Recipient's username">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" id="search-button"><i
                                                                    class="mdi mdi-magnify"></i></button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mx-3">
                                                    <a><button class="btn btn-primary waves-effect waves-light"
                                                            onclick="resetFilter()">Reset</button></a>
                                                </div>
                                                <a href="{{ url('backoffice/add-purchase') }}"><button type="button"
                                                        class="btn btn-primary waves-effect waves-light">Add</button></a>

                                            </div>
                                        </div>
                                        <div class="table-responsive mt-4">
                                            <table class="table table-bordered mb-0" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Vender Name</th>
                                                        <th>Purchase Id</th>
                                                        <th>Warehouse</th>
                                                        <th>Invoice</th>
                                                        <th>Details</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="myTable">
                                                    @foreach ($purchase as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                                            <td>{{ $item->vendor_name }}</td>
                                                            <td>{{ $item->purchase_id }}</td>

                                                            <td>

                                                                @foreach ($warename as $ware)
                                                                    @if ($ware->email == $item->warehouse_email)
                                                                        {{ $ware->name }}
                                                                    @endif
                                                                @endforeach

                                                            </td>

                                                            @if ($item->invoice != null && $item->invoice != '')
                                                                <td>
                                                                    <a href="{{ url('backoffice/showpdf/' . $item->purchase_id) }}"
                                                                        target="_blank">
                                                                        <button type="button"
                                                                            class="btn fa fa-file-pdf"
                                                                            style="color: red;font-size:25px;"></button>
                                                                    </a>
                                                                </td>
                                                                {{-- <td><button  type="button" data-toggle="modal" data-target="#InvoiceModal{{$item->id}}" class="btn fa fa-file-pdf" style="color: red;font-size:25px;"></button></td> --}}
                                                            @else
                                                                <td>
                                                                    <button type="button" class="btn btn-success"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModal{{ $item->purchase_id }}">Upload</button>
                                                                </td>
                                                            @endif
                                                            <td>
                                                                <a
                                                                    href="{{ url('backoffice/purchaseorderdetails/' . $item->purchase_id) }}">
                                                                    <button type="button"
                                                                        class="btn btn-primary waves-effect waves-light">
                                                                        <i class="fas fa-eye"></i></button>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="{{ url('backoffice/edit-purchaseorders/' . $item->purchase_id) }}">
                                                                    <button type="button"
                                                                        class="btn btn-primary waves-effect waves-light">Edit</button>
                                                                </a>
                                                                <a href="{{ url('backoffice/delete-purchaseorders/' . $item->purchase_id) }}"
                                                                    onclick="return confirm('Are you sure to delete?')">
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light">Delete</button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        @foreach ($purchase as $index => $item)
                                            <div class="modal fade" id="exampleModal{{ $item->purchase_id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Upload
                                                                Invoice</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ url('backoffice/upload-invoice/' . $item->purchase_id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="manufacturer">Invoice<span
                                                                            style="color: red">*</span></label>
                                                                    <input type="file" name="invoice"
                                                                        class="form-control">
                                                                    <small id="emailHelp"
                                                                        class="form-text text-muted"><span
                                                                            style="color: red">*</span>Upload Only
                                                                        PDF</small>
                                                                </div>
                                                                @error('invoice')
                                                                    <span style="color:red">{{ $message }}</span>
                                                                @enderror

                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Save</button>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                    </div>
            @endforeach
            @foreach ($purchase as $index => $item)
                <div class="modal fade" id="InvoiceModal{{ $item->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ url('invoice/' . $item->invoice) }}" alt="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
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
    </div>
    <!--end row-->

    </div>
@elseif($layout == 1)
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-13"><a href="{{ url('backoffice/purchaseorders') }}">Purchase</a> >
                            Add Purchase Orders</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Purchase Orders</h4>


                            <form action="{{ url('backoffice/add-purchaseorder') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-md-4" id="chooseWH">
                                        <div class="form-group">
                                            <label for="warehouse_email">Choose Warehouse<span
                                                    style="color: red">*</span></label>
                                            <select class="form-control mb-3" name="warehouse_email">
                                                <option disabled selected>Select One</option>
                                                @foreach ($warehouse as $item)
                                                    <option value="{{ $item->email }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('warehouse_email')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="qty">Vendor Name <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Vendor Name" name="vendor_name">
                                            @error('vendor_name')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="qty">Address <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Address"
                                                name="address">
                                            @error('address')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="GSTIN Number">GSTIN Number <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter GSTIN"
                                                name="gstin_number">
                                            @error('gstin_number')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact_number">Contact Number <span
                                                    style="color: red">*</span></label>
                                            <input type="number" class="form-control"
                                                placeholder="Enter Contact Number" name="contact_number">
                                            @error('contact_number')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="my-3 text-right">
                                    <a href="javascript:void(0)" id="addmore" class="btn btn-primary"><b>+</b></a>
                                </div>

                                <div class="row mt-4" id="req_input">
                                    <div class="col-12 form-group">
                                        <hr>
                                        <h4>Product <span>1</span></h4>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label for="product_name">Product Name <span
                                                    style="color: red">*</span></label>

                                            <select class="form-control select0" name="product_name[]"
                                                id="product_id">
                                                <option value="" selected disabled>Select</option>
                                                @foreach ($products as $item)
                                                    <option value="{{ $item->product_id }}">{{ $item->product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('product_name')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="manufacturer">Manufacturer<span
                                                    style="color: red">*</span></label>

                                            <input type="text" name="manufacturer[]" class="form-control"
                                                placeholder="Enter Manufacturer" id="manufacturer">
                                            @error('manufacturer')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="packsize">Pack Size<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Pack Size"
                                                name="packsize[]" id="packsize">
                                            @error('packsize')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hsn">HSN Number<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter HSN Number"
                                                name="hsn[]" id="hsn">
                                            @error('hsn')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mrp">MRP<span style="color: red">*</span></label>
                                            <input type="number" class="form-control" placeholder="Enter MRP"
                                                name="mrp[]" id="mrp">
                                            @error('mrp')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="rate">Rate<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Rate"
                                                name="rate[]" id="rate">
                                            @error('rate')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="qty">QTY <span style="color: red">*</span></label>
                                            <input type="number" class="form-control" placeholder="Enter QTY"
                                                name="qty[]" id="qty">
                                            @error('qty')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="qty">GST <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter GST"
                                                name="gst[]" id="gst">
                                            @error('gst[]')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>




                                    <link
                                        href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"
                                        rel="stylesheet" />
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
                                    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
                                    <script>
                                        $(document).ready(function() {
                                            var Purchase_Number = 2; // Initialize the outlet number
                                            var itarate = 1;
                                            $("#addmore").click(function() {
                                                // Create the new set of fields with the incremented outlet number
                                                var newFields =
                                                    '<div class="row px-3 required_inp"> <div class="col-12 form-group"><hr><h4>Product <span>' +
                                                    Purchase_Number +
                                                    '</span></h4></div><div class="col-md-4 form-group"><label for="name">Product Name <span style="color:red">*</span></label><select class="form-control select' +
                                                    itarate + '" name="product_name[]" id="product_id' + itarate +
                                                    '"></select></div><div class="col-md-4 form-group"><label for="name">Manufacturer<span style="color:red">*</span></label><input type="text" name="manufacturer[]" id="manufacturer' +
                                                    itarate +
                                                    '" class="form-control" placeholder="Enter Manufacturer"></div><div class="col-md-4 form-group"><label for="name">Pack Size<span style="color:red">*</span></label><input type="text" name="packsize[]" id="packsize' +
                                                    itarate +
                                                    '" class="form-control" placeholder="Enter Pack Size"></div><div class="col-md-4 form-group"><label for="simpleinput">HSN Number<span style="color:red">*</span></label><input type="number" name="hsn[]" id="hsn' +
                                                    itarate +'" class="form-control" placeholder="Enter HSN Number"></div><div class="col-md-4 form-group"><label for="simpleinput">MRP<span style="color:red">*</span></label><input type="number" name="mrp[]"  id="mrp' +
                                                    itarate +
                                                    '" class="form-control" placeholder="Enter MRP"></div><div class="col-md-4 form-group"><label for="simpleinput">Rate<span style="color:red">*</span></label><input type="text" name="rate[]" class="form-control" placeholder="Enter Rate"></div><div class="col-md-4"><div class="form-group"><label for="name">QTY<span style="color:red">*</span></label><input type="text" name="qty[]" class="form-control" placeholder="Enter QTY"></div></div><div class="col-md-4"><div class="form-group"><label for="name">GST<span style="color:red">*</span></label><input type="text" name="gst[]" class="form-control" placeholder="Enter GST"></div></div>' +
                                                    '<input style="margin-top:25px;" type="button" class="inputRemove mx-3 mb-5" value="-"/></div>';

                                                // Append the new fields to the #req_input div
                                                $("#req_input").append(newFields);
                                                // Increment the outlet number for each new set of fields
                                                $('#product_id' + itarate).change(function() {
                                                    var new_itarate = itarate-1
                                                    var product_id = $(this).val();
                                                    //alert(product_id);
                                                    jQuery.ajax({
                                                        url: '{{ url('backoffice/getproductdetails') }}',
                                                        type: 'POST',
                                                        headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                        },
                                                        data: {

                                                            product_id: product_id,

                                                        },
                                                        success: function(response) {
                                                           
                                                            $('#manufacturer' + new_itarate).val(response.manufacturer);
                                                            $('#packsize' + new_itarate).val(response.packsize);
                                                            $('#mrp' + new_itarate).val(response.mrp);
                                                            $('#hsn' + new_itarate).val(response.hsncode);
                                                        }
                                                       // 
                                                    });
                                                });
                                                Purchase_Number++;
                                            });

                                           

                                            $('body').on('click', '.inputRemove', function() {
                                                // Remove the parent div of the clicked Remove button
                                                $(this).parent('div.required_inp').remove();
                                                // Decrement the outlet number when removing a set of fields (if needed)
                                                Purchase_Number--;
                                            });


                                            $('#addmore').click(function() {
                                                $.ajax({
                                                    type: "GET",
                                                    url: "{{ url('backoffice/getproduct') }}",
                                                    dataType: "json",
                                                    success: function(data) {
                                                        //alert(itarate);
                                                        //console.log("#product_id" + itarate);
                                                        $('#product_id' + itarate).find('option').remove();
                                                        $("#product_id" + itarate).append(
                                                            `<option value='' disabled="disabled" selected>Select</option>`);
                                                        $.each(data, function(key, info) {

                                                            $("#product_id" + itarate).append(
                                                                `<option value=${info.product_id}>${info.product_name}</option>`
                                                                );

                                                        });
                                                        $('.select'+itarate).select2();
                                                        itarate++;

                                                    },
                                                    error: function(data) {
                                                        alert('error');
                                                    }
                                                });
                                                
                                            });
                                          
                                        });
                                    </script>
                                    <link
                                        href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"
                                        rel="stylesheet" />
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
                                    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
                                </div>


                                <div class="row mt-md-4 mt-3">
                                    <div class="col-12">
                                        <div class="btns d-inline-block">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">Submit</button>
                                        </div>
                                        <div class="btns d-inline-block">
                                            <a href="{{ url('backoffice/purchaseorders') }}"><button type="button"
                                                    class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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
    </div>
    <!-- container-fluid -->
    </div>


    <!-- End Page-content -->
@elseif($layout == 2)
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-13"><a href="{{ url('backoffice/purchaseorders') }}">Purchase</a> >
                            Edit Purchase Orders</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Purchase Order</h4>
                            <form action="{{ url('backoffice/edit-purchaseorders/' . $purchase->purchase_id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Purchase Id</label>
                                            <input type="text" name="purchase_id" class="form-control"
                                                value="{{ $purchase->purchase_id }}" readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-4" id="chooseWH">
                                        <div class="form-group">
                                            <label for="warehouse_email">Choose Warehouse<span
                                                    style="color: red">*</span></label>
                                            <select class="form-control mb-3" name="warehouse_email">


                                                @foreach ($warehouse as $item)
                                                    @if ($item->email == $purchase->warehouse_email)
                                                        <option value="{{ $purchase->warehouse_email }}" selected>
                                                            {{ $item->name }}</option>
                                                    @endif

                                                    <option value="{{ $item->email }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('warehouse_email')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="qty">Vendor Name <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Vendor Name" name="vendor_name"
                                                value="{{ $purchase->vendor_name }}">
                                            @error('vendor_name')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="qty">Address <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Address"
                                                name="address" value="{{ $purchase->address }}">
                                            @error('address')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="GSTIN Number">GSTIN Number <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter GSTIN"
                                                name="gstin_number" value="{{ $purchase->gstin_number }}">
                                            @error('gstin_number')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact_number">Contact Number <span
                                                    style="color: red">*</span></label>
                                            <input type="number" class="form-control"
                                                placeholder="Enter Contact Number" name="contact_number"
                                                value="{{ $purchase->contact_number }}">
                                            @error('contact_number')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                {{-- <div class="my-3 text-right">
                                                    <a href="javascript:void(0)" id="addmore" class="btn btn-primary"><b>+</b></a>
                                                </div> --}}
                                <div class="row mt-4 required_inp" id="req_input">
                                    @for ($i = 0; $i < count($purchasedeatails); $i++)
                                        <input type="hidden" class="form-control" name="id[]" id="id"
                                            value="{{ $purchasedeatails[$i]->id }}">

                                        <div class="col-12 form-group">
                                            <hr>
                                            <h4>Product <span>{{ $i + 1 }}</span></h4>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="product_name">Product Name <span
                                                        style="color: red">*</span></label>

                                                <select class="form-control" name="product_name[]" id="product_id">

                                                    @foreach ($products as $item)
                                                        @if ($item->product_id == $purchasedeatails[$i]->product_name)
                                                            <option value="{{ $item->product_id }}" selected>
                                                                {{ $item->product_name }}</option>
                                                        @endif
                                                        <option value="{{ $item->product_id }}">
                                                            {{ $item->product_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('product_name')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="manufacturer">Manufacturer<span
                                                        style="color: red">*</span></label>

                                                <input type="text" name="manufacturer[]" class="form-control"
                                                    placeholder="Enter Manufacturer" id="manufacturer"
                                                    value="{{ $purchasedeatails[$i]->manufacturer }}">
                                                @error('manufacturer')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="packsize">Pack Size<span
                                                        style="color: red">*</span></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Pack Size" name="packsize[]" id="packsize"
                                                    value="{{ $purchasedeatails[$i]->packsize }}">
                                                @error('packsize')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="hsn">HSN Number<span
                                                        style="color: red">*</span></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter HSN Number" name="hsn[]" id="hsn"
                                                    value="{{ $purchasedeatails[$i]->hsn }}">
                                                @error('hsn')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mrp">MRP<span style="color: red">*</span></label>
                                                <input type="number" class="form-control" placeholder="Enter MRP"
                                                    name="mrp[]" id="mrp"
                                                    value="{{ $purchasedeatails[$i]->mrp }}">
                                                @error('mrp')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rate">Rate<span style="color: red">*</span></label>
                                                <input type="number" class="form-control" placeholder="Enter Rate"
                                                    name="rate[]" id="rate"
                                                    value="{{ $purchasedeatails[$i]->rate }}">
                                                @error('rate')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="qty">QTY <span style="color: red">*</span></label>
                                                <input type="number" class="form-control" placeholder="Enter QTY"
                                                    name="qty[]" id="qty"
                                                    value="{{ $purchasedeatails[$i]->qty }}">
                                                @error('qty')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="qty">GST <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter GST"
                                                    name="gst[]" id="gst"  value="{{ $purchasedeatails[$i]->gst }}">
                                                @error('gst[]')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                <script src="{{ url('assets/js/jquery.min.js') }}"></script>
                                <script>
                                    $(document).ready(function() {
                                        var Purchase_Number = {{ $i + 1 }}; // Initialize the outlet number

                                        $("#addmore").click(function() {
                                            // Create the new set of fields with the incremented outlet number
                                            var newFields =
                                                '<div class="row px-3 required_inp"> <div class="col-12 form-group"><hr><h4>Product <span>' +
                                                Purchase_Number +
                                                '</span></h4></div><div class="col-md-4 form-group"><label for="name">Product Name <span style="color:red">*</span></label><input type="text" name="product_name[]" id="product_ids' +
                                                Purchase_Number +
                                                '" class="form-control" placeholder="Enter Product Name"></div><div class="col-md-4 form-group"><label for="name">Manufacturer<span style="color:red">*</span></label><input type="text" name="manufacturer[]" id="manufacturer" class="form-control" placeholder="Enter Manufacturer"></div><div class="col-md-4 form-group"><label for="name">Pack Size<span style="color:red">*</span></label><input type="text" name="packsize[]" class="form-control" placeholder="Enter Pack Size"></div><div class="col-md-4 form-group"><label for="simpleinput">HSN Number<span style="color:red">*</span></label><input type="number" name="hsn[]" class="form-control" placeholder="Enter HSN Number"></div><div class="col-md-4 form-group"><label for="simpleinput">MRP<span style="color:red">*</span></label><input type="number" name="mrp[]" class="form-control" placeholder="Enter MRP"></div><div class="col-md-4 form-group"><label for="simpleinput">Rate<span style="color:red">*</span></label><input type="number" name="rate[]" class="form-control" placeholder="Enter Rate"></div><div class="col-md-4"><div class="form-group"><label for="name">QTY<span style="color:red">*</span></label><input type="text" name="qty[]" class="form-control" placeholder="Enter QTY"></div></div>' +
                                                '<input style="margin-top:25px;" type="button" class="inputRemove mx-3 mb-5" value="-"/></div>';

                                            // Append the new fields to the #req_input div
                                            $("#req_input").append(newFields);
                                            // Increment the outlet number for each new set of fields

                                            $(document).ready(function() {

                                                $('#product_ids' + Purchase_Number).change(function() {

                                                    const product_id = $('#product_ids' + Purchase_Number).val();

                                                    jQuery.ajax({
                                                        url: '{{ url('backoffice/getproductdetails') }}',
                                                        type: 'POST',
                                                        headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                                                'content')
                                                        },
                                                        data: {

                                                            product_id: product_id,

                                                        },
                                                        success: function(response) {
                                                            $('#manufacturer').val(response.manufacturer);
                                                            $('#packsize').val(response.packsize);
                                                            $('#mrp').val(response.mrp);
                                                        }
                                                    });
                                                });

                                            });
                                            Purchase_Number++;
                                        });

                                        $('body').on('click', '.inputRemove', function() {
                                            // Remove the parent div of the clicked Remove button
                                            $(this).parent('div.required_inp').remove();
                                            // Decrement the outlet number when removing a set of fields (if needed)
                                            Purchase_Number--;

                                        });
                                    });
                                </script>

                                <div class="row mt-md-4 mt-3">
                                    <div class="col-12">
                                        <div class="btns d-inline-block">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">Submit</button>
                                        </div>
                                        <div class="btns d-inline-block">
                                            <a href="{{ url('backoffice/purchaseorders') }}"><button type="button"
                                                    class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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
    </div>
    <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @endif

    </div>
    <!-- End Page-content -->
    </div>
    <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    @include('backoffice.footer')
    @if ($layout == 0)
        <script>
            jQuery(document).ready(function() {

                $('#roles').change(function() {
                    var roles = $('#roles').val();
                    if (roles == 'allroles') {
                        window.location.reload();
                    } else {


                        jQuery.ajax({
                            url: '{{ url('superadmin/filter-roles') }}',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                roles: roles,
                            },
                            success: function(response) {

                                $('#myTable').html(response.data);
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
            function resetFilter() {
                window.location.reload();
            }
        </script>
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
        </script>
    @elseif($layout == 1)
        <script>
            $(document).ready(function() {

                $('#product_id').change(function() {

                    const product_id = $('#product_id').val();

                    jQuery.ajax({
                        url: '{{ url('backoffice/getproductdetails') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {

                            product_id: product_id,

                        },
                        success: function(response) {
                            $('#manufacturer').val(response.manufacturer);
                            $('#packsize').val(response.packsize);
                            $('#mrp').val(response.mrp);
                            $('#hsn').val(response.hsncode);
                        }
                    });
                });


            });
        </script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script>
            $('.select0').select2();
        </script>
    @endif

</body>

</html>
