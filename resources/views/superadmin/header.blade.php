<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> SuperAdmin</title>
    <link rel="shortcut icon" href="img/janiscare-favicon.svg" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('/assets/images/janiscare-favicon.svg') }}">
    <!-- App css -->
    <link href="{{ url('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ url('assets/custom.css') }}">
    <link rel="stylesheet" href="{{ url('assets/custom.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ url('assets/multiselect.css') }}" type="text/css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    
</head>

@section('header')
    <header id="page-topbar">
        <div class="navbar-header">
            <a href="{{ url('superadmin/dashboard') }}"><img
                    src="https://website-project.in/jeniscare/public/img/janiscare-logo.svg" width="15%" alt=""
                    style="height:160px;width:20%"></a>

            <!-- LOGO -->
            <div class="navbar-brand-box d-flex align-items-left">
                <button type="button" class="btn btn-sm mr-2 font-size-16 d-lg-none header-item waves-effect waves-light"
                    data-toggle="collapse" data-target="#topnav-menu-content">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>

            <div class="d-flex align-items-center">

                <div class="cart-icon d-inline-block">
                    <a href="{{ url('superadmin/report') }}" class="dropdown-item d-inline-block w-auto p-0">
                        <i class="fa fa-file mr-1"></i>Reports
                    </a>
                </div>

                <div class="cart-icon d-inline-block ml-3">
                    <a href="{{ url('superadmin/carts') }}" class="dropdown-item d-inline-block w-auto p-0">
                        <i class="fas fa-shopping-cart mr-1"></i>
                        <span>Cart <sup id="carts"></sup></span>


                    </a>
                </div>
                <div class="cart-icon d-inline-block ml-3">
                    <a href="#" class="dropdown-item d-inline-block w-auto p-0" data-toggle="modal" data-target=".bd-example-modal-lg">
                        <i class="fas fa-bell mr-1"></i>

                        <span>Notification <sup id="fda"></sup></span>

                    </a>
                </div>

                <div class="dropdown d-inline-block ml-2">
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                        aria-labelledby="page-header-search-dropdown">
                    </div>
                </div>

                
                <div class="dropdown d-inline-block ml-2">
                    <button type="button" class="btn header-item waves-effect waves-light" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user"
                            src="{{ url('/assets/images/users/avatar-3.jpg') }}" alt="Header Avatar">
                        <span class="d-none d-sm-inline-block ml-1">{{ session()->get('name', 'SuperAdmin') }}</span>
                        <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">

                        <a href="{{ url('logout') }}"
                            class="dropdown-item d-flex align-items-center justify-content-between">
                            <span>Log Out</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </header>
@endsection

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
   
        <div class="modal-content">
            <h3 class="mt-3 ml-3">Expire FDA Licence</h3>
          <div class="table-responsive">
              <table class="table table-bordered mb-0 mt-4" id="datatable">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Outlet name</th>
                          <th>Customer Name</th>
                          <th>Expiry Date</th>
                      </tr>
                  </thead>
                  <tbody id='fda_data'>
                           
                  </tbody>
              </table>
          </div>
      </div>
    </div>
  </div>
  
  
@section('topnav')
    <div class="topnav p-0">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('superadmin/dashboard') }}">
                                <i class="mdi mdi-home-analytics"></i>Dashboard </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{ url('superadmin/users') }}" class="nav-link dropdown-toggle arrow-none"
                                id="topnav-pages">
                                <i class="fa fa-user"></i>Roles</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{ url('superadmin/customers') }}" class="nav-link dropdown-toggle arrow-none"
                                id="topnav-pages">
                                <i class="fa fa-user"></i>Customers</a>
                        </li>
                        {{-- <li class="nav-item dropdown">
                            <a href="{{ url('superadmin/product-availability') }}" class="nav-link dropdown-toggle arrow-none"
                                id="topnav-components">
                                <i class="fa fa-map-pin"></i>City-Wise Products</a>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a href="{{ url('superadmin/category') }}" class="nav-link dropdown-toggle arrow-none"
                                id="topnav-forms">
                                <i class="fa fa-folder"></i>Categories </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{ url('superadmin/products') }}" class="nav-link dropdown-toggle arrow-none"
                                id="topnav-components">
                                <i class="fa fa-box"></i>Products</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('superadmin/orders') }}">
                                <i class="fas fa-lightbulb"></i>Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('superadmin/correction') }}">
                                <i class="fas fa-marker"></i>Correction
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('superadmin/warehouse') }}">
                                <i class="fa fa-layer-group"></i>Inventory
                            </a>
                        </li>


                    </ul>
                </div>
            </nav>
        </div>
    </div>
    @if (session('status'))
        <div class="alert alert-success fade show">
            {{ session('status') }}
        </div>
    @elseif(session('delete'))
        <div class="alert alert-danger fade show">
            {{ session('delete') }}
        </div>
    @endif
    <script>
        // Hide the success message alert after 2 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 2000);
    </script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

      
        $.ajax({
            url: '{{ url('superadmin/total-carts') }}',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#carts').html(response.total_carts);
            },
            error: function(error) {
                console.error('Error updating cart count:', error);
            }
        });
    
    });
</script>

<script>
    $(document).ready(function() {

        jQuery.ajax({
            url: '{{ url('superadmin/get-fda-licence') }}',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#fda').html(response.count);
                $('#fda_data').html(response.data);

            }
        });
    });
</script>



