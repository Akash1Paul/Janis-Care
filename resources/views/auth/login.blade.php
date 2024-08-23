<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Janis Care | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="MyraStudio" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{url('/assets/images/janiscare-favicon.svg')}}">

        <!-- App css -->
        <link href="{{url('/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('/assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body>
 
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center min-vh-100">
                            <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                                <div class="row align-items-center">
                                    <div class="col-lg-5 d-none d-lg-block rounded-left">
                                        <div class="pl-5">
                                            <img src="https://website-project.in/jeniscare/public/img/janiscare-logo.svg" width="100%" alt="">
                                        </div>
                                    </div>
                                   
                                           
                                       
                                    <div class="col-lg-7">
                                        <div class="p-5">
                                            {{-- <div class="text-center mb-5">
                                                <a href="#" class="text-dark font-size-22 font-family-secondary">
                                                    <i class="mdi mdi-album"></i> <b class="align-middle">Warehouse</b>
                                                </a>
                                            </div> --}}
                                            @if ($errors->any())
                                            <div class="alert alert-danger mt-0">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                            <h1 class="h5 mb-1">Welcome Back!</h1>
                                            <p class="text-muted mb-4">Enter your email address and password to access your panel.</p>
                                            <form action="{{url('login')}}" class="user" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                                </div>
                                                <button type="submit" class="btn btn-success btn-block waves-effect waves-light"> Log In </button>
                                                
                                            </form>
    
                                            <!-- <div class="row mt-4">
                                                <div class="col-12 text-center">
                                                    <p class="text-muted mb-2"><a href="#" class="text-muted font-weight-medium ml-1">Forgot your password?</a></p>
                                                    <p class="text-muted mb-0">Don't have an account? <a href="#" class="text-muted font-weight-medium ml-1"><b>Sign Up</b></a></p>
                                                </div> 
                                            </div> -->
                                            <!-- end row -->
                                        </div> <!-- end .padding-5 -->
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div> <!-- end .w-100 -->
                        </div> <!-- end .d-flex -->
                    </div> <!-- end col-->
                </div> <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
    
        <!-- jQuery  -->
        <script src="{{url('/assets/js/jquery.min.js')}}"></script>
        <script src="{{url('/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{url('/assets/js/metismenu.min.js')}}"></script>
        <script src="{{url('/assets/js/waves.js')}}"></script>
        <script src="{{url('/assets/js/simplebar.min.js')}}"></script>
    
        <!-- App js -->
        <script src="{{url('/assets/js/theme.js')}}"></script>
    
    </body>
    
    </html>