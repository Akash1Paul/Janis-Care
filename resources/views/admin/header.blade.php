<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin</title>
        <link rel="shortcut icon" href="img/janiscare-favicon.svg" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="MyraStudio" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('/assets/images/janiscare-favicon.svg') }}">
        <!-- App css -->
        <link href="{{ url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{url('assets/custom.css')}}">
        <link rel="stylesheet" href="{{url('/assets/custom.css')}}" type="text/css"/>
        <link rel="stylesheet" href="{{url('/assets/multiselect.css')}}" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    </head>

@section('header')
    <header id="page-topbar">
        <div class="navbar-header">
            <a href="{{url('admin/customers')}}"><img src="https://website-project.in/jeniscare/public/img/janiscare-logo.svg" width="15%" alt="" style="height:160px;width:20%" ></a>
          
            <!-- LOGO -->
            <div class="navbar-brand-box d-flex align-items-left">
                <button type="button" class="btn btn-sm mr-2 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <div class="cart-icon d-inline-block ml-2">
                    
                    <a href="{{ url('admin/carts') }}" class="dropdown-item d-inline-block w-auto p-0">
                        <i class="fas fa-shopping-cart mr-1"></i>
                        <span>Cart <sup id="carts"></sup></span>
                    </a>
                </div>
                <div class="dropdown d-inline-block ml-2">
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                        aria-labelledby="page-header-search-dropdown">
                    </div>
                </div>

        


                <div class="dropdown d-inline-block ml-2">
                    <button type="button" class="btn header-item waves-effect waves-light"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{url('/assets/images/users/avatar-3.jpg')}}"
                        alt="Header Avatar">
                        <span class="d-none d-sm-inline-block ml-1">{{ session()->get('name','Admin') }}</span>
                        <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                  
                        <a  href="{{ url('logout') }}" class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            <span>Log Out</span>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </header>
@endsection

    @section('topnav')
    <div class="topnav p-0">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">    
                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="{{ url('admin/users') }}" class="nav-link dropdown-toggle arrow-none" id="topnav-pages">
                                <i class="fa fa-user"></i>Roles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ url('admin/customers') }}">
                                <i class="fa fa-user"></i>Customers
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{ url('admin/category') }}" class="nav-link dropdown-toggle arrow-none" id="topnav-forms">
                                <i class="fa fa-folder"></i>Categories </a>            
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{ url('admin/products') }}" class="nav-link dropdown-toggle arrow-none" id="topnav-components">
                                <i class="fa fa-box"></i>Products</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{ url('admin/product-availability') }}" class="nav-link dropdown-toggle arrow-none"
                                id="topnav-components">
                                <i class="fa fa-map-pin"></i>City-Wise Products</a>
                        </li>
                        
                       
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('admin/orders') }}">
                                <i class="fas fa-lightbulb"></i>Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('admin/vehicle') }}">
                                <i class="fas fa-bicycle"></i>Vehicles
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{url('admin/correction')}}">
                                <i class="fas fa-marker"></i>Correction
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin/warehouse') }}">
                                <i class="fa fa-layer-group"></i>Inventory
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>  
    
    
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 $(document).ready(function() {

         jQuery.ajax({
             url: '{{ url('admin/total-carts') }}',
             type: 'GET',
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             success: function(response) {
                 $('#carts').html(response.total_carts);
             }
         });    
 });
</script>