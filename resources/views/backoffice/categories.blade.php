@include('backoffice.header')

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <div class="main-content">

            @yield('header')

            @include('backoffice.navbar')
            <div class="page-content">
                <div class="container-fluid">
                    
                  @if($layout==0)
                  <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-13">Categories</h4>
                        </div>
                    </div>
                </div> 

                  
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Categories</h4>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" id="search"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                        </div>
                                                        <div class="mx-3">
                                                            <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                        </div>
                                                    <a href="{{ url('backoffice/add-category') }}"><button type="button" class="btn btn-primary waves-effect waves-light ml-3">Add</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0 mt-4" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Categories</th>
                                                        <th>Sub Category</th>
                                                        <th>Sub Sub Category</th>
                                                        <th>Access</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id='myTable'>
                                                    @isset($category)
                                                        @foreach ($category as $key => $item)
                                                            <tr>
                                                                <td class="mt-2 mr-2">{{ $key + 1 }}</td>
                                                                <td>{{ $item->category_name }}</td>
                                                                <td>{{ $item->sub_category }}</td>
                                                                <td>{{ $item->sub_sub_category }}</td>
                                                                <td>{{ $item->access==1?'Registerd Users':'All users' }}</td>
                                                                <td>
                                                                    <a
                                                                        href="{{ url('backoffice/edit-category/' . $item->id) }}"><button
                                                                            class="btn btn-primary">Edit</button></a>
                                                                    <a
                                                                        href="{{ url('backoffice/delete-category/' . $item->id) }}"><button
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
                       
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13"><a href="{{url('backoffice/category')}}">Categories</a> > Add Categories</h4>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">


                                        <form action="{{ url('backoffice/add-category') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTooltip01"><b> Category <span style="color: red">*</span></b></label>
                                                    <input type="text" class="form-control" id="validationTooltip01"
                                                        name="category_name" placeholder="Enter Category" required>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTooltip01"><b>Sub Category <span style="color: red">*</span></b></label>
                                                    <input type="text" class="form-control" id="validationTooltip01"
                                                        name="sub_category" placeholder="Enter Sub Category" required>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTooltip01"><b>Sub Sub Category <span style="color: red">*</span></b></label>
                                                    <input type="text" class="form-control" id="validationTooltip01"
                                                        name="sub_sub_category" placeholder="Enter Sub Category" required>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTooltip01"><b>Access (optional)</b></label>
                                                    <select name="access" id="" class="form-control" required>
                                                   <option value="">Select Access</option>

                                                        <option value="0">For Everyone</option>
                                                        <option value="1">Registered User</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <button class="btn btn-primary waves-effect waves-light" type="submit"> Add
                                                Category</button>
                                                <div class="btns d-inline-block">
                                                    <a href="{{ url('backoffice/category') }}"><button type="button"
                                                            class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                            </div>
                                        </form>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </div> <!-- end col-->
                        </div> <!-- end row -->
                        <!-- end row-->
                    @elseif($layout == 2)
                     
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13"><a href="{{url('backoffice/category')}}">Categories</a> > Edit Categories</h4>
                                </div>
                            </div>
                        </div> 
                        <div class="row">

                            <div class="col-12">

                               
                                <div class="card">

                                    <div class="card-body">


                                        <form action="{{ url('backoffice/edit-category/' . $category['id']) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTooltip01"><b> Category <span style="color: red">*</span></b></label>
                                                    <input type="text" name="category_name" class="form-control"
                                                        value="{{ $category['category_name'] }}"
                                                        placeholder="Enter Category name" required>

                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTooltip01"><b>Sub Category <span style="color: red">*</span></b></label>
                                                    <input type="text" name="sub_category" class="form-control"
                                                        value="{{ $category['sub_category'] }}"
                                                        placeholder="Enter Sub Category name"required>

                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTooltip01"><b>Sub Sub Category <span style="color: red">*</span></b></label>
                                                    <input type="text" class="form-control" id="validationTooltip01"
                                                        name="sub_sub_category" required placeholder="Enter Sub Category"  value="{{ $category['sub_sub_category'] }}">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTooltip01"><b>Access (optional)</b></label>
                                                    <select name="access" id="" class="form-control" required>
                                                    <option value="">Select Access</option>

                                                        <option value="0"{{ $category['access']==0?'Selected':'' }}>For Everyone</option>
                                                        <option value="1"{{ $category['access']==1?'Selected':'' }}>Registered User</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <br>
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                                Update Category</button>
                                            <div class="btns d-inline-block">
                                                    <a href="{{ url('backoffice/category') }}"><button type="button"
                                                            class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                                            </div>
                                        </form>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </div> <!-- end col-->
                        </div> <!-- end row -->

                        <!-- end row-->

                    @endif

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->


    @include('backoffice.footer')
    @if($layout == 0)
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
       $("#search-button").click(function(){
                  $.each($("#datatable tbody tr"), function() {
  
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
    @endif
</body>

</html>
