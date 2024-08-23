@include('inventory.header')

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
                                    <h4 class="mb-0 font-size-13">{{$warehoue_name->name}} > Inventory</h4>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Stocks</h4>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" id="search" class="form-control"
                                                        placeholder="Search ..." aria-label="Recipient's username">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="search-button"><i
                                                                class="mdi mdi-magnify"></i></button>
                                                    </div>

                                                    <div class="mx-2">
                                                        <select class="form-control mx-2" id="category">
                                                            <option value="" selected disabled>Select Category
                                                            </option>
                                                            <option value="all">All</option>
                                                            @foreach ($categories as $item)
                                                                <option value="{{ $item->category_name }}">
                                                                    {{ $item->category_name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <div class="mx-3">
                                                        <a><button class="btn btn-primary waves-effect waves-light"
                                                                onclick="resetFilter()">Reset</button></a>
                                                    </div>
                                                    {{-- <a href="{{ url('inventory/add-stocks') }}"><button type="button"
                                                            class="btn btn-primary waves-effect waves-light ml-3">Add</button></a> --}}
                                                </div>
                                            </div>
                                        </div>


                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0 mt-4" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product Id</th>
                                                        <th>Date</th>
                                                        <th>Product Name</th>
                                                        <th>Barcode</th>
                                                        <th>Category</th>
                                                        <th>Total Sold</th>
                                                        <th>Stock</th>
                                                        <th>Image</th>
                                                        <th>Percentage</th>
                                                        <th>Add Stocks</th>
                                                    </tr>

                                                </thead>

                                                <tbody id="myTable">

                                                    @isset($stocks)
                                                        @foreach ($stocks as $key => $item)
                                                            <tr rowspan='2'>
                                                                <td class="mt-2 mr-2">{{ $key + 1 }}</td>
                                                                <td>{{ $item->product_id }}</td>
                                                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                                                <td>{{ $item->product_name }}</td>
                                                               <td><button type="button" class="btn " data-toggle="modal" data-target=".bd-example-modal-sm{{$item->id}}">
                                                                <img src="{{ asset($item->barcode_path) }}" alt="Product Barcode" style="width: 200px;height:50px">   </button>                                         </td>
                                                                <td>{{ $item->categories }}</td>
                                                                <td>{{ $item->sold==''?0:$item->sold }}</td>
                                                                <td>{{ $item->stocks }}</td>
                                                                <td><img src="{{ url('image/' . $item->image) }}"
                                                                        style="width:50px;height:50px;border-radius:50%"
                                                                        alt=""></td>

                                                                @php
                                                                    $percentage = (100 / $item->max_stocks) * $item->stocks;

                                                                    if ($percentage <= 0) {
                                                                        $percentage = 0;
                                                                    }
                                                                @endphp


                                                                <td>


                                                                    <div class="progress">
                                                                        @if ($percentage >= 0 && $percentage < 25)
                                                                            <div class="progress-bar bg-danger"
                                                                                role="progressbar"
                                                                                style="width: {{ $percentage }}%"
                                                                                aria-valuenow="{{ $percentage }}"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                                {{ round($percentage) }}%</div>
                                                                        @elseif($percentage >= +25 && $percentage < +50)
                                                                            <div class="progress-bar bg-warning"
                                                                                role="progressbar"
                                                                                style="width: {{ $percentage }}%"
                                                                                aria-valuenow="{{ $percentage }}"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                                {{ round($percentage) }}%</div>
                                                                        @elseif($percentage >= +50 && $percentage < +75)
                                                                            <div class="progress-bar bg-primary"
                                                                                role="progressbar"
                                                                                style="width: {{ $percentage }}%"
                                                                                aria-valuenow="{{ $percentage }}"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                                {{ round($percentage) }}%</div>
                                                                        @else
                                                                            <div class="progress-bar bg-success"
                                                                                role="progressbar"
                                                                                style="width: {{ $percentage }}%"
                                                                                aria-valuenow="{{ $percentage }}"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                                {{ round($percentage) }}%</div>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td>

                                                                    <a>
                                                                        <button type="button"
                                                                            class="btn btn-primary waves-effect waves-light"
                                                                            data-toggle="modal"
                                                                            data-target="#exampleModalCenter{{ $item->id }}">
                                                                            <i class="fa fa-plus"></i></button>
                                                                    </a>
                                                                </td>

                                                                <div class="modal fade" id="exampleModalCenter{{ $item->id }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalCenterTitle"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered"
                                                                        role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLongTitle">
                                                                                </h5>

                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>

                                                                            </div>

                                                                            <div class="modal-body">

                                                                                <label for="">Max Stock</label>
                                                                                <input type="text"
                                                                                    value="{{ $item->max_stocks }}"
                                                                                    class="form-control" readonly>
                                                                                <br>
                                                                                <label for="">Choose Batch Category</label>
                                                                                <select class="form-control" name="" id="stockcategory">
                                                                                @isset($batch_id->batch_id) 
                                                                                    <option value="{{$batch_id->batch_id}}">Old Batch</option>
                                                                                @endisset 
                                                                                    <option value="new">New Batch</option>
                                                                                </select>
                                                                              
                                                                                <input type="hidden" id="product_id{{ $item->id }}" value="{{ $item->product_id }}">
                                                                                <label for="">Remaning Stocks</label>
                                                                            <input type="text" value="{{ $item->stocks }}"
                                                                                    id="stocks{{ $item->id }}" class="form-control">
                                                                                <br>



                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>

                                                                                <button type="button"
                                                                                    class="btn btn-primary"
                                                                                    id="add-stocks{{ $item->id }}">Add
                                                                                    Stock</button>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        @endforeach
                                                    @endisset

                                                </tbody>

                                            </table>

                                        </div>
                                        @foreach ($stocks as $key => $item)
                                        <div class="modal fade bd-example-modal-sm{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Barcode</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                      
                                                            <img src="{{ asset($item->barcode_path) }}" alt="Product Barcode" style="width: 265px;height:50px">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning"> <a href="{{ asset($item->barcode_path) }}" download>Download</a></button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                        </tr>

                        <!-- Modal -->

                    </div> <!-- container-fluid -->
                </div>
        </div>
        <!-- container-fluid -->
    </div>
    @endif

    </div>

    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    @if ($layout == 0)
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        @foreach ($stocks as $item)
            <script>
                jQuery(document).ready(function() {
               $('#add-stocks{{ $item->id }}').click(function(){
                 var stocks=$('#stocks{{ $item->id }}').val();
                 var product_id=$('#product_id{{ $item->id }}').val();
                 var stockcategory = $('#stockcategory').val();
                
                 jQuery.ajax({
                            url: '{{ url('inventory/upgrade-stocks') }}',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                product_id:product_id,
                                stocks: stocks,
                                stockcategory:stockcategory
                            },
                           
                            success: function(response) {
                               
                                $('.modal').modal('hide');
                            },
                            error: function(xhr, status, error) {
                                var errorMessage = xhr.status + ': ' + xhr.statusText;
                                alert('Error - ' + errorMessage);
                            }
                        });

               })});
            </script>
        
        @endforeach



        <script>
            jQuery(document).ready(function() {

                $('#category').change(function() {
                    var category = $('#category').val();
                    if (category == 'all') {
                        window.location.reload();
                    } else {


                        jQuery.ajax({
                            url: '{{ url('inventory/filter-stocks') }}',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                category: category,
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
    @elseif ($layout == 1)
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        </script>
    @elseif ($layout == 2)
        <!-- end row-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
        </script>
    @endif
    @include('inventory.footer')


</body>

</html>
