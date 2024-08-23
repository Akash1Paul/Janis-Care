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
                                    <h4 class="mb-0 font-size-13"><a href="{{url('backoffice/products')}}">Products</a> > Product Details</h4>
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
                                                                    <td> <p>{{ date('d-m-Y',strtotime($products->created_at)) }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Product Name:</p></td>
                                                                    <td><p>{{ $products->product_name }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Category:</p></td>
                                                                    <td><p>{{ $products->categories }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Sub Category:</p></td>
                                                                    <td><p>{{ $products->sub_categories }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Sub Sub Category:</p></td>
                                                                    <td><p>{{ $products->sub_sub_categories }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Product Id:</p></td>
                                                                    <td><p>{{ $products->product_id }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>MRP :</p></td>
                                                                    <td><p>{{ $products->price }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>MOQ :</p></td>
                                                                    <td><p>{{ $products->min_order_quantity }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>GST :</p></td>
                                                                    <td><p>{{ $products->gstin }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>HSN Code :</p></td>
                                                                    <td><p>{{ $products->hsncode }}</p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Description :</p></td>
                                                                    <td><p>{{ $products->description }}</p></td>
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
            document.addEventListener("DOMContentLoaded", function () {
        // Get the current page URL
        var currentPage = window.location.href;

        // Get all the nav links
        var navLinks = document.querySelectorAll(".topnav .navbar-nav .nav-link");

        // Loop through the nav links
        navLinks.forEach(function (link)
 {
            // Check if the link's href matches the current page URL or if it has the "product-details-link" class
            if ((currentPage.includes(link.href) || link.classList.contains('product-details-link')) && link.parentNode.parentNode.tagName.toLowerCase() === 'li') {
                // Add the 'active' class to the matching link
                link.classList.add("active");
            }
        });
    });
</script>
@include('backoffice.footer')