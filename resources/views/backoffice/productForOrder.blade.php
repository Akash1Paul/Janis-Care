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
                                    <h4 class="mb-0 font-size-13">Orders > Add Order</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Add Order</h4>
                                        </div>
                                        <div class="table-responsive mt-4">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product Id</th>
                                                        <th>Date</th>
                                                        <th>Product Name</th>
                                                        <th>Category</th>
                                                        <th>MOQ</th>
                                                        <th>Price</th>
                                                        <th>Stock</th>
                                                        <th>Image</th>
                                                        <th>All Details</th>
                                                        <th>Add To cart</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($products)
                                                    @foreach ($products as $key => $item)
                                                    <input type="hidden" id="product_id{{ $item->id }}" value="{{ $item->product_id }}"/>
                                                    <tr>
                                                        <th>{{ $key + 1 }}</th>
                                                        <th>{{ $item->product_id }}</th>
                                                        <th>{{ date('d-m-Y',strtotime($item->created_at)) }}</th>
                                                        <td>{{ $item->product_name }}</td>
                                                        <td>{{ $item->categories }}</td>
                                                        <td>{{ $item->moq }}</td>
                                                        <td>{{ $item->price }}</td>
                                                        <td>{{ $item->stocks}}</td>
                                                        <td>
                                                            <div class="p-img">
                                                                <img src="{{ url('image/' . $item->image) }}" width="50px" class="img-fluid" alt="Not found">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{url('backoffice/productdetails/'.$item->id)}}">
                                                                <button type="button" class="btn btn-warning waves-effect waves-light"> <i class="fas fa-eye"></i></button>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary waves-effect waves-light" id="sa-success"><i class="fas fa-shopping-cart mr-1"></i>Add</button>
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
                        </div>
                        <!-- end row-->
                        </div>
                        <!--end row-->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

@include('backoffice.footer')