@include('supersuperadmin.header')

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <div class="main-content">

            @yield('header')

            @yield('topnav')
            <div class="page-content">
                <div class="container-fluid">
                    @if ($layout == 0)
                     
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-6">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="d-flex justify-content-between">
                                            <a href="{{ url('superadmin/add-coupon') }}" style='text-decoration:none;'>
                                                <button class="btn btn-primary">Add Coupon</button></a>
                                            <form>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Search ..."
                                                        aria-label="Recipient's username">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="submit"><i
                                                                class="mdi mdi-magnify"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0 mt-4">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Coupon Code </th>
                                                        <th>User</th>
                                                        <th>valid-date</th>
                                                        <th>Discount Off </th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id='myTable'>
                                                    @isset($coupons)
                                                        @foreach ($coupons as $key => $item)
                                                            <tr>
                                                                <td class="mt-2 mr-2">{{ $key + 1 }}</td>
                                                                <td>{{ $item->coupon_code }}</td>
                                                                <td>{{ $item->user }}</td>
                                                                <td>{{ $item->valid_date }}</td>
                                                                <td>{{ $item->discount_off }}</td>

                                                                <td>
                                                                    <a
                                                                        href="{{ url('superadmin/edit-coupon/' . $item->id) }}"><button
                                                                            class="btn btn-primary"
                                                                            style="color
                                        :white">Edit</button></a>
                                                                    <a
                                                                        href="{{ url('superadmin/delete-coupon/' . $item->id) }}"><button
                                                                            class="btn btn-primary">Delete</button></a>
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
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <a href="{{ url('superadmin/coupons') }}"><button
                                            class="btn btn-primary">Back</button></a>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                            <li class="breadcrumb-item active">Add Coupon</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-11 col-md-11 col-11 mt-5 ml-5">



                                <div class="card">
                                    <div class="card-body">

                                        <form action="{{ url('superadmin/add-coupon') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01"><b> Coupon code</b></label>
                                                    <input type="text" class="form-control" id="validationTooltip01"
                                                        name="coupon_code" placeholder="Enter coupons">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01"><b> User</b></label>
                                                    <select name="user" id="" class="form-control">
                                                        <option value="">Select Users</option>
                                                        @foreach ($users as $item)
                                                            <option value="{{ $item->email }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01"><b> Discount off</b></label>
                                                    <input type="number" class="form-control" name="discount_off"
                                                        placeholder="Enter coupons">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01"><b> Valid date</b></label>
                                                    <input type="date" class="form-control" name="valid_date">
                                                </div>
                                            </div>
                                            <br>
                                            <button class="btn btn-primary waves-effect waves-light" type="submit"> Add
                                                coupons</button>
                                        </form>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </div> <!-- end col-->
                        </div> <!-- end row -->
                        <!-- end row-->
                    @elseif($layout == 2)
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <a href="{{ url('superadmin/users') }}"><button
                                            class="btn btn-primary">Back</button></a>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                            <li class="breadcrumb-item active">Edit Coupon</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">

                            <div class="col-xl-11 col-md-11 col-11 mt-5 ml-5">
                                <div class="card">
                                    <div class="card-body">

                                        <form action="{{ url('superadmin/edit-coupon/' . $coupon->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01"><b> Coupon code</b></label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $coupon->coupon_code }}" name="coupon_code"
                                                        placeholder="Enter coupons">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01"><b> Users</b></label>
                                                    <select name="user" class="form-control">
                                                        @foreach ($user as $item)
                                                            <option value="{{ $item->email }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01"><b> Discount off</b></label>
                                                    <input type="number" class="form-control"
                                                        value="{{ $coupon->discount_off }}" name="discount_off"
                                                        placeholder="Enter coupons">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationTooltip01"><b> Valid date</b></label>
                                                    <input type="date" class="form-control"
                                                        value="{{ $coupon->valid_date }}" name="valid_date">
                                                </div>
                                            </div>
                                            <br>
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                                Update Coupon</button>
                                        </form>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </div>
                            <!-- end col-->
                        </div>
                        <!-- end row -->
                        <!-- end row-->

                    @endif
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    @include('supersuperadmin.footer')

</body>

</html>
