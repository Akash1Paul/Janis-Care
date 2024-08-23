@include('territory.header')

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <div class="main-content">

                @yield('header')
                @include('territory.navbar')                

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
                                                        <th>MRP</th>
                                                        <th>Stock</th>
                                                        <th>Image</th>
                                                        <th>All Details</th>
                                                        <th>Add To Cart</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($products)
                                                    @foreach ($products as $key => $item)
                                                    <input type="hidden" id="product_id{{ $item->id }}" value="{{ $item->product_id }}"/>
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->product_id }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                                                        <td>{{ $item->product_name }}</td>
                                                        <td>{{ $item->categories }}</td>
                                                        <td>{{ $item->min_order_quantity }}</td>
                                                        <td>{{ $item->price }}</td>
                                                        <td>{{ $item->stocks }}</td>
                                                        <td>
                                                            <div class="p-img">
                                                                <img src="{{ url('image/' . $item->image) }}" width="50px" class="img-fluid" alt="Not found">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{url('territory/product-details/'.$item->id)}}">
                                                                <button type="button" class="btn btn-warning waves-effect waves-light"> <i class="fas fa-eye"></i></button>
                                                            </a>
                                                        </td>
                                                        <td><button class="btn btn-success" id="cart{{ $item->id }}"><i class="fas fa-shopping-cart mr-1"> Cart </i></button></td>
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
                @foreach ($products as $key => $item)
                <div class="ltn__modal-area ltn__add-to-cart-modal-area">
                    <div class="modal fade" id="add_to_cart_modal{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href=""><button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button></a>
                                        <p class="added-cart"><i class="fa fa-check-circle"></i>
                                            Successfully added to your Cart</p>
                                </div>
                                <div class="modal-body">
                                    <div class="ltn__quick-view-modal-inner">
                                        <div class="modal-product-item">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="modal-product-img">
                                                        <img src="{{ url('image/' . $item->image) }}" alt="#" style="width: 440px;">
                                                    </div>
                                                    <div class="modal-product-info">
                                                        <h5><a href=""></a></h5>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <div class="ltn__modal-area ltn__add-to-cart-modal-area">
                    <div class="modal fade" id="add_to_cart_modal{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href=""><button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button></a>
                                        <p class="added-cart"><i class="fa fa-check-circle"></i>
                                            Successfully added to your Cart</p>
                                </div>
                                <div class="modal-body">
                                    <div class="ltn__quick-view-modal-inner">
                                        <div class="modal-product-item">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="modal-product-img">
                                                        <img src="{{ url('image/' . $item->image) }}" alt="#" style="width: 440px;">
                                                    </div>
                                                    <div class="modal-product-info">
                                                        <h5><a href=""></a></h5>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                
                <script>
                    $(document).ready(function() {
               
                        $('#cart{{ $item->id }}').click(function() {
                            var product_id = $('#product_id{{ $item->id }}').val();
                            // alert(product_id);
                            jQuery.ajax({
                                url: '{{ url('territory/add-to-carts') }}',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    product_id: product_id,
                                },
                                success: function(response) {
                                    if(response.success){
                                    $('#add_to_cart_modal{{ $item->id }}').modal('show');
                                }
                                else{
                                    alert('Item already in a cart');
                                }
                            }
                            });
                        });
            
                    });
                </script>
            @endforeach 
@include('territory.footer')