<!doctype html>
<html lang="en">
  <head>
    <title>Janis Care</title>
    <link rel="icon" type="img" href="{{url('usernew/img/janiscare-favicon.svg')}}">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Poppins -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- Gothic a1 -->

    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{url('usernew/css/style.css')}}">
    <link rel="stylesheet" href="{{url('usernew/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{url('usernew/css/owl.theme.default.min.css')}}" />
  </head>
  
  <body>

    <!-- header -->
    @section('header')
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="#"><img src="{{url('usernew/img/janiscare-logo.png')}}" alt="img not found"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="fa-solid fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                  <ul class="navbar-nav"> 
                    <li class="nav-item">
                      <a class="nav-link home" href="{{url('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link about" href="{{url('about')}}">About Us</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link products" href="{{url('product')}}">Products</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link infrastructure" href="{{url('infrastructure')}}">Infrastructure</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link contact" href="{{url('contact')}}">Contact Us</a>
                    </li>
                @if(auth()->user() && auth()->user()->email != '')
                    <li class="nav-item">
                        <a class="nav-link login" href="{{ url('user-logout') }}">Logout</a>
                    </li>
                    <div class="cart-icon d-inline-block ml-3">
                      <a href="{{ url('checkout') }}" class="dropdown-item d-inline-block w-auto p-0">
                          <i class="fas fa-shopping-cart mr-1"></i>
                          <span> <sup id="carts"></sup></span>
                      </a>
                  </div>
                @else
                    <li class="nav-item">
                        <a class="nav-link login" href="{{ url('user-login') }}">Login/Guest</a>
                    </li>
                    
                @endif
                
                    <li class="nav-item">
                      <a class="nav-link" href="#"><img src="{{url('usernew/img/search.png')}}" class="search-img" alt="img not found"></a>
                    </li>
                    
                  </ul>
                </div>
              </nav>
        </div>
    </header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

      
        $.ajax({
            url: '{{ url('users/total-carts') }}',
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- header end -->
  
    @endsection
    