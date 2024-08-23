<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Dashboard - Back Office</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="MyraStudio" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{url('/assets/images/janiscare-favicon.svg')}}">
        <link href="{{url('/plugins/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App css -->
        <link href="{{url('/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('/assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{url('/assets/custom.css')}}" type="text/css"/>
        <link rel="stylesheet" href="{{url('/assets/multiselect.css')}}" type="text/css"/>
    </head>

@section('header')
    
<header id="page-topbar">
        <div class="navbar-header">
            <a href="{{url('backoffice/customers')}}"><img src="https://website-project.in/jeniscare/public/img/janiscare-logo.svg" width="15%" alt="" style="height:160px;width:20%" ></a>
            <!-- LOGO -->
            <div class="navbar-brand-box d-flex align-items-left">
                <a href="#" class="logo">
                </a>

                <button type="button" class="btn btn-sm mr-2 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <div class="cart-icon d-inline-block ml-2">
                    <a href="{{ url('backoffice/carts') }}" class="dropdown-item d-inline-block w-auto p-0">
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
                    <button type="button" class="btn header-item waves-effect waves-light"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{url('/assets/images/users/avatar-3.jpg')}}"
                            alt="Header Avatar">
                        <span class="d-none d-sm-inline-block ml-1">Back Office</span>
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
  

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 $(document).ready(function() {

         jQuery.ajax({
             url: '{{ url('backoffice/total-carts') }}',
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

<script>
    $(document).ready(function() {

        jQuery.ajax({
            url: '{{ url('backoffice/get-fda-licence') }}',
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