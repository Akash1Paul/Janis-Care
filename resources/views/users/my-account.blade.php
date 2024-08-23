@include('users.header')

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

<!-- Body main wrapper start -->
<div class="body-wrapper">


    @yield('header')
    @yield('mobile-header')
    @include('users.cart')
    @yield('mobile-menu')

    
    <div class="ltn__utilize-overlay"></div>


    <!-- WISHLIST AREA START -->
    <div class="liton__wishlist-area pb-70 ">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <!-- PRODUCT TAB AREA START -->
                    <div class="ltn__product-tab-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="ltn__tab-menu-list mb-50">
                                        <div class="nav">
                                            <a class="active show" data-bs-toggle="tab" href="#liton_tab_1_5">Account Details <i class="fas fa-user"></i></a>
                                           
                                            <a data-bs-toggle="tab" href="#liton_tab_1_2">Orders <i class="fas fa-file-alt"></i></a>
                                         
                                            <a data-bs-toggle="tab" href="#liton_tab_1_4">address <i class="fas fa-map-marker-alt"></i></a>
                                            <a href="{{ url('userlogout') }}">Logout <i class="fas fa-sign-out-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="tab-content">
                                    
                                        <div class="tab-pane fade active show" id="liton_tab_1_5">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>The following addresses will be used on the checkout page by default.</p>
                                                <div class="ltn__form-box">
                                                    <form action="{{ url('my-account') }}" method="POST">
                                                        @csrf
                                                        <div class="row mb-50">
                                                            <div class="col-md-6">
                                                                <label>Name:</label>
                                                                <input type="text" name="buisness_name" value="{{ $user['buisness_name'] }}" placeholder="Enter Your Name">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Phone:</label>
                                                                <input type="text" name="phone" value="{{ $user['phone'] }}" placeholder="Enter Your Phone">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Billing Address:</label>
                                                                <input type="text" name="billing_address" placeholder="Enter Your Address" value="{{ $user['billing_address'] }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Delivery Address:</label>
                                                                <input type="text" name="delivery_address" placeholder="Enter Your Address" value="{{ $user['delivery_address'] }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Pincode:</label>
                                                                <input type="text" name="pincode" placeholder="Enter Your pincode" value="{{ $user['pincode'] }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Image (optional):</label>
                                                                <input class="form-control" type="hidden" name="photo" value="{{ $user['photo'] }}">
                                                                <input class="form-control" type="file" name="photo">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Credit Period:</label>
                                                                <input type="text" name="credit_period" placeholder="Enter Your pincode" value="{{ $user['credit_period'] }} Days">
                                                            </div>
                                                        </div>
                                                        {{-- <fieldset>
                                                            <legend>Password change</legend>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label>Current password (leave blank to leave unchanged):</label>
                                                                    <input type="password" name="ltn__name">
                                                                    <label>New password (leave blank to leave unchanged):</label>
                                                                    <input type="password" name="ltn__lastname">
                                                                    <label>Confirm new password:</label>
                                                                    <input type="password" name="ltn__lastname">
                                                                </div>
                                                            </div>
                                                        </fieldset> --}}
                                                        <div class="btn-wrapper">
                                                            <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="liton_tab_1_2">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Email</th>
                                                                <th>Total Price</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                     
                                                            @foreach ($orders as $key=>$item )
                                                            <tr>
                                                                <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                                                                <td>{{ $item->email }}</td>
                                                                <td>{{ $item->total_price }}</td>
                                                                <td>{{ $item->status }}</td>
                                                                <td><a href="{{ url('order-details/'.$item->id) }}">
                                                                    <button><i class="fas fa-eye"></i></button></a></td>
                                                            </tr>
                                                            @endforeach
                                                         
                                                        </tbody>
                                                    </table>
                                                </div>


                                                
                                            </div>
                                        </div>
                                      
                                        <div class="tab-pane fade" id="liton_tab_1_4">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>The following addresses will be used on the checkout page by default.</p>
                                                <div class="row">
                                                    <div class="col-md-6 col-12 learts-mb-30">
                                                        <h4>Billing Address <small><a href="#">edit</a></small></h4>
                                                        <address>
                                                           <p>{{ $user['billing_address'] }}</p>
                                                        </address>
                                                    </div>
                                                    <div class="col-md-6 col-12 learts-mb-30">
                                                        <h4>Shipping Address <small><a href="#">edit</a></small></h4>
                                                        <address>
                                                           <p>{{ $user['delivery_address'] }}</p>
                                                        </address>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PRODUCT TAB AREA END -->
                </div>
            </div>
        </div>
    </div>
    <!-- WISHLIST AREA START -->

    <!-- CALL TO ACTION START (call-to-action-6) -->
    <div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="img/1.jpg--">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                        <div class="coll-to-info text-color-white">
                            <h1>Buy medical disposable face mask <br> to protect your loved ones</h1>
                        </div>
                        <div class="btn-wrapper">
                            <a class="btn btn-effect-3 btn-white" href="shop.html">Explore Products <i class="icon-next"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CALL TO ACTION END -->


    @include('users.footer')