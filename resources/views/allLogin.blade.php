<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Dashboard</title>
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

    <body>

        <div class="container">
            <div class="row mt-5 pt-5">
                <div class="col-sm-12">
                    <div class="home-tab">
                      <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                          <div class="row">
                              <div class="col-xl-3 col-md-6 m-t35 mb-xl-0 mb-3">
                                  <div class="card card-coin gradient-one allBoxes">
                                      <div class="card-body">
                                          <h3 class="card-title">Warehouse Login</h3>
                                          <div class="d-block mt-4">
                                            <a href="{{url('operation')}}" target="_blank"><button type="button" class="btn btn-warning allLoginBtn">Login page</button></a>
                                          </div>
                                          <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span> -->
                                      </div>
                                  </div>
                              </div>
                              <div class="col-xl-3 col-md-6 m-t35 mb-xl-0 mb-3">
                                  <div class="card card-coin gradient-two allBoxes">
                                      <div class="card-body">
                                          <h3 class="card-title">Runner Login</h3>
                                          <div class="d-block mt-4">
                                            <a href="{{url('operation')}}" target="_blank"><button type="button" class="btn btn-warning allLoginBtn">Login page</button></a>
                                          </div>
                                          <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span> -->
                                      </div>
                                  </div>
                              </div>
                              <div class="col-xl-3 col-md-6 m-t35 mb-xl-0 mb-3">
                                  <div class="card card-coin gradient-two allBoxes">
                                      <div class="card-body">
                                          <h3 class="card-title">Territory Manager Login</h3>
                                          <div class="d-block mt-4">
                                            <a href="{{url('operation')}}" target="_blank"><button type="button" class="btn btn-warning allLoginBtn">Login page</button></a>
                                          </div>
                                          <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span> -->
                                      </div>
                                  </div>
                              </div>
                              <div class="col-xl-3 col-md-6 m-t35 mb-xl-0 mb-3">
                                  <div class="card card-coin gradient-two allBoxes">
                                      <div class="card-body">
                                          <h3 class="card-title">Relationship Manager Login</h3>
                                          <div class="d-block mt-4">
                                            <a href="{{url('operation')}}" target="_blank"><button type="button" class="btn btn-warning allLoginBtn">Login page</button></a>
                                          </div>
                                          <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span> -->
                                      </div>
                                  </div>
                              </div>

                              <div class="col-xl-3 col-md-6 m-t35 mb-xl-0 mb-3">
                                  <div class="card card-coin gradient-two allBoxes">
                                      <div class="card-body">
                                          <h3 class="card-title">Back Office Login</h3>
                                          <div class="d-block mt-4">
                                            <a href="{{url('operation')}}" target="_blank"><button type="button" class="btn btn-warning allLoginBtn">Login page</button></a>
                                          </div>
                                          <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span> -->
                                      </div>
                                  </div>
                              </div>
                              <hr>


                              <div class="col-12">
                                <hr>
                                  <div class="row">
                                    <div class="col-xl-3 col-md-6 m-t35 mb-xl-0 mb-3">
                                        <div class="card card-coin gradient-two allBoxes">
                                            <div class="card-body">
                                                <h3 class="card-title">Admin Login</h3>
                                                <div class="d-block mt-4">
                                                  <a href="{{url('operation')}}" target="_blank"><button type="button" class="btn btn-warning allLoginBtn">Login page</button></a>
                                                </div>
                                                <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 m-t35 mb-xl-0 mb-3">
                                        <div class="card card-coin gradient-two allBoxes">
                                            <div class="card-body">
                                                <h3 class="card-title">Super Admin Login</h3>
                                                <div class="d-block mt-4">
                                                  <a href="{{url('operation')}}" target="_blank"><button type="button" class="btn btn-warning allLoginBtn">Login page</button></a>
                                                </div>
                                                <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span> -->
                                            </div>
      
                                        </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-12">
                                <hr>
                                  <div class="row">
                                    <div class="col-xl-3 col-md-6 m-t35 mb-xl-0 mb-3">
                                        <div class="card card-coin gradient-two allBoxes">
                                            <div class="card-body">
                                                <h3 class="card-title">Inventory Login</h3>
                                                <div class="d-block mt-4">
                                                  <a href="{{url('operation')}}" target="_blank"><button type="button" class="btn btn-warning allLoginBtn">Login page</button></a>
                                                </div>
                                                <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span> -->
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-12">
                                <hr>
                                  <div class="row">
                                    <div class="col-xl-3 col-md-6 m-t35 mb-xl-0 mb-3">
                                        <div class="card card-coin gradient-two allBoxes">
                                            <div class="card-body">
                                                <h3 class="card-title">User Login</h3>
                                                <div class="d-block mt-4">
                                                  <a href="{{url('operation')}}" target="_blank"><button type="button" class="btn btn-warning allLoginBtn">Login page</button></a>
                                                </div>
                                                <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span> -->
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>

        <!-- jQuery  -->
        <script src="{{url('/assets/js/jquery.min.js')}}"></script>
        <script src="{{url('/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{url('/assets/js/waves.js')}}"></script>
        <script src="{{url('/assets/js/simplebar.min.js')}}"></script>
        
        <!-- Sparkline Js-->
        <script src="{{url('/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
        
        <!-- Chart Js-->
        <script src="{{url('/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
        
        <!-- Chart Custom Js-->
        <script src="{{url('/assets/pages/knob-chart-demo.js')}}"></script>
        
        <!-- Morris Js-->
        <script src="{{url('/plugins/morris-js/morris.min.js')}}"></script>
        
        <!-- Raphael Js-->
        <script src="{{url('/plugins/raphael/raphael.min.js')}}"></script>
        
        <!-- Custom Js -->
        <script src="{{url('/assets/pages/dashboard-demo.js')}}"></script>
        
        <!-- App js -->
        <script src="{{url('/assets/js/theme.js')}}"></script>
        
    </body>

</html>