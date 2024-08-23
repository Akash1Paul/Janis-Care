<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Dashboard - Territory</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="MyraStudio" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}"> 

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{url('/assets/images/janiscare-favicon.svg')}}">

        <!-- App css -->
        <link href="{{url('/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('/assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{url('/assets/custom.css')}}">
    </head>

@section('header')
<header id="page-topbar">
    <div class="navbar-header">
        <a href="{{url('territory/orders')}}"><img src="https://website-project.in/jeniscare/public/img/janiscare-logo.svg" width="15%" alt="" style="height:160px;width:20%" ></a>
        <!-- LOGO -->
        <div class="navbar-brand-box d-flex align-items-left">
            <a href="#" class="logo">
            </a>

            <button type="button" class="btn btn-sm mr-2 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex align-items-center">
            {{-- <div class="cart-icon d-inline-block ml-2">
                <a href="{{ url('territory/carts') }}" class="dropdown-item d-inline-block w-auto p-0">
                    <i class="fas fa-shopping-cart mr-1"></i>
                    <span>Cart <sup id="carts"></sup></span>
                </a>
            </div> --}}
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn header-item waves-effect waves-light"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{url('/assets/images/users/avatar-3.jpg')}}"
                        alt="Header Avatar">
                    <span class="d-none d-sm-inline-block ml-1">Territory Manager</span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{url('logout')}}">
                        <span>Log Out</span>
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</header>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 $(document).ready(function() {

         jQuery.ajax({
             url: '{{ url('territory/total-carts') }}',
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