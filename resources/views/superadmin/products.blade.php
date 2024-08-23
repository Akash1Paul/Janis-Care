@include('superadmin.header')

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
                                    <h4 class="mb-0 font-size-13">Products</h4>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Products</h4>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" id="search" class="form-control" required
                                                        placeholder="Search ..." aria-label="Recipient's username">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="search-button"><i
                                                                class="mdi mdi-magnify"></i></button>
                                                    </div>

                                                    
                                                    <a href="{{ url('superadmin/add-product') }}"><button type="button"
                                                            class="btn btn-primary waves-effect waves-light ml-3">Add</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{url('superadmin/filter-products')}}" method="POST">
                                            @csrf
                                        <div class="d-flex justify-content-between mt-3 float-right">
                                            <div>
                                                <div class="input-group">
                                            <div class="mx-2">
                                                <select class="form-control mx-2" id="categories" name="category">
                                                    <option value="" selected disabled>Select Category</option>
                                                    {{-- <option value="all">All</option> --}}
                                                    @foreach ($categories as $item)
                                                        <option value="{{ $item->category_name }}">
                                                            {{ $item->category_name }}</option>
                                                    @endforeach
    
                                                </select>
                                            </div>
                                            <div class="mx-2">
                                                <select class="form-control mx-2" id="sub_categories" name="sub_category">
                                                    <option value="" selected disabled>Select Sub Category</option>
                                                    {{-- <option value="all">All</option> --}}
                                                    @foreach ($categories as $item)
                                                        <option value="{{ $item->sub_category }}">
                                                            {{ $item->sub_category }}</option>
                                                    @endforeach
    
                                                </select>
                                            </div>
                                            <div class="mx-2">
                                                <select class="form-control mx-2" id="sub_sub_categories" name="sub_sub_category">
                                                    <option value="" selected disabled>Select Sub Sub Category</option>
                                                    {{-- <option value="all">All</option> --}}
                                                    @foreach ($categories as $item)
                                                        <option value="{{ $item->sub_sub_category }}">
                                                            {{ $item->sub_sub_category }}</option>
                                                    @endforeach
    
                                                </select>
                                            </div>
                                            <div class="mx-3">
                                                <button type="button" id="filter" class="btn btn-primary waves-effect waves-light">Filter</button>
                                            </div>

                                            <div class="mx-3">
                                                <a href="{{url('superadmin/products')}}"  class="btn btn-primary waves-effect waves-light">                                                      Reset</a>
                                            </div>
                                        </div>
                                            </div>
                                        </div>
                                    </form>
                                        <div class="d-flex justify-content-between float-right">
                                    <form action="{{ route('importsuperadmin') }}"
                                        method="POST"
                                        enctype="multipart/form-data" class="d-flex mt-4 justify-content-end">
                                      @csrf
                                      <input type="file" name="file" required
                                             class="form-control" style="width: 100%" required accept=".xls, .xlsx">
                                      <br>
                                      <button class="btn btn-success ml-3">
                                            Import
                                         </button>
                                      <a class="btn btn-warning ml-3"
                                         href="{{ route('exportsuperadmin') }}">
                                                Export
                                        </a>
                                        {{-- <a class="btn btn-danger ml-3"
                                         href="{{ url('superadmin/truncateproduct') }}"  onclick="return confirm('Are you sure you want to Empty the All Data?');">
                                             Empty
                                        </a> --}}
                                    </form>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0 mt-4" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product Id</th>
                                                        <th>Date</th>
                                                        <th>Products Name</th>
                                                        <th>Category</th>
                                                        <th>MOQ</th>
                                                        <th>MRP</th>
                                                        <th>Image</th>
                                                        <th>All Details</th>
                                                        <th>Add to Cart</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="myTable">
                                                    @isset($products)
                                                        @foreach ($products as $key => $item)
                                                            <tr rowspan='2'>
                                                                <td class="mt-2 mr-2">{{ $key + 1 }}</td>
                                                                <td>{{ $item->product_id }}</td>
                                                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                                                <td>{{ $item->product_name }}</td>
                                                                <td>{{ $item->categories }}</td>
                                                                <td>{{ $item->min_order_quantity }}</td>
                                                                <td>{{ $item->price }}</td>
                                                         
                                                                <input type="hidden" id="product_id{{ $item->id }}" required
                                                                    value="{{ $item->product_id }}" />

                                                                <td>
                                                                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}">
                                                                    <img src="{{ url('image/' . $item->image) }}"
                                                                        style="width:50px;height:50px;border-radius:50%"
                                                                        alt=""></td>
                                                                    </button>

                                                                <td><a
                                                                        href="{{ url('superadmin/product-details/' . $item->id) }}">
                                                                        <button type="button"
                                                                            class="btn btn-primary waves-effect waves-light">
                                                                            <i class="fas fa-eye"></i></button>
                                                                    </a></td>
                                                                <td>

                                                                    @php
                                                                        $cartProductIds = $carts->pluck('product_id')->toArray();
                                                                    @endphp

                                                                    <input type="checkbox" id="cart{{ $item->id }}" required
                                                                        class="cart-checkbox"
                                                                        data-product-id="{{ $item->product_id }}"
                                                                        @if (in_array($item->product_id, $cartProductIds)) checked @endif>


                                                                </td>


                                                                <td>

                                                                    <a
                                                                        href="{{ url('superadmin/edit-product/' . $item->id) }}"><button
                                                                            class="btn btn-primary"
                                                                            style="color:white">Edit</button></a>
                                                                    <a
                                                                        href="{{ url('superadmin/delete-product/' . $item->id) }}"><button
                                                                            class="btn btn-danger">Delete</button></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endisset
                                                </tbody>
                                            </table>
                                        </div>
                                        @foreach ($products as $key => $item)
                                        <div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                    <img src="{{ url('image/' . $item->image) }}"
                                                    style="width:40%;height:40%;"
                                                    alt="">
                                                    </div>
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
                            <!-- end col -->
                        </div>
                    </div> <!-- container-fluid -->
                </div>
            @elseif($layout == 1)
                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13"><a href="{{url('superadmin/products')}}">Products</a> >Add Products</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <form action="{{ url('/superadmin/add-product') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">

                                                <div class="col-md-3 mb-3">
                                                    <label for="validationTooltip01"><b>Manufacturer <span
                                                                style="color: red">*</span></b></label>
                                                    <input type="text" class="form-control" id="validationTooltip01" required
                                                        name="manufacturer" placeholder="Enter Manufacturer" value="{{ old('manufacturer') }}" required>

                                                        @error('manufacturer')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationTooltip01"><b>Brand <span
                                                                style="color: red">*</span></b></label>
                                                    <input type="text" class="form-control" id="validationTooltip01" required
                                                        name="brand" placeholder="Enter Brand" value="{{ old('brand') }}">
                                                        @error('brand')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>


                                                <div class="col-md-3 mb-3">
                                                    <label for="validationTooltip01"><b>Product <span
                                                                style="color: red">*</span></b></label>
                                                    <input type="text" class="form-control" id="validationTooltip01" required
                                                        name="product_name" placeholder="Enter Product"
                                                        value="{{ old('product_name') }}">
                                                        @error('product_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <label for="validationTooltipUsername"><b>Category <span
                                                                style="color: red">*</span></b></label>
                                                    <select name="categories" id="categories" class="form-control">
                                                        <option value="">Select Category</option>
                                                        @foreach ($categories as $key => $item)
                                                            <option value="{{ $item->category_name }}">
                                                                {{ $item->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('categories')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationTooltipUsername"><b>Sub Category <span
                                                                style="color: red">*</span></b></label>
                                                    <select name="sub_categories" id="sub_categories" class="form-control">
                                                        <option value="">Select Sub Category</option>
                                                        @foreach ($categories as $key => $item)
                                                            <option value="{{ $item->sub_category }}">
                                                                {{ $item->sub_category }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('sub_categories')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationTooltipUsername"><b>Sub Sub Category <span
                                                                style="color: red">*</span></b></label>
                                                    <select name="sub_sub_categories" id="sub_sub_categories" class="form-control">
                                                        <option value="">Select Sub Sub Category</option>
                                                        @foreach ($categories as $key => $item)
                                                            <option value="{{ $item->sub_sub_category }}">
                                                                {{ $item->sub_sub_category }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('sub_sub_categories')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                </div>
                                               
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationTooltip03"><b>MRP <span
                                                                style="color: red">*</span></b></label>
                                                    <input type="number" class="form-control" required
                                                        value="{{ old('price') }}" name="price"
                                                        placeholder="Enter MRP">
                                                        @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                {{-- <div class="col-md-3 mb-3">
                                                    <label for="validationTooltip03"><b>Stcoks <span
                                                                style="color: red">*</span></b></label>
                                                    <input type="number" class="form-control" required
                                                        value="{{ old('stocks') }}" name="stocks"
                                                        placeholder="Enter Stocks">

                                                </div> --}}

                                                <div class="col-md-3 mb-3">
                                                    <label for="validationTooltip03"><b>Pack Size <span
                                                                style="color: red">*</span></b></label>
                                                    <input type="text" class="form-control" required
                                                        value="{{ old('packsize') }}" name="packsize"
                                                        placeholder="Enter Pack Size">
                                                        @error('packsize')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationTooltip03"><b>Unit<span
                                                                style="color: red">*</span></b></label>
                                                    <input type="text" class="form-control" required
                                                        value="{{ old('unit') }}" name="unit"
                                                        placeholder="Enter Unit">
                                                        @error('unit')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationTooltip03"><b>JSP (Janis Sales Price)<span
                                                                style="color: red">*</span></b></label>
                                                    <input type="text" class="form-control" required
                                                        value="{{ old('jsp') }}" name="jsp"
                                                        placeholder="Enter Janis Sales Price">
                                                        @error('jsp')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <label for="validationTooltip03"><b>GST in %<span
                                                                style="color: red">*</span></b></label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('gstin') }}" name="gstin"
                                                        placeholder="Enter GST in %">
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <label for="validationTooltip03"><b>HSN Code<span
                                                                style="color: red">*</span></b></label>
                                                    <input type="text" class="form-control"
                                                        value="{{ old('hsncode') }}" name="hsncode"
                                                        placeholder="Enter HSN Code">
                                                </div>


                                            </div>
                                            <div class="form-row">



                                                <div class="col-md-4 mb-3">
                                                    <label for="validationTooltip05"><b>Image <span
                                                                style="color: red">*</span></b></label>
                                                    <input type="file" class="form-control" name="image" required> 
                                                    @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationTooltip05"><b>Others Images <span
                                                                style="color: red">*</span></b></label>
                                                    <input type="file" class="form-control" name="images[]" required
                                                        multiple>

                                                        @error('images')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label for="validationTooltip03"><b>Minimum Order
                                                            Quantity <span style="color: red">*</span></b></label>
                                                    <input type="text" name="min_order_quantity" required
                                                        class="form-control" value="{{ old('min_order_quantity') }}"
                                                        id="validationTooltip03" placeholder="Enter Order Quantity">
                                                        @error('min_order_quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationTooltip03"><b>Description <span
                                                                style="color: red">*</span></b></label>
                                                    <textarea type="text" name="description" class="form-control" value="{{ old('descritption') }}"
                                                        id="validationTooltip03" placeholder="Enter Description"></textarea>
                                                        @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="row mt-md-4 mt-3">
                                                <div class="col-12">
                                            <div class="btns d-inline-block">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                                Add Product</button>
                                            </div>
                                                <div class="btns d-inline-block">
                                                    <a href="{{url('superadmin/products')}}"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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

        </div> <!-- container-fluid -->
    </div>
@elseif($layout == 2)
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-13"><a href="{{url('superadmin/products')}}">Products</a> > Edit Products</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ url('superadmin/edit-product/' . $product['id']) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                   
                                    <div class="col-md-3 mb-3">
                                        <label for="validationTooltip01"><b>Manufacturer <span
                                                    style="color: red">*</span></b></label>
                                        <input type="text" class="form-control" id="validationTooltip01" required
                                            name="manufacturer" placeholder="Enter Manufacturer" value="{{  $product['manufacturer']  }}">
                                            @error('manufacturer')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        </div>
                                   
                                     <div class="col-md-3 mb-3">
                                        <label for="validationTooltip01"><b>Brand <span
                                                    style="color: red">*</span></b></label>
                                        <input type="text" class="form-control" id="validationTooltip01" required
                                            name="brand" placeholder="Brand" value="{{ $product['brand_name'] }}">
                                            @error('brand')
                                             <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="validationTooltip01"><b> Product <span
                                                    style="color: red">*</span></b></label>
                                        <input type="text" class="form-control" required
                                            value="{{ $product['product_name'] }}" name="product_name"
                                            placeholder="Enter Product">
                                        <span class="text-danger">
                                            @error('product_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="validationTooltipUsername"><b>Category <span
                                                    style="color: red">*</span></b></label>
                                        <select name="categories" id="categories" class="form-control"
                                            placeholder="Enter Categories">
                                           
                                            @foreach ($categories as $key => $item)
                                                <option value="{{ $item->category_name }}" {{ $item->category_name==$product['categories']?'selected':'' }}>
                                                    {{ $item->category_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('categories')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationTooltipUsername"><b>Sub Category <span
                                                    style="color: red">*</span></b></label>
                                        <select name="sub_categories" id="sub_categories" class="form-control"
                                            placeholder="Enter Categories">
                                        
                                            @foreach ($categories as $key => $item)
                                            <option value="{{ $item->sub_category }}" {{ $item->sub_category==$product['sub_categories']?'selected':'' }}>
                                                    {{ $item->sub_category }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('sub_categories')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationTooltipUsername"><b>Sub Sub Category <span
                                                    style="color: red">*</span></b></label>
                                        <select name="sub_sub_categories" id="sub_sub_categories" class="form-control">
                                            
                                            @foreach ($categories as $key => $item)
                                                <option value="{{ $item->sub_sub_category}}"{{ $item->sub_sub_category==$product['sub_sub_categories']?'selected':'' }}>
                                                    {{ $item->sub_sub_category }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('sub_sub_categories')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationTooltip03"><b>MRP <span
                                                    style="color: red">*</span></b></label>
                                        <input type="number" class="form-control" name="price" required
                                            value="{{ $product['price'] }}" placeholder="Enter MRP">
                                        <span class="text-danger">
                                            @error('price')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationTooltip03"><b>Pack Size <span
                                                    style="color: red">*</span></b></label>
                                        <input type="text" class="form-control" required
                                        value="{{ $product['packsize'] }}" name="packsize"
                                            placeholder="Enter Pack Size">
                                            @error('packsize')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationTooltip03"><b>Unit<span
                                                    style="color: red">*</span></b></label>
                                        <input type="text" class="form-control" required
                                        value="{{ $product['unit'] }}"  name="unit"
                                            placeholder="Enter Unit">
                                            @error('unit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationTooltip03"><b>JSP (Janis Sales Price)<span
                                                    style="color: red">*</span></b></label>
                                        <input type="text" class="form-control" required
                                        value="{{ $product['jsp'] }}" name="jsp"
                                            placeholder="Enter Janis Sales Price">
                                            @error('jsp')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="validationTooltip03"><b>GST in %<span
                                                    style="color: red">*</span></b></label>
                                        <input type="text" class="form-control"
                                        value="{{ $product['gstin'] }}" name="gstin"
                                            placeholder="Enter GST in %">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="validationTooltip03"><b>HSN Code<span
                                                    style="color: red">*</span></b></label>
                                        <input type="text" class="form-control"
                                        value="{{ $product['hsncode'] }}" name="hsncode"
                                            placeholder="Enter HSN Code">
                                    </div>

                                </div>


                                <div class="form-row">

                                    <div class="col-md-4 mb-3">
                                        <label for="validationTooltip05"><b>Image <span
                                                    style="color: red">*</span></b></label>
                                        <input type="hidden" name="image" value="{{ $product['image'] }}"> 
                                        <input type="file" id="image-input1" class="form-control" name="image" 
                                            accept="image/*">

                                        <div id="single-image-preview-container" class="row"></div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="validationTooltip05"><b>Others Images <span
                                                    style="color: red">*</span></b></label>
                                        <input type="hidden" name="old_images" 
                                            value="{{ $product['others_image'] }}">
                                        <input type="file" class="form-control" name="images[]" multiple 
                                            id="image-input" accept="image/*">
                                        <div id="image-preview-container" class="row"></div>

                                    </div>



                                    <div class="col-md-4 mb-3">
                                        <label for="validationTooltip03"><b>Minimum Order
                                                Quantity <span style="color: red">*</span></b></label>
                                        <input type="text" name="min_order_quantity" class="form-control" required
                                            value="{{ $product['min_order_quantity'] }}" id="validationTooltip03"
                                            placeholder="Enter Order Quantity">
                                            @error('min_order_quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>

                                </div>


                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationTooltip03"><b>Description <span
                                                    style="color: red">*</span></b></label>
                                        <textarea type="text" name="description" class="form-control" id="validationTooltip03"
                                            placeholder="Enter Description">{{ $product['description'] }}</textarea>
                                        <span class="text-danger">
                                            @error('description')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="row mt-md-4 mt-3">
                                    <div class="col-12">
                                <div class="btns d-inline-block">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">
                                    Update Product</button>
                                </div>
                                    <div class="btns d-inline-block">
                                        <a href="{{url('superadmin/products')}}"><button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
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
@elseif($layout == 3)
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-13"><a href="{{url('superadmin/products')}}">Products</a> > Product Details</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Product Details</h4>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <!-- <h3>Customer Details With Product</h3>
                                            <h5 class="mt-3">Warehouse ID - 007</h5> -->
                                </div>
                                <div class="col-md-6 mb-md-0 mb-4">
                                    <div class="row mt-5">
                                        <div class="col-12">
                                            <table>
                                                <tr>
                                                    <td><p>Date:</p></td>
                                                    <td> <p>{{ date('d-m-Y',strtotime($product_details->created_at)) }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td><p>Product Name:</p></td>
                                                    <td><p>{{ $product_details->product_name }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td><p>Category:</p></td>
                                                    <td><p>{{ $product_details->categories }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td><p>Sub Category:</p></td>
                                                    <td><p>{{ $product_details->sub_categories }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td><p>Sub Sub Category:</p></td>
                                                    <td><p>{{ $product_details->sub_sub_categories }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td><p>Product Id:</p></td>
                                                    <td><p>{{ $product_details->product_id }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td><p>MRP :</p></td>
                                                    <td><p>{{ $product_details->price }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td><p>MOQ :</p></td>
                                                    <td><p>{{ $product_details->min_order_quantity }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td><p>GST :</p></td>
                                                    <td><p>{{ $product_details->gstin }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td><p>HSN Code :</p></td>
                                                    <td><p>{{ $product_details->hsncode }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td><p>Description :</p></td>
                                                    <td><p>{{ $product_details->description }}</p></td>
                                                </tr>
                                            </table>
                                           
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="img-box">
                                        <!-- <img src="../assets/images/maintenance.svg" alt="" class="img-fluid"> -->
                                        <div class="containerBox">
                                            <div id="js-gallery" class="gallery">
                                                <!--Gallery Hero-->
                                                <div class="gallery__hero">
                                                  <img src="{{url('image/'.$product_details->image)}}">
                                                </div>
                                                <!--Gallery Hero-->
                                            
                                                <!--Gallery Thumbs-->
                                                <div class="gallery__thumbs"  id="image-preview-container">
                                                    <a href="{{url('image/'.$product_details->image)}}" data-gallery="thumb" class="is-active">
                                                      <img src="{{url('image/'.$product_details->image)}}">
                                                    </a>
                                                    <input type="hidden" name="old_images" required
                                                        value="{{ $product_details['others_image'] }}">
                                                    <div class="row"></div>
                                                    {{-- <a href="{{url('/assets/images/surgical-medical-mask.png')}}" data-gallery="thumb">
                                                      <img src="{{url('/assets/images/surgical-medical-mask.png')}}">
                                                    </a>
                                                    <a href="{{url('/assets/images/medical-mask.png')}}" data-gallery="thumb">
                                                      <img src="{{url('/assets/images/medical-mask.png')}}">
                                                    </a>
                                                    <a href="{{url('/assets/images/mask-53.png')}}" data-gallery="thumb">
                                                      <img src="{{url('/assets/images/mask-53.png')}}">
                                                    </a> --}}
                                                </div>
                                                
                                                <!--Gallery Thumbs-->
                                            
                                              </div>
                                            
                                           </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="col-6">
                                   
                                </div>
                            </div>

                        </div>
                        <!-- end card-body-->
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
    </div>
    </div>
    @endif


    </div>
    <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    @if ($layout == 0)
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        @foreach ($products as $key => $item)
        
            <script>
              
                    $('#cart{{ $item->id }}').change(function() {
        
                        
                        if ($(this).is(':checked')) {
                            var product_id = $(this).data('product-id');
                         

                            jQuery.ajax({
                                url: '{{ url('superadmin/add-to-carts') }}',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    product_id: product_id,
                                },
                                success: function(response) {
                                    if (response.success) {
                                        $('#carts').html(response.total_carts); 
                                    } else {
                                        alert('Item already in a cart');
                                    }
                                }
                            });
                        }
                    });
            
                function resetFilter() {
        window.location.reload();
      }
            </script>
        @endforeach


  
     <script>
      jQuery(document).ready(function() {

            $('#filter').click(function() {
                var category = $('#categories').val();
                var sub_category = $('#sub_categories').val();
                var sub_sub_category = $('#sub_sub_categories').val();
    
                    jQuery.ajax({
                    url: '{{ url('superadmin/filter-products') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        category: category,
                        sub_category:sub_category,
                        sub_sub_category:sub_sub_category,
                    },
                    success: function(response) {
                    
                        $('#myTable').html(response.data);
                        $('#sub_category').html(response.sub_category_html);
                        $('#sub_sub_category').html(response.sub_sub_category_html);

                        console.log(response.data);
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        alert('Error - ' + errorMessage);
                    }
                });
            
            });
        });
        
    </script>

    <script>
    jQuery(document).ready(function() {

          $('#categories').change(function() {
              var category = $('#categories').val();
        
               jQuery.ajax({
                  url: '{{ url('superadmin/fetch-sub-categories') }}',
                  type: 'POST',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data: {
                      category: category,
                  
                  },
                  success: function(response) {
                  
                      $('#sub_categories').html(response.sub_category_html);
                      $('#sub_sub_categories').html(response.sub_sub_category_html);

                      console.log(response.data);
                  },
                  error: function(xhr, status, error) {
                      var errorMessage = xhr.status + ': ' + xhr.statusText;
                      alert('Error - ' + errorMessage);
                  }
              });
          
          });
      });
   </script>







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
    </script>
    
    @elseif ($layout == 1)
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>

            jQuery(document).ready(function() {
        
                  $('#categories').change(function() {
                      var category = $('#categories').val();
                
                       jQuery.ajax({
                          url: '{{ url('superadmin/fetch-sub-categories') }}',
                          type: 'POST',
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          data: {
                              category: category,
                          
                          },
                          success: function(response) {
                          
                              $('#sub_categories').html(response.sub_category_html);
                              $('#sub_sub_categories').html(response.sub_sub_category_html);
        
                              console.log(response.data);
                          },
                          error: function(xhr, status, error) {
                              var errorMessage = xhr.status + ': ' + xhr.statusText;
                              alert('Error - ' + errorMessage);
                          }
                      });
                  
                  });
              });
          </script>
        <script>
            $(document).ready(function() {
                $('#selectUsers').on('change', function() {
                    if (this.value == 'No') {
                        $('.selectUsers').hide();
                        $('.users').show();
                    } else {
                        $('.selectUsers').show();
                        $('.users').hide();
                    }
                });
            });
            $(document).ready(function() {
                var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                    removeItemButton: true,
                });
            });
            jQuery(document).ready(function() {

$('#category').change(function() {
    var category = $('#category').val();

     jQuery.ajax({
        url: '{{ url('superadmin/fetch-sub-categories') }}',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            category: category,
        
        },
        success: function(response) {
        
            $('#sub_category').html(response.sub_category_html);
            $('#sub_sub_category').html(response.sub_sub_category_html);

            console.log(response.data);
        },
        error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText;
            alert('Error - ' + errorMessage);
        }
    });

});
});
        </script>
    @elseif ($layout == 2)
    
        <!-- end row-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>

            jQuery(document).ready(function() {
        
                  $('#categories').change(function() {
                      var category = $('#categories').val();
                
                       jQuery.ajax({
                          url: '{{ url('superadmin/fetch-sub-categories') }}',
                          type: 'POST',
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          data: {
                              category: category,
                          
                          },
                          success: function(response) {
                          
                              $('#sub_categories').html(response.sub_category_html);
                              $('#sub_sub_categories').html(response.sub_sub_category_html);
        
                              console.log(response.data);
                          },
                          error: function(xhr, status, error) {
                              var errorMessage = xhr.status + ': ' + xhr.statusText;
                              alert('Error - ' + errorMessage);
                          }
                      });
                  
                  });
              });
          </script>
    
        <script>
            $(document).ready(function() {
                // Retrieve the value of old_images input field
                var oldImages = $('input[name="old_images"]').val();

                // Display preview for old images
                if (oldImages) {
                    var oldImagesArray = oldImages.split(',');
                    var previewContainer = $('#image-preview-container');

                    for (var i = 0; i < oldImagesArray.length; i++) {
                        var imageSrc = oldImagesArray[i].trim();

                        if (imageSrc !== '') {
                            var imageUrl = '{{ url('storage/app/public') }}/' + imageSrc;
                            var imageItem = $('<div class="image-item">');
                            var image = $('<img>').addClass('preview-image').attr({
                                'src': imageUrl,
                                'width': '40',
                                'height': '40',
                                'cursor': 'pointer'
                            });
                            imageItem.append(image);

                            var crossButton = $('<span>').addClass('cross-button').html('&times;');
                            crossButton.attr('data-image-index', i);
                            imageItem.append(crossButton);

                            previewContainer.append(imageItem);
                        }
                    }
                }

                // Delete image on cross button click
                $(document).on('click', '.cross-button', function() {
                    var index = $(this).attr('data-image-index');
                    var imageItem = $(this).closest('.image-item');
                    var imageSrc = imageItem.find('img').attr('src');

                    // Remove image from preview
                    imageItem.remove();

                    // Update the oldImagesArray by removing the deleted image
                    var oldImages = $('input[name="old_images"]').val();
                    var oldImagesArray = oldImages.split(',');
                    oldImagesArray.splice(index, 1);
                    var newOldImages = oldImagesArray.join(',');
                    $('input[name="old_images"]').val(newOldImages);
                });

                $('#image-input').on('change', function() {
                    var previewContainer = $('#image-preview-container');
                    previewContainer.empty(); // Clear any previous previews

                    var files = $(this).get(0).files;
                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        var imageUrl = URL.createObjectURL(file);

                        var imageItem = $('<div class="image-item">').append(
                            $('<img>').addClass('preview-image').attr({
                                'src': imageUrl,
                                'height': '40',
                                'width': '40',
                                'cursor': 'pointer'
                            })
                        );

                        var crossButton = $('<span class="cross-button"> ').html('&times;');
                        imageItem.append(crossButton);
                        previewContainer.append(imageItem);
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // Retrieve the value of old_images input field
                var oldImages = $('input[name="image"]').val();

                // Display preview for old images
                if (oldImages) {
                    var oldImagesArray = oldImages.split(',');
                    var previewContainer = $('#single-image-preview-container');

                    for (var i = 0; i < oldImagesArray.length; i++) {
                        var imageSrc = oldImagesArray[i].trim();

                        if (imageSrc !== '') {
                            var imageUrl = '{{ url('image') }}/' + imageSrc;
                            var imageItem = $('<div class="image-item">');
                            var image = $('<img>').addClass('preview-image mt-2 ml-2').attr({
                                'src': imageUrl,
                                'width': '35',
                                'height': '35',
                                'cursor': 'pointer'
                            });
                            imageItem.append(image);

                            var crossButton = $('<span>').addClass('cross-button').html('&times;');
                            crossButton.attr('data-image-index', i);
                            imageItem.append(crossButton);

                            previewContainer.append(imageItem);
                        }
                    }
                }

                // Delete image on cross button click
                $(document).on('click', '.cross-button', function() {
                    var index = $(this).attr('data-image-index');
                    var imageItem = $(this).closest('.image-item');
                    var imageSrc = imageItem.find('img').attr('src');

                    // Remove image from preview
                    imageItem.remove();

                    // Update the oldImagesArray by removing the deleted image
                    var oldImages = $('input[name="image"]').val();
                    var oldImagesArray = oldImages.split(',');
                    oldImagesArray.splice(index, 1);
                    var newOldImages = oldImagesArray.join(',');
                    $('input[name="image"]').val(newOldImages);
                });

                $('#image-input1').on('change', function() {
                    var previewContainer = $('#single-image-preview-container');
                    previewContainer.empty(); // Clear any previous previews

                    var files = $(this).get(0).files;
                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        var imageUrl = URL.createObjectURL(file);

                        var imageItem = $('<div class="image-item">').append(
                            $('<img>').addClass('preview-image mt-2 ml-2').attr({
                                'src': imageUrl,
                                'height': '40',
                                'width': '40',
                                'cursor': 'pointer'
                            })
                        );

                        var crossButton = $('<span class="cross-button"> ').html('&times;');
                        imageItem.append(crossButton);
                        previewContainer.append(imageItem);
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#selectUsers').on('change', function() {
                    if (this.value == 'No') {
                        $('.selectUsers').hide();
                        $('.users').show();
                    } else {
                        $('.selectUsers').show();
                        $('.users').hide();
                    }
                });
            });
            $(document).ready(function() {
                var multipleCancelButton = new Choices('#choices-multiple-remove-button1', {
                    removeItemButton: true,
                });
            });
            jQuery(document).ready(function() {

$('#category').change(function() {
    var category = $('#category').val();

     jQuery.ajax({
        url: '{{ url('superadmin/fetch-sub-categories') }}',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            category: category,
        
        },
        success: function(response) {
        
            $('#sub_category').html(response.sub_category_html);
            $('#sub_sub_category').html(response.sub_sub_category_html);

            console.log(response.data);
        },
        error: function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText;
            alert('Error - ' + errorMessage);
        }
    });

});
});
        </script>
    @elseif($layout == 3)
    <script>
        $(document).ready(function() {
                   // Retrieve the value of old_images input field
                   var oldImages = $('input[name="old_images"]').val();
   
                   // Display preview for old images
                   if (oldImages) {
                       var oldImagesArray = oldImages.split(',');
                       var previewContainer = $('#image-preview-container');
   
                       for (var i = 0; i < oldImagesArray.length; i++) {
                           var imageSrc = oldImagesArray[i].trim();
   
                           if (imageSrc !== '') {
                               var imageUrl = '{{ url('storage') }}/' + imageSrc;
                               var imageItem = $('<a href="'+imageUrl+'"data-gallery="thumb" class="is-active">');
                               var image = $('<img>').addClass('preview-image').attr({
                                   'src': imageUrl,
                                   'width': '40',
                                   'height': '40',
                                   'cursor': 'pointer'
                               });
                               imageItem.append(image);
   
                               var crossButton = $('<span>').addClass('cross-button').html('&times;');
                               crossButton.attr('data-image-index', i);
                              
   
                               previewContainer.append(imageItem);
                           }
                       }
                   }
               });
   </script>
    @endif
    
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.js'></script>
<script src="{{url('/assets/imageGalleryScript.js')}}"></script>
                        


    @include('superadmin.footer')


</body>

</html>
