@include('admin.header')

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <div class="main-content">
            @yield('header')
            @yield('topnav')

            @if ($layout == 0)

                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13">Products Availability</h4>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Products Availability</h4>
                                            <div>

                                                <div class="input-group">
                                                    <input type="text" id="search" class="form-control"
                                                        placeholder="Search ..." aria-label="Recipient's username">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="search-button"><i
                                                                class="mdi mdi-magnify"></i></button>
                                                    </div>
                                                 
                                                    <div class="mx-2">
                                                        <select class="form-control mx-2" id="city">
                                                            <option value="" selected disabled>Select City
                                                            </option>
                                                            <option value="all">All</option>
                                                            {{-- @foreach ($products_availability as $key => $item)
                                                            <option value="{{ $item->city }}">{{ $item->city }}</option>
                                                            @endforeach --}}
                                                            <option value="Pune">Pune</option>
                                                            <option value="Aurangabad">Aurangabad</option>
                                                            <option value="Mumbai">Mumbai</option>
                                                            <option value="Dilhi">Dilhi</option>
                                                            <option value="Haidwar">Haidwar</option>
                                                            <option value="Navasari">Navasari</option>
                                                        </select>
                                                    </div>
                                                  
                                                    <div class="mx-3">
                                                        <a><button class="btn btn-primary waves-effect waves-light"
                                                            onClick="window.location.reload();">Reset</button></a>
                                                    </div>

                                                    <a href="{{ url('admin/add-product-availability') }}"><button type="button"
                                                            class="btn btn-primary waves-effect waves-light ml-3">Add</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    <form action="{{ url('admin/importproductavailabilty') }}"
                                        method="POST"
                                        enctype="multipart/form-data" class="d-flex mt-4 justify-content-end">
                                      @csrf
                                      <input type="file" name="file"
                                             class="form-control" style="width: 30%" required accept=".xls, .xlsx">
                                      <br>
                                      <button class="btn btn-success ml-3">
                                            Import
                                         </button>
                                      <a class="btn btn-warning ml-3"
                                         href="{{ url('admin/exportproductavailabilty') }}">
                                                Export
                                        </a>
                                    </form>

                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0 mt-4" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product Id</th>
                                                        <th>Product Name</th>
                                                        <th>City</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="myTable">
                                                    @isset($products_availability)
                                                        @foreach ($products_availability as $key => $item)
                                                            <tr rowspan='2'>
                                                                <td class="mt-2 mr-2">{{ $key + 1 }}</td>
                                                                <td>{{ $item->product_id }}</td>
                                                            @foreach($products as $prod)
                                                                @if($item->product_id == $prod->product_id)
                                                                <td>{{ $prod->product_name ? $prod->product_name:' '}}</td>
                                                                @endif
                                                            @endforeach
                                                                <td>{{ $item->city }}</td>
                                                                <td>
                                                                    <a
                                                                        href="{{ url('admin/edit-product-availability/' . $item->id) }}"><button
                                                                            class="btn btn-primary"
                                                                            style="color:white">Edit</button></a>
                                                                    <a
                                                                        href="{{ url('admin/delete-product-availability/' . $item->id) }}"><button
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
                    </div>
                </div>
            @elseif($layout == 1)

                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13"><a href="{{url('admin/product-availability')}}">Products Availability</a> > Add</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ url('admin/add-product-availability') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                           

                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01"><b>Product <span
                                                                style="color: red">*</span></b></label>
                                                    <select name="product_id" id="" class="form-control select2">
                                                        <option value="">Select Product</option>
                                                        @foreach ($products as $item)
                                                            <option value="{{ $item->product_id }}">
                                                                {{ $item->product_name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                                {{-- <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01"><b>City<span
                                                                style="color: red">*</span></b></label>
                                                                <select name="city[]"  class="form-control" value="{{ old('city') }}"  multiple  id="choices-multiple-remove-button" placeholder="Select upto 5 City">
                                                                    <option value="Pune">Pune</option>
                                                                    <option value="Aurangabad">Aurangabad</option>
                                                                    <option value="Mumbai">Mumbai</option>
                                                                    <option value="Dilhi">Dilhi</option>
                                                                    <option value="Haidwar">Haidwar</option>
                                                                    <option value="Navasari">Navasari</option>
                                                                </select>
                                                </div> --}}
                                                <script src="{{url('cities.js')}}"></script>

                                                <div class="col-md-3 mb-3">
                                                    <label for="state"><b>Select State<span
                                                        style="color: red">*</span></b></label>
                                                    <select onchange="print_city('state', this.selectedIndex);" id="sts" name ="stt" class="form-control" required></select>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <label for="state"><b>Select City<span
                                                        style="color: red">*</span></b></label>
                                                    <select id ="state" name="city[]" class="form-control" required></select>
                                                </div>

                                                <script language="javascript">print_state("sts");</script>


                                                <div class="row mt-md-4 mt-3">
                                                <div class="col-12">
                                                <div class="btns d-inline-block">
            
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                                    Add City</button>
                                                </div>
                                                        <div class="btns d-inline-block">
                                                            <a href="{{url('admin/product-availability')}}"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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
                    </div>
                </div>

        </div>
    </div>
@elseif($layout == 2)
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-13"><a href="{{url('admin/product-availability')}}">Products Availability</a> > Edit Pincodes</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ url('admin/edit-product-availability/' . $products_availability['id']) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationTooltip01"><b>Product Id <span
                                                    style="color: red">*</span></b></label>
                                        <select name="product_id" id="" class="form-control">
                                            <option value="">Select ProductId</option>
                                            @foreach ($products as $item)
                                                <option
                                                    value="{{ $item->product_id }}"{{ $item->product_id == $products_availability['product_id'] ? 'selected' : '' }}>
                                                    {{ $item->product_name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                
                                    <script src="{{url('cities.js')}}"></script>

                                    <div class="col-md-3 mb-3">
                                        <label for="state"><b>Select State<span
                                            style="color: red">*</span></b></label>
                                        <select onchange="print_city('state', this.selectedIndex);" id="sts" name ="stt" class="form-control" required></select>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="state"><b>Select City<span
                                            style="color: red">*</span></b></label>
                                        <select id ="state" name="city[]" class="form-control" required>
                                            <option value=" $products_availability['city'] ">{{ $products_availability['city'] }}</option>
                                        </select>
                                    </div>

                                    <script language="javascript">print_state("sts");</script>
                                    <div class="row mt-md-4 mt-3">
                                        <div class="col-12">
                                    <div class="btns d-inline-block">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Update city</button>
                                    </div>
                                        <div class="btns d-inline-block">
                                            <a href="{{url('admin/product-availability')}}"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                        </div>
                                    </div>
                                </div>
                            </form>


                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>

        </div>
    </div>
    @endif

    </div>

    </div>

    <!-- END layout-wrapper -->

    @if ($layout == 0)
        <script>
            jQuery(document).ready(function() {
                $('#city').change(function() {
                    var city = $('#city').val();
                    if (city == 'all') {
                        window.location.reload();
                    } else {
                        jQuery.ajax({
                            url: '{{ url('admin/filter-city') }}',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                city: city,
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
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $('.select2').select2();
        $('.select').select2();
    </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.js'></script>
    <script src="{{ url('/assets/imageGalleryScript.js') }}"></script>
    <script>
        $(document).ready(function(){
        
        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
        removeItemButton: true,
        maxItemCount:5,
        searchResultLimit:5,
        renderChoiceLimit:5
        }); 
        
        
        });
    </script>
    @include('admin.footer')

</body>

</html>
