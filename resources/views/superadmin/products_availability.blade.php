@include('superadmin.header')

<body>
<style>
    
</style>
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

                                                    <a href="{{ url('superadmin/add-product-availability') }}"><button type="button"
                                                            class="btn btn-primary waves-effect waves-light ml-3">Add</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    <form action="{{ url('superadmin/importproductavailabilty') }}"
                                        method="POST"
                                        enctype="multipart/form-data" class="d-flex mt-4 justify-content-end">
                                      @csrf
                                      <input type="file" name="file"
                                             class="form-control" style="width: 30%">
                                      <br>
                                      <button class="btn btn-success ml-3">
                                            Import
                                         </button>
                                      <a class="btn btn-warning ml-3"
                                         href="{{ url('superadmin/exportproductavailabilty') }}">
                                                Export
                                        </a>
                                    </form>

                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0 mt-4" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product Id</th>
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
                                                                <td>{{ $item->city }}</td>

                                                                <td>
                                                                    <a
                                                                        href="{{ url('superadmin/edit-product-availability/' . $item->id) }}"><button
                                                                            class="btn btn-primary"
                                                                            style="color:white">Edit</button></a>
                                                                    <a
                                                                        href="{{ url('superadmin/delete-product-availability/' . $item->id) }}"><button
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
                                    <h4 class="mb-0 font-size-13"><a href="{{url('superadmin/product-availability')}}">Products Availability</a> > Add</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ url('superadmin/add-product-availability') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01"><b>Product <span
                                                                style="color: red">*</span></b></label>
                                                    <select name="product_id" id="" class="form-control">
                                                        <option value="">Select Product</option>
                                                        @foreach ($products as $item)
                                                            <option value="{{ $item->product_id }}">
                                                                {{ $item->product_name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                          
                                               
                                                <div class="col-md-6 mb-3">
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
                                                </div>

                                                <div class="row mt-md-4 mt-3">
                                                <div class="col-12">
                                                <div class="btns d-inline-block">
            
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                                    Add City</button>
                                                </div>
                                                        <div class="btns d-inline-block">
                                                            <a href="{{url('superadmin/product-availability')}}"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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
                        <h4 class="mb-0 font-size-13"><a href="{{url('superadmin/product-availability')}}">Products Availability</a> > Edit Pincodes</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ url('superadmin/edit-product-availability/' . $products_availability['id']) }}" method="POST"
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

                                    <div class="col-md-6 mb-3">
                                        <label for="validationTooltip01"><b> City <span
                                                    style="color: red">*</span></b></label>
                                      
                                        <select name="city" id="city" class="form-control"  value="{{ old('city') }}" >
                                                <option value="" disabled selected>Select</option>
                                                <option value="pune" {{ $products_availability['city'] == 'Pune' ? 'selected' : '' }}>Pune</option>
                                                <option value="aurangabad" {{ $products_availability['city'] == 'Aurangabad' ? 'selected' : '' }}>Aurangabad</option>
                                                <option value="mumbai" {{ $products_availability['city'] == 'Mumbai' ? 'selected' : '' }}>Mumbai</option>
                                                <option value="dilhi" {{ $products_availability['city'] == 'Dilhi' ? 'selected' : '' }}>Dilhi</option>
                                                <option value="haidwar" {{ $products_availability['city'] == 'Haidwar' ? 'selected' : '' }}>Haidwar</option>
                                                <option value="navasari" {{ $products_availability['city'] == 'Navasari' ? 'selected' : '' }}>Navasari</option>
                                            </select>
                                        <span class="text-danger">
                                            @error('city')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="row mt-md-4 mt-3">
                                        <div class="col-12">
                                    <div class="btns d-inline-block">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Update city</button>
                                    </div>
                                        <div class="btns d-inline-block">
                                            <a href="{{url('superadmin/product-availability')}}"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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
                            url: '{{ url('superadmin/filter-city') }}',
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

    @endif

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

    @include('superadmin.footer')

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
   
</body>

</html>
