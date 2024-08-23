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
                                    <h4 class="mb-0 font-size-13"><a href="{{url('warehouse/runner')}}">Runner</a> > Add Runner</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add Runner</h4>
                                        <form action="{{url('warehouse/addrunner')}}" method="post" enctype="multipart/form-data">
                                            <input type="text" name="roles" value="runner" hidden>
                                            @csrf
                                            <div class="row mt-4">
                                                <div class="col-md-4 form-group">
                                                    <label for="name">Emp Id<span style="color: red"> *</span></label>
                                                    <input type="text" id="empid" name="empid" class="form-control" placeholder="Enter Emp Id" value="{{ old('empid') }}">
                                                    <span class="text-danger">
                                                        @error('empid'){{$message}}@enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="name">Name<span style="color: red"> *</span></label>
                                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}">
                                                    <span class="text-danger">
                                                        @error('name'){{$message}}@enderror
                                                    </span>
                                                </div>
                                                
                                                <div class="col-md-4 form-group">
                                                    <label for="simpleinput">Phone Number<span style="color: red"> *</span></label>
                                                    <input type="text" name="phone" id="phone" class="form-control" maxlength="10" minlength="10" placeholder="Enter Number" value="{{ old('phone') }}">
                                                    <span class="text-danger">
                                                        @error('phone'){{$message}}@enderror
                                                      </span>
                                                </div>
    
                                               
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Work Address<span style="color: red"> *</span></label>
                                                        <input type="text" name="workaddress" class="form-control" placeholder="Enter Work Address"  value="{{ old('workaddress') }}">
                                                        <span class="text-danger">
                                                            @error('workaddress'){{$message}}@enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Home Address<span style="color: red"> *</span></label>
                                                        <input type="text" name="homeaddress" class="form-control" placeholder="Enter Home Address" value="{{ old('homeaddress') }}">
                                                        <span class="text-danger">
                                                            @error('homeaddress'){{$message}}@enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Upload Address Proof Document<span style="color: red"> *</span></label>
                                                        <input type="file" name="addressproof" class="form-control" value="{{ old('homeaddress') }}">
                                                        <span class="text-danger">
                                                            @error('addressproof'){{$message}}@enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Upload Age Proof Document <span style="color: red"> *</span></label>
                                                        <input type="file" name="document" class="form-control"  value="{{ old('document') }}">
                                                        <span class="text-danger">
                                                            @error('document'){{$message}}@enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                        
                                                <div class="col-md-4 form-group">
                                                    <label for="email">Email address<span style="color: red"> *</span></label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}">
                                                    <span class="text-danger">
                                                        @error('email'){{$message}}@enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="email">Password<span style="color: red"> *</span></label>
                                                    <input type="text" class="form-control" name="password" id="password" placeholder="Password">
                                                    <span class="text-danger">
                                                        @error('password'){{$message}}@enderror
                                                    </span>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Note</label>
                                                        <textarea  class="form-control" name="note" id="Note" placeholder="Enter Note" cols="30" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                                      
                                          <div class="row mt-md-4 mt-3">
                                            <div class="col-12">
                                               <div class="btns d-inline-block">
                                                   <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                               </div>
                                               <div class="btns d-inline-block">
                                                   <a href="{{url('warehouse/runner')}}"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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