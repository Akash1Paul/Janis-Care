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
                                    <h4 class="mb-0 font-size-13">Orders > Add Order > Product Details</h4>
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
                                                        <div class="col-6">
                                                            <div class="details">
                                                                <p>Date:</p>
                                                                <p>Product Name:</p>
                                                                <p>Category:</p>
                                                                <p>Product Id:</p>
                                                                <p>MRP :</p>
                                                                <p>Price:</p>
                                                                <p>MOQ :</p>
                                                                <p>Stock Availability :</p>
                                                                <p>Description:</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="details">
                                                                    <p>{{ date('d-m-Y',strtotime($products->created_at)) }}</p>
                                                                    <p>{{ $products->product_name }}</p>
                                                                    <p>{{ $products->categories }}</p>
                                                                    <p>{{ $products->product_id }}</p>
                                                                    <p>160</p>
                                                                    <p>{{ $products->price }}</p>
                                                                    <p>{{ $products->min_order_quantity }}</p>
                                                                    <p>{{ $products->stocks }}</p>
                                                                    <p>{{ $products->description }}</p>
                                                               
                                                            </div>
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
                                                                  <img src="{{url('image/'.$products->image)}}">
                                                                </div>
                                                                <!--Gallery Hero-->
                                                            
                                                                <!--Gallery Thumbs-->
                                                                <div class="gallery__thumbs"  id="image-preview-container">
                                                                    <a href="{{url('image/'.$products->image)}}" data-gallery="thumb" class="is-active">
                                                                      <img src="{{url('image/'.$products->image)}}">
                                                                    </a>
                                                                    <input type="hidden" name="old_images"
                                                                        value="{{ $products['others_image'] }}">
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

                @include('territory.footer')
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