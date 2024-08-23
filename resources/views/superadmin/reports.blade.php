@include('superadmin.header')

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <div class="main-content">
            @yield('header')
            @yield('topnav')

         
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-13">Reports</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item">
                                <a href="#home" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                    <i class="mdi mdi-home-variant d-lg-none d-block"></i>
                                    <span class="d-none d-lg-block">Sales Statements With Item</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#menu1" data-toggle="tab" aria-expanded="flase" class="nav-link ">
                                    <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                    <span class="d-none d-lg-block">Item Wise</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#menu4" data-toggle="tab" aria-expanded="flase" class="nav-link ">
                                    <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                    <span class="d-none d-lg-block">Sales</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#menu5" data-toggle="tab" aria-expanded="flase" class="nav-link ">
                                    <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                    <span class="d-none d-lg-block">Consolidated</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#menu6" data-toggle="tab" aria-expanded="flase" class="nav-link ">
                                    <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                    <span class="d-none d-lg-block">Products</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#menu2" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                    <span class="d-none d-lg-block">Customers</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#menu3" data-toggle="tab" aria-expanded="false" class="nav-link">
                                    <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                    <span class="d-none d-lg-block">Stocks</span>
                                </a>
                            </li>
                           
                           
                        </ul>
                        
                          <div class="tab-content">
                            <div class="tab-pane  show active" id="home">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
        
                                                    <h4 class="card-title">Sales</h4>
                                                    <div class="col-md-5 mb-3">
                                                        <input type="date" name="from_date" id="from_date">
                                                        <input type="date" name="end_date" id="end_date">
                                                        <button class="btn btn-primary btn-sm" id="filter">Filter</button>
                                                        {{-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                                          <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                                          <span></span> <b class="caret"></b>
                                                        </div> --}}
                                                      </div>
                                                    <div class="fields d-flex">
                                                        
                                                        <div>
                                                            <div class="input-group">
                                                                <input type="text" id="search"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mx-2">
                                                            <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                        </div>
                                                                                           
                                                    </div>
                                                   
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p>Average Daily Sales: <span  id="avaragesalesyearly">{{$avaragesalesyearly}}</span> ₹</p>
                                                    
                                                    <p>Growth: {{$salesgrowth}}%</p>
                                                </div>
                                                <a class="btn btn-warning ml-3 float-right mb-2"
                                                href="{{ url('superadmin/salesexport') }}">
                                                       Export
                                                </a>
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0" id="datatable">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Bill No</th>
                                                                <th>Party Name</th>
                                                                <th>Product Name</th>
                                                                <th>Pack</th>
                                                                <th>QTY</th>
                                                                <th>Amount</th>
                                                                <th>Discount</th>
                                                                <th>Net Amt</th>
                                                                <th>Tax Payable</th>
                                                                <th>Net Ammount</th>
                                                            </tr>
                                                        </thead>
                                                      
                                                        <tbody id="filtersales">
                                                            @foreach ($orders as $index => $value)
                                                            @php                                                 
                                                            $products=explode(',',$value->product_id);
                                                            $moq=explode(',',$value->moq);
                                                            $price=explode(',',$value->price);
                                                            $ordersperday = [];
                                                            $count = 0;
                                                            $totalproduct = 0;
                                                            $ordersperday = explode(',', $value->moq);
                                                            foreach ($ordersperday as $i => $info) 
                                                            {
                                                                $count += $info;
                                                                $totalproduct = $i+1;
                                                            }
                                                        @endphp
                                                            <tr>
                                                              
                                                                <td>{{ date('d-m-Y',strtotime($value->updated_at)) }}</td>
                                                                <td>A{{$value->billno}}</td>
                                                            @foreach ($customers_details as $customers)
                                                                @if($customers->email == $value->email)
                                                                <td>{{$customers->company_name}}</td>
                                                                @endif
                                                            @endforeach
                                                           
                                                            <td>
                                                                @foreach ($product_details as $product)
                                                                @foreach ($ordersperday as $i => $info) 
                                                                  
                                                                    @if($product->product_id ==  $products[$i])
                                                                    {{ $product->product_name}},
                                                                    @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach ($product_details as $product)
                                                                @foreach ($ordersperday as $i => $info) 
                                                                  
                                                                    @if($product->product_id ==  $products[$i])
                                                                    {{ $product->packsize}},
                                                                    @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </td>
                                                                <td>
                                                                @foreach ($ordersperday as $i => $info) 
                                                                    {{ $moq[$i] }},
                                                                @endforeach
                                                                </td>
                                                                
                                                           
                                                           
                                                                
                                                                @php
                                                                $ordersperday = [];
                                                                $count = 0;
                                                                $ordersperday = explode(',', $value['moq']);
                                                                foreach ($ordersperday as $info) {
                                                                    $count += $info;
                                                                }
                                                                @endphp
                                                               {{-- <td>{{ $count }}</td> --}}
        
                                                              
                                                                <td>{{ round($value->total_price) }}.00</td>
                                                                <td>0.00</td>
                                                                <td>{{ round($value->total_price) }}.00</td>
                                                                <td>{{ round(round(($value->total_price)*6/100) *2) }}.00</td>
                                                                <td>{{ round($value->total_price + round(($value->total_price)*6/100) *2) }}.00</td>
                                                           
                                                           
                                                                
                                                        
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
        
                                            </div>
                                            <!-- end card-body-->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
        
                                                    <h4 class="card-title">Sales</h4>
                                                    <div class="col-md-5 mb-3">
                                                        <input type="date" name="from_date" id="from_date">
                                                        <input type="date" name="end_date" id="end_date">
                                                        <button class="btn btn-primary btn-sm" id="filter">Filter</button>
                                                        {{-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                                          <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                                          <span></span> <b class="caret"></b>
                                                        </div> --}}
                                                      </div>
                                                    <div class="fields d-flex">
                                                        
                                                        <div>
                                                            <div class="input-group">
                                                                <input type="text" id="search"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mx-2">
                                                            <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                        </div>
                                                                                           
                                                    </div>
                                                   
                                                </div>
                                               
                                                <a class="btn btn-warning ml-3 float-right mb-2"
                                                href="{{ url('superadmin/salesexport') }}">
                                                       Export
                                                </a>
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0" id="datatable">
                                                        <thead>
                                                            <tr>
                                                                <th>Item Description</th>
                                                                <th>Quatity</th>
                                                                <th>Free</th>
                                                                <th>Av.Rate</th>
                                                                <th>Amount</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                      
                                                        <tbody id="filtersales">
                                                            @foreach ($orders as $index => $value)
                                                            @php                                                 
                                                            $products=explode(',',$value->product_id);
                                                            $moq=explode(',',$value->moq);
                                                            $price=explode(',',$value->price);
                                                            $ordersperday = [];
                                                            $count = 0;
                                                            $totalproduct = 0;
                                                            $ordersperday = explode(',', $value->moq);
                                                            foreach ($ordersperday as $i => $info) 
                                                            {
                                                                $count += $info;
                                                                $totalproduct = $i+1;
                                                            }
                                                        @endphp
                                                            <tr>
                                                              
                                                            
                                                           
                                                            <td>
                                                                @foreach ($product_details as $product)
                                                                @foreach ($ordersperday as $i => $info) 
                                                                  
                                                                    @if($product->product_id ==  $products[$i])
                                                                    {{ $product->product_name}}
                                                                   
                                                                    {{ $product->packsize}}<br>
                                                                    @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </td>
                                                                <td>
                                                                @foreach ($ordersperday as $i => $info) 
                                                                    {{ $moq[$i] }}<br>
                                                                @endforeach
                                                                </td>
                                                                
                                                                <td>
                                                                    @foreach ($ordersperday as $i => $info) 
                                                                   0<br>
                                                                @endforeach
                                                                </td>
                                                           
                                                           <td>
                                                            @foreach ($ordersperday as $i => $info) 
                                                                {{ $price[$i] }}<br>
                                                            @endforeach
                                                            </td>
                                                            <td>
                                                            @foreach ($ordersperday as $i => $info) 
                                                                {{ $price[$i]* $moq[$i] }}<br>
                                                            @endforeach                                          </td>

                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
        
                                            </div>
                                            <!-- end card-body-->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane  show " id="menu4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
        
                                                    <h4 class="card-title">Sales</h4>
                                                    <div class="col-md-5 mb-3">
                                                        <input type="date" name="from_date" id="from_date">
                                                        <input type="date" name="end_date" id="end_date">
                                                        <button class="btn btn-primary btn-sm" id="filter">Filter</button>
                                                        {{-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                                          <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                                          <span></span> <b class="caret"></b>
                                                        </div> --}}
                                                      </div>
                                                    <div class="fields d-flex">
                                                        
                                                        <div>
                                                            <div class="input-group">
                                                                <input type="text" id="search"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mx-2">
                                                            <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                        </div>
                                                                                           
                                                    </div>
                                                   
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p>Average Daily Sales: <span  id="avaragesalesyearly">{{$avaragesalesyearly}}</span> ₹</p>
                                                    
                                                    <p>Growth: {{$salesgrowth}}%</p>
                                                </div>
                                                <a class="btn btn-warning ml-3 float-right mb-2"
                                                href="{{ url('superadmin/salesexport') }}">
                                                       Export
                                                </a>
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0" id="datatable">
                                                        <thead>
                                                            <tr>
                                                                <th>DATE</th>
                                                                <th>BILL NO.</th>
                                                                <th>PARTY NAME</th>
                                                                <th>BILL AMT.</th>
                                                                <th>TAXABLE</th>
                                                                <th>TAX</th>
                                                                <th>SUR.</th>
                                                                <th>TAX FREE</th>
                                                                <th>EXEMPTED</th>
                                                                <th>R.OFF</th>
                                                            </tr>
                                                        </thead>
                                                      
                                                        <tbody id="filtersales">
                                                            @foreach ($orders as $index => $value)
                                                            @php                                                 
                                                            $products=explode(',',$value->product_id);
                                                            $moq=explode(',',$value->moq);
                                                            $price=explode(',',$value->price);
                                                            $ordersperday = [];
                                                            $count = 0;
                                                            $totalproduct = 0;
                                                            $ordersperday = explode(',', $value->moq);
                                                            foreach ($ordersperday as $i => $info) 
                                                            {
                                                                $count += $info;
                                                                $totalproduct = $i+1;
                                                            }
                                                        @endphp
                                                            <tr>
                                                              
                                                                <td>{{ date('d-m-Y',strtotime($value->updated_at)) }}</td>
                                                                <td>A{{$value->billno}}</td>
                                                            @foreach ($customers_details as $customers)
                                                                @if($customers->email == $value->email)
                                                                <td>{{$customers->company_name}}</td>
                                                                @endif
                                                            @endforeach
                                                           
                                                            
                                                              
                                                            <td>{{ round($value->total_price + round(($value->total_price)*6/100) *2) }}.00</td>
                                                            <td>{{ round($value->total_price) }}.00</td>
                                                           
                                                            <td>{{ round((($value->total_price)*6/100) *2 ,2)}}</td>
        
                                                              
                                                               
                                                                <td>0.00</td>
                                                                <td>0.00</td>
                                                                <td>0.00</td>
                                                               
                                                                
                                                                <td>{{ round((round($value->total_price + round(($value->total_price)*6/100) *2))-($value->total_price+($value->total_price)*6/100 *2) ,2)}}</td>
                                                           
                                                                
                                                        
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
        
                                            </div>
                                            <!-- end card-body-->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>
                            </div>


                            <div id="menu2" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between mb-3">
        
                                                    <h4 class="card-title">Customers</h4>
                                                   
                                                   
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0" id="datatable">
                                                        <thead>
                                                            <tr>
                                                                <th>Daily Addition</th>
                                                                <th>Total</th>
                                                                <th>Growth (Monthly)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="">
                                                          
                                                            <tr>
                                                                <td>{{$customersdailyaddition}}</td>
                                                                <td>{{ $totalcustomers }}</td>
                                                                <td>{{ $growth }}%</td>
                                                            </tr>
                                                          
                                                        </tbody>
                                                    </table>
                                                </div>
        
                                            </div>
                                            <!-- end card-body-->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>
                            </div>
                            <div id="menu3" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between mb-3">
        
                                                    <h4 class="card-title">Stocks</h4>
                                                   
                                                    <div class="fields d-flex">
                                                        
                                                        <div>
                                                            <div class="input-group">
                                                                <input type="text" id="search2"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-primary" id="search-button2"><i class="mdi mdi-magnify"></i></button>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mx-2">
                                                            <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                        </div>
                                                                                           
                                                    </div>
                                                   
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p>Growth: {{$geowthofstock}}% (Monthly)</p>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0" id="datatable2">
                                                        <thead>
                                                            <tr>
                                                                <th>Warehouse</th>
                                                                <th>Product Id</th>
                                                                <th>Product Name</th>
                                                                <th>Stock Value</th>
                                                                {{-- <th>SKU Number</th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody id="">
                                                            @foreach ($stocks as $index => $value)
                                                            <tr>
                                                                <td>
                                                                    @forEach($warehouse as $ware)
                                                                        @if($ware->email == $value->warehouse)
                                                                        {{$ware->name}}
                                                                        @endif
                                                                    @endforeach  
                                                                </td>
                                                                <td>{{ $value->product_id }}</td>
                                                                <td>{{ $proname[$index] }}</td>
                                                                @php
                                                                $totalstock = 0;
                                                                foreach ($stocks2 as $key2 => $item2)
                                                                {
                                                                 
                                                                    if($value->product_id == $item2->product_id ) {
                                                                        $totalstock += $item2->stocks;
                                                                    }
                                                                }      
                                                              @endphp
                                                                <td>{{ $totalstock }}</td>
                                                                {{-- <td></td> --}}
                                                            </tr>
                                                          @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
        
                                            </div>
                                            <!-- end card-body-->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>
                              </div>
                            
                              <div class="tab-pane  show " id="menu5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
        
                                                    <h4 class="card-title">Consolidated</h4>
                                                    <div class="col-md-5 mb-3">
                                                        <input type="date" name="from_date" id="from_date">
                                                        <input type="date" name="end_date" id="end_date">
                                                        <button class="btn btn-primary btn-sm" id="filter">Filter</button>
                                                        {{-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                                          <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                                          <span></span> <b class="caret"></b>
                                                        </div> --}}
                                                      </div>
                                                    <div class="fields d-flex">
                                                        
                                                        <div>
                                                            <div class="input-group">
                                                                <input type="text" id="search"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mx-2">
                                                            <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                        </div>
                                                                                           
                                                    </div>
                                                   
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p>Average Daily Sales: <span  id="avaragesalesyearly">{{$avaragesalesyearly}}</span> ₹</p>
                                                    
                                                    <p>Growth: {{$salesgrowth}}%</p>
                                                </div>
                                                <a class="btn btn-warning ml-3 float-right mb-2"
                                                href="{{ url('superadmin/salesexport') }}">
                                                       Export
                                                </a>
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0" id="datatable">
                                                        <thead>
                                                            <tr>
                                                                <th>DATE</th>
                                                                <th>BILL NO.</th>
                                                                <th>PARTY NAME</th>
                                                                <th>BILL AMT.</th>
                                                                <th>TAXABLE</th>
                                                                <th>TAX</th>
                                                                <th>SUR.</th>
                                                                <th>TAX FREE</th>
                                                                <th>EXEMPTED</th>
                                                                <th>R.OFF</th>
                                                            </tr>
                                                        </thead>
                                                      
                                                        <tbody id="filtersales">
                                                            @foreach ($orders as $index => $value)
                                                            @php                                                 
                                                            $products=explode(',',$value->product_id);
                                                            $moq=explode(',',$value->moq);
                                                            $price=explode(',',$value->price);
                                                            $ordersperday = [];
                                                            $count = 0;
                                                            $totalproduct = 0;
                                                            $ordersperday = explode(',', $value->moq);
                                                            foreach ($ordersperday as $i => $info) 
                                                            {
                                                                $count += $info;
                                                                $totalproduct = $i+1;
                                                            }
                                                        @endphp
                                                            <tr>
                                                              
                                                                <td>{{ date('d-m-Y',strtotime($value->updated_at)) }}</td>
                                                                <td>A{{$value->billno}}</td>
                                                            @foreach ($customers_details as $customers)
                                                                @if($customers->email == $value->email)
                                                                <td>{{$customers->company_name}}</td>
                                                                @endif
                                                            @endforeach
                                                           
                                                            
                                                              
                                                            <td>{{ round($value->total_price + round(($value->total_price)*6/100) *2) }}.00</td>
                                                            <td>{{ round($value->total_price) }}.00</td>
                                                           
                                                            <td>{{ round((($value->total_price)*6/100) *2 ,2)}}</td>
        
                                                              
                                                               
                                                                <td>0.00</td>
                                                                <td>0.00</td>
                                                                <td>0.00</td>
                                                               
                                                                
                                                                <td>{{ round((round($value->total_price + round(($value->total_price)*6/100) *2))-($value->total_price+($value->total_price)*6/100 *2) ,2)}}</td>
                                                           
                                                                
                                                        
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
        
                                            </div>
                                            <!-- end card-body-->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>
                            </div>




                            <div class="tab-pane  show " id="menu6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
        
                                                    <h4 class="card-title">Products</h4>
                                                    <div class="col-md-5 mb-3">
                                                        <input type="date" name="from_date" id="from_date">
                                                        <input type="date" name="end_date" id="end_date">
                                                        <button class="btn btn-primary btn-sm" id="filter">Filter</button>
                                                        {{-- <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                                          <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                                          <span></span> <b class="caret"></b>
                                                        </div> --}}
                                                      </div>
                                                    <div class="fields d-flex">
                                                        
                                                        <div>
                                                            <div class="input-group">
                                                                <input type="text" id="search"  class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-primary" id="search-button"><i class="mdi mdi-magnify"></i></button>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mx-2">
                                                            <a><button class="btn btn-primary waves-effect waves-light" onclick="resetFilter()">Reset</button></a>
                                                        </div>
                                                                                           
                                                    </div>
                                                   
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p>Average Daily Sales: <span  id="avaragesalesyearly">{{$avaragesalesyearly}}</span> ₹</p>
                                                    
                                                    <p>Growth: {{$salesgrowth}}%</p>
                                                </div>
                                                <a class="btn btn-warning ml-3 float-right mb-2"
                                                href="{{ url('superadmin/salesexport') }}">
                                                       Export
                                                </a>
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0" id="datatable">
                                                        <thead>
                                                            <tr>
                                                                <th>DATE</th>
                                                                <th>BILL</th>
                                                                <th>PARTY NAME</th>
                                                                <th>BATCH</th>
                                                                <th>QTY</th>
                                                                <th>FREE</th>
                                                                <th>RATE</th>
                                                                <th>AMOUNT</th>
                                                            </tr>
                                                        </thead>
                                                      
                                                        <tbody id="filtersales">
                                                            @foreach ($orders as $index => $value)
                                                            @php                                                 
                                                            $products=explode(',',$value->product_id);
                                                            $moq=explode(',',$value->moq);
                                                            $price=explode(',',$value->price);
                                                            $ordersperday = [];
                                                            $count = 0;
                                                            $totalproduct = 0;
                                                            $ordersperday = explode(',', $value->moq);
                                                            foreach ($ordersperday as $i => $info) 
                                                            {
                                                                $count += $info;
                                                                $totalproduct = $i+1;
                                                            }
                                                        @endphp
                                                            <tr>
                                                              
                                                                <td>{{ date('d-m-Y',strtotime($value->updated_at)) }}</td>
                                                                <td>A{{$value->billno}}</td>
                                                            @foreach ($customers_details as $customers)
                                                                @if($customers->email == $value->email)
                                                                <td>{{$customers->company_name}}</td>
                                                                @endif
                                                            @endforeach
                                                           
                                                            
                                                              
                                                            <td>{{ round($value->total_price + round(($value->total_price)*6/100) *2) }}.00</td>
                                                            <td>{{ round($value->total_price) }}.00</td>
                                                           
                                                            <td>{{ round((($value->total_price)*6/100) *2 ,2)}}</td>
        
                                                              
                                                               
                                                                <td>0.00</td>
                                                            
                                                                
                                                                <td>{{ round((round($value->total_price + round(($value->total_price)*6/100) *2))-($value->total_price+($value->total_price)*6/100 *2) ,2)}}</td>
                                                           
                                                                
                                                        
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
        
                                            </div>
                                            <!-- end card-body-->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>
                            </div>

                          </div>
                       
                        <!-- end row-->
                    </div>
                    <!--end row-->
                </div>
             
            </div>
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->
</div>




   

   
<style>
    .daterangepicker .ranges li:hover {
     background-color: rgb(37, 28, 28) ;
}
</style>



    <!-- END layout-wrapper -->
    @include('superadmin.footer')
    <script>
        jQuery(document).ready(function() {
  
              $('#filter').click(function() {
                  var from_date = $('#from_date').val();
                  var end_date = $('#end_date').val();
                
                      jQuery.ajax({
                      url: '{{ url('superadmin/filter-sales') }}',
                      type: 'POST',
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      data: {
                        from_date:from_date,
                        end_date:end_date,
                      },
                      success: function(response) {
                        $('#filtersales').html(response.data);
                      },
                      error: function(xhr, status, error) {
                          var errorMessage = xhr.status + ': ' + xhr.statusText;
                          alert('Error - ' + errorMessage);
                      }
                  });
              
              });
          });
          
      </script>
  
    {{-- <script type="text/javascript">
        $('#reportrange span').html('Select Range');
  
        $('#reportrange').daterangepicker({
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Last 90 Days': [moment().subtract(89, 'days'), moment()],
            'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
          },
          "locale": {
            "format": "DD-MM-YYYY",
            "separator": " - ",
            "applyLabel": "Apply",
            "cancelLabel": "Cancel",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
              "Su",
              "Mo",
              "Tu",
              "We",
              "Th",
              "Fr",
              "Sa"
            ],
            "monthNames": [
              "January",
              "February",
              "March",
              "April",
              "May",
              "June",
              "July",
              "August",
              "September",
              "October",
              "November",
              "December"
            ],
            "firstDay": 1
          },
          "alwaysShowCalendars": true,
          "opens": "center",
          "drops": "auto"
        });
  
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
  
          $('#reportrange span').html(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate.format('MMMM D, YYYY'));
  
          let url = "{{ url('superadmin/filter-sales') }}" + "/" + "from=" + picker.startDate.format('YYYY-MM-DD') + "&to=" + picker.endDate.format('YYYY-MM-DD');
  
          let li;
  
          fetch(url).then(response => response.json()).then(json => {
  
            if (json.length == 0) {
  
              li = `    
                      <tr>
                      <td colspan="100" class="text-center text-danger"><b>No Data Found</b></td>      
                      </tr>
                      `;
  
            } else {
                 //fetch(url).then(response => response.json()).then(json => {
                //     document.getElementById('avaragesalesyearly').innerHTML =json.avaragesalesyearly;
                // });
              json.forEach(sales =>{
               
                let getDate = new Date(sales.updated_at);
                let date =  getDate.getDate()+ "-" + (getDate.getMonth() + 1) + "-" + getDate.getFullYear();
                var rate =  sales.total_price;
               var gst =  Math.round(((sales.total_price)*6/100) *2);
               
                var withgst = rate + gst;
                
                li += `
                      <tr>
                        <td>${date} </td>
                        <td>${sales.outlet_name}</td>
                        <td>${sales.product_id}</td>
                        <td>${sales.moq}</td>
                        <td>${sales.total_price}.00</td>
                        <td>${withgst}.00</td>
                      </tr>
                    `;
  
              })
            }
  
            $('#data').html(li);
  
          });
        });
  
        function resetFilter() {
          window.location.reload();
        }
      </script> --}}
  <script>
    $("#search-button").click(function(){
               $.each($("#datatable tbody tr"), function() {

                   if($(this).text().toLowerCase().indexOf($('#search').val().toLowerCase()) === -1)
                       $(this).hide();
                   else
                       $(this).show();                
               });
           }); 
    $("#search-button2").click(function(){
            $.each($("#datatable2 tbody tr"), function() {

            if($(this).text().toLowerCase().indexOf($('#search2').val().toLowerCase()) === -1)
                $(this).hide();
            else
                $(this).show();                
        });
    }); 
 </script>
</body>
</html>
