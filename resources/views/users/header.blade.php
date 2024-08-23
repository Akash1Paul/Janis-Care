<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home - Janis Care</title>
    <link rel="shortcut icon" href="img/janiscare-favicon.svg" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.icon') }}" type="image/x-icon" />

    <link rel="stylesheet" href="{{url('user/font-icons.css')}}">
    <link rel="stylesheet" href="{{url('user/plugins.css')}}">
    <link rel="stylesheet" href="{{url('user/style.css')}}">
    <link rel="stylesheet" href="{{url('user/responsive.css')}}">
    <script src="https://checkout.stripe.com/checkout.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/css/all.min.css" integrity="sha512-6c4nX2tn5KbzeBJo9Ywpa0Gkt+mzCzJBrE1RB6fmpcsoN+b/w/euwIMuQKNyUoU/nToKN3a8SgNOtPrbW12fug==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

@section('header')

<!-- HEADER AREA START (header-3) -->
<header class="ltn__header-area ltn__header-3">       

        <!-- ltn__header-middle-area start -->
        <div class="ltn__header-middle-area">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="site-logo">
                            <a href=""><img src="{{ url('user/img/janiscare-logo.svg') }}" alt="Logo"></a>
                        </div>
                    </div>
                    <div class="col header-contact-serarch-column d-none d-lg-block">
                        <div class="header-contact-search">
                            <!-- header-feature-item -->
                            <div class="header-feature-item">
                                <div class="header-feature-icon">
                                    {{-- <i class="icon-call"></i> --}}
                                </div>
                                <div class="header-feature-info">
                                    {{-- <h6>Phone</h6> --}}
                                    {{-- <p><a href="tel:0123456789">+91 93139 24093</a></p> --}}
                                </div>
                            </div>
                            <!-- header-search-2 -->
                            <div class="header-search-2">
                                <form id="#123" method="get"  action="#">
                                    <input type="text" name="search" id="myInput" placeholder="Search here..."/>
                                    <button type="submit">
                                        <span><i class="fa fa-search"></i></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <!-- header-options -->
                        <div class="ltn__header-options">
                            <ul>
                                <li class="d-none">
                                
                                </li>
                                <li class="d-lg-none">
                                    <!-- header-search-1 -->
                                    <div class="header-search-wrap">
                                        <div class="header-search-1">
                                            <div class="search-icon">
                                                <i class="icon-search  for-search-show"></i>
                                                <i class="icon-cancel  for-search-close"></i>
                                            </div>
                                        </div>
                                        <div class="header-search-1-form">
                                            <form id="#" method="get"  action="#">
                                                <input type="text" name="search" value="" placeholder="Search here..."/>
                                                <button type="submit">
                                                    <span><i class="icon-search"></i></span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-none---"> 
                                    <!-- user-menu -->

                        <div class="ltn__drop-menu user-menu">
                                        <ul>
                                            <li>
                                                @if (isset($users[0]['image']))
                                                <a href="#">
                                                    <img style="width:60px;70px" src="{{ url('image/'.$users[0]['image']) }}" alt="">
                                                </a>
                                         
                                                    @else
                                                    <a href="#"><i class="fa fa-user"></i></a>
                                                   
                                                @endif
                                                
                                                <ul>
                                                    @if(auth()->check() && auth()->user()->roles=='customer')
                                                    <li><a href="{{ url('my-account') }}">My Account</a></li>
                                                    <li><a href="{{ url('userlogout') }}">Log out</a></li>
                                                    
                                                    @else
                                              <li><a href="{{ url('operation') }}">Sign in</a></li>
                                       
                                        @endif

                                     </ul>
                                  </li>
                                </ul>  
                            </div>
                                    
                                </li>
                                <li> 
                                    @if (auth()->check() && auth()->user()->roles=='customer')  
                                    @php
                                    $subtotal = 0;
                                    foreach ($carts as $item) {
                                        $subtotal += $item->quantity * $item->price;
                                     }
                                    @endphp

                                    <!-- mini-cart 2 -->
                                    <div class="mini-cart-icon mini-cart-icon-2">
                                    
                                        <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
                                            <span class="mini-cart-icon">
                                                <i class="fa fa-shopping-cart"></i>
                                                <sup>{{count($carts)}}</sup>
                                            </span>
                                            <h6><span>Your Cart</span> <span class="ltn__secondary-color">{{ $subtotal }} INR</span></h6>
                                        </a>
                                    </div>
                                </li>
                                @endif
                            </ul>
                            
                        </div>
                        @if (auth()->check() && auth()->user()->roles=='customer')
                         {{ 'Welcome ' .auth()->user()->name }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- header-bottom-area start -->
        <div class="header-bottom-area ltn__border-top ltn__header-sticky  ltn__sticky-bg-white--- ltn__sticky-bg-secondary ltn__secondary-bg section-bg-1 menu-color-white d-none d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="col header-menu-column justify-content-center">
                        <div class="sticky-logo">

                            <div class="site-logo">
                                <a href=""><img src="{{ url('user/img/janiscare-logo.png') }}" alt="Logo"></a>
    
                            </div>
                        
                        </div>
                        <div class="header-menu header-menu-2">
                            <nav>
                                <div class="ltn__main-menu">
                                    <ul>
                                        <li class="menu-icon"><a href="#">Home</a></li>
                                        <li class="menu-icon"><a href="{{url('about')}}">About</a></li>
                                        <li class="menu-icon"><a href="{{ url('products') }}">Products</a></li>
                                        <li class="menu-icon"><a href="{{url('contact')}}">Contact</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-bottom-area end -->
</header>
    <!-- HEADER AREA END -->
@endsection


@section('mobile-header')
<!-- MOBILE MENU START -->
  <div class="mobile-header-menu-fullwidth mb-30 d-block d-lg-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Mobile Menu Button -->
                <div class="mobile-menu-toggle d-lg-none">
                    <span>MENU</span>
                    <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                        <svg viewBox="0 0 800 INR 600 INR">
                            <path d="M300 INR,220 C300 INR,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300 INR,200 INR 300 INR,200 INR" id="top"></path>
                            <path d="M300 INR,320 L540,320" id="middle"></path>
                            <path d="M300 INR,210 C300 INR,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300 INR,190 300 INR,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MOBILE MENU END -->
@endsection

@section('mobile-menu')
    <!-- Utilize Mobile Menu Start -->
    <div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
        <div class="ltn__utilize-menu-inner ltn__scrollbar">
            <div class="ltn__utilize-menu-head">
                <div class="site-logo">
                    <a href="#"><img src="{{ url('img/janiscare-logo.png') }}" alt="Logo"></a>
                </div>

                <button class="ltn__utilize-close">×</button>
            </div>
            <div class="ltn__utilize-menu-search-form">
                <form action="#">
                    <input type="text" placeholder="Search...">
                    <button><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="ltn__utilize-menu">
                <ul>
                    <li class="menu-icon"><a href="#">Home</a></li>
                    <li class="menu-icon"><a href="{{url('about')}}">About</a></li>
                    <li class="menu-icon"><a href="{{ url('products') }}">Products</a></li>
                    <li><a href="{{url('contact')}}">Contact</a></li>
                </ul>
            </div>
            <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
                <ul>
                    <li>
                        <a href="#" title="My Account">
                            <span class="utilize-btn-icon">
                                <i class="far fa-user"></i>
                            </span>
                            My Account
                        </a>
                    </li>
             
                    <li>
                        <a href="#" title="Shoping Cart">
                            <span class="utilize-btn-icon">
                                <i class="fas fa-shopping-cart"></i>
                                <sup>0</sup>
                            </span>
                            Shoping Cart
                        </a>
                    </li>
                </ul>
            </div>
            <div class="ltn__social-media-2">
                <ul>
                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Utilize Mobile Menu End -->
@endsection