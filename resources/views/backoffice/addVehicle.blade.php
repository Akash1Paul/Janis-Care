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
                                    <h4 class="mb-0 font-size-13"><a href="{{url('backoffice/vehicle')}}">Vehicles</a> > Add Vehicle</h4>
                                </div>
                            </div>


                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add Vehicle</h4>
                                        <form action="{{url('backoffice/addvehicle')}}" method="POST">
                                            @csrf
                                            <div class="row mt-4">
                                                <div class="col-md-4 form-group">
                                                    <label for="name">Vehicle Name</label>
                                                    <input type="text" id="Vehicle" name="name" class="form-control" placeholder="Enter Name">
                                                    @error('name')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                                </div>
    
                                                <div class="col-md-4 form-group">
                                                    <label for="Address">Vehicle Number</label>
                                                    <input type="text" id="Number" name="number" class="form-control" placeholder="Enter Number">
                                                    @error('number')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                                </div>
    
                                                <div class="col-md-4 form-group">
                                                    <label for="Address">Vehicle Type</label>
                                                    <input type="text" id="type" name="type" class="form-control" placeholder="Enter Type">
                                                    @error('type')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Choose City Based On WH</label>
                                                        <select class="form-control mb-3" name="warecity" id="warecity">
                                                            <option disabled selected>Select One</option>
                                                            @foreach ($warehouse as $item)
                                                                <option value="{{ $item->city }}">{{ $item->city}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('warecity')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Choose Warehouse</label>
                                                        <select class="form-control mb-3" id="showname" name="warename">
                                                            <option disabled selected>Select One</option>
                                                        </select>
                                                        @error('warename')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>

                                                

                                                <div class="col-md-4 form-group">
                                                    <label for="Address">Driver Name</label>
                                                    <input type="text" id="driver" name="drivarname" class="form-control" placeholder="Driver Name">
                                                    @error('drivarname')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="Address">Driver Number</label>
                                                    <input type="text" name="drivarnumber" id="driverNumber" class="form-control" placeholder="Driver Number">
                                                    @error('drivarnumber')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                                </div>
                                            </div>
                                            
                                                      
                                          <div class="row mt-md-4 mt-3">
                                            <div class="col-12">
                                               <div class="btns d-inline-block">
                                                   <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                               </div>
                                               <div class="btns d-inline-block">
                                                   <a href="{{url('backoffice/vehicle')}}"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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

                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
@include('backoffice.footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    jQuery(document).ready(function() {


        $('#warecity').change(function() {
            var warecity = $('#warecity').val();
            jQuery.ajax({
                url: '{{ url('backoffice/fetch-warename') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    warecity: warecity,
                },
                success: function(response) {
                  
                    $('#showname').html(response);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    alert('Error - ' + errorMessage);
                  
                }
            });
        });
    });
</script>