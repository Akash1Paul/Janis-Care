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
                                <h4 class="mb-0 font-size-13">Dashboard</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-right">Per Month</span>
                                        <h5 class="card-title mb-0">Total Orders</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                {{ count($orders) }}
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            @if(($thismonthorder-$lastmonthsorder)/100<0)
                                            <span class="text-muted">{{($thismonthorder-$lastmonthsorder)/100}}%<i
                                                    class="mdi mdi-arrow-down text-danger"></i></span>
                                            @else
                                            <span class="text-muted">{{($thismonthorder-$lastmonthsorder)/100}}%<i
                                                class="mdi mdi-arrow-up text-success"></i></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="progress shadow-sm" style="height: 5px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:  {{ count($orders) }}%;">
                                        </div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-right">Per Month</span>
                                        <h5 class="card-title mb-0">Total Customers</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                {{ count($users) }}
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            @if($totalcustomer<0)
                                            <span class="text-muted">{{$totalcustomer}}% <i
                                                    class="mdi mdi-arrow-down text-danger"></i></span>
                                            @else
                                            <span class="text-muted">{{$totalcustomer}}% <i
                                                class="mdi mdi-arrow-up text-success"></i></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="progress shadow-sm" style="height: 5px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width:  {{ count($users) }}%;">
                                        </div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-right">Per Month</span>
                                        <h5 class="card-title mb-0">Total Delivered</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                 {{ count($Delivered) }}
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            @if($totaldelivered<0)
                                            <span class="text-muted">{{$totaldelivered}}% <i
                                                    class="mdi mdi-arrow-down text-danger"></i></span>
                                            @else
                                            <span class="text-muted">{{$totaldelivered}}% <i
                                                class="mdi mdi-arrow-up text-success"></i></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="progress shadow-sm" style="height: 5px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:  {{ count($Delivered) }}%;">
                                        </div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div>
                            <!--end card-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-right">Per Month</span>
                                        <h5 class="card-title mb-0">Total Products</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                {{ count($products) }}
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            @if($totalproduct<0)
                                            <span class="text-muted">{{$totalproduct}}% <i
                                                    class="mdi mdi-arrow-down text-danger"></i></span>
                                            @else
                                            <span class="text-muted">{{$totalproduct}}% <i
                                                class="mdi mdi-arrow-up text-success"></i></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="progress shadow-sm" style="height: 5px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ count($products) }}%;"></div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->
                    </div>
                    {{-- <div class="row"> --}}
                        {{-- <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-right">Overall</span>
                                        <h5 class="card-title mb-0">Products</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                {{ count($products) }}
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">

                                        </div>
                                    </div>

                                    <div class="progress shadow-sm" style="height: 5px;">
                                            
                                        </div>
                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col--> --}}

                        {{-- <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">

                                        <span class="badge badge-soft-primary float-right">Overall</span>
                                        <h5 class="card-title mb-0">Users</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">

                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                {{ count($users) }}
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">

                                        </div>
                                    </div>


                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col--> --}}

                        {{-- <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <span class="badge badge-soft-primary float-right">Per Month</span>
                                            <h5 class="card-title mb-0">Expenses</h5>
                                        </div>
                                        <div class="row d-flex align-items-center mb-4">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    $784.62
                                                </h2>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span class="text-muted">57% <i
                                                        class="mdi mdi-arrow-up text-success"></i></span>
                                            </div>
                                        </div>

                                        <div class="progress shadow-sm" style="height: 5px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 57%;">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card body-->
                                </div>
                                <!--end card-->
                            </div> <!-- end col--> --}}

                        {{-- <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-right">Overall</span>
                                        <h5 class="card-title mb-0">Categories</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">

                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                {{ count($categories) }}
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">

                                        </div>
                                    </div>


                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col--> --}}
                    {{-- </div> --}}
                    <!-- end row-->





                    <div class="row">
                        <div class="col-lg-9">

                            <div class="card">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="card-title">Orders Analytics</h4>
                                                {{-- <p class="card-subtitle mb-4">From date of 1st Jan 2020 to continue</p> --}}
                                                {{-- <div id="morris-bar-example" class="morris-chart"></div> --}}
                                                <div class="chartjs-bar-wrapper mt-3">
                                                    <canvas id="marketingOverview" style="display: block; height: 172px; width: 500px;"></canvas>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4">

                                                <h4 class="card-title">Correction</h4>
                                          
                                            <div class="text-center">
                                                <input data-plugin="knob" data-width="165" data-height="165"
                                                    data-linecap=round data-fgColor="#7a08c2" value="{{$approvedcustomers}}"
                                                    data-skin="tron" data-angleOffset="360" data-readOnly=true
                                                    data-thickness=".15" />
                                                {{-- <h5 class="text-muted mt-3">Total sales made today</h5>
                
                
                                                <p class="text-muted w-75 mx-auto sp-line-2">Traditional heading
                                                    elements are
                                                    designed to work best in the meat of your page content.</p>
                
                                                <div class="row mt-3">
                                                    <div class="col-6">
                                                        <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                                        <h4><i class="fas fa-arrow-up text-success mr-1"></i>7.8k</h4>
                
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                                        <h4><i class="fas fa-arrow-down text-danger mr-1"></i>1.4k</h4>
                                                    </div>
                
                                                </div> --}}
                                            </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <!--end card body-->
                                </div> <!-- end card-->
                        </div> <!-- end col -->
                        {{-- <div class="col-lg-4">
                            <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Correction</h4>
                            <!-- <p class="card-subtitle mb-4">Recent Stock</p> -->

                            <div class="text-center">
                                <input data-plugin="knob" data-width="165" data-height="165"
                                    data-linecap=round data-fgColor="#7a08c2" value="{{count($approvedcustomers)}}"
                                    data-skin="tron" data-angleOffset="180" data-readOnly=true
                                    data-thickness=".15" /> --}}
                                {{-- <h5 class="text-muted mt-3">Total sales made today</h5>


                                <p class="text-muted w-75 mx-auto sp-line-2">Traditional heading
                                    elements are
                                    designed to work best in the meat of your page content.</p>

                                <div class="row mt-3">
                                    <div class="col-6">
                                        <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                        <h4><i class="fas fa-arrow-up text-success mr-1"></i>7.8k</h4>

                                    </div>
                                    <div class="col-6">
                                        <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                        <h4><i class="fas fa-arrow-down text-danger mr-1"></i>1.4k</h4>
                                    </div>

                                </div> --}}
                            {{-- </div>
                                </div>
                            </div>
                        </div> --}}
                       
                        <div class="col-lg-3">

                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h4 class="card-title">Total Transactions  <span class="badge badge-soft-primary float-right">Per Month</span></h4>
                                            {{-- <p class="card-subtitle mb-4">Transaction period from 21 July to
                                                25 Aug</p> --}}
                                            <h3>{{$totalTransaction}}
                                                @if($totaltranpercentage<0)
                                                <span class="badge badge-soft-danger float-right">{{$totaltranpercentage}}%</span>
                                                @else
                                                <span class="badge badge-soft-success float-right">{{$totaltranpercentage}}%</span>
                                                @endif
                                            </h3>
                                        </div>
                                    </div> <!-- end row -->

                                    <div id="sparkline1" class="mt-3"></div>
                                </div>
                                <!--end card body-->
                            </div>
                            <!--end card-->

                        </div><!-- end col -->

                    </div>
                    <!--end row-->


                   
                    <!--end row-->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    @include('superadmin.footer')
    <script>
        
$(function() {
  'use strict';
  if ($("#morris-bar-example").length) {
    Morris.Bar({
      element: 'morris-bar-example',
      barColors: ['#ebeef1', '#00c2b2'],
    
      data: [
         {
           y: 'Jan',
           a:  "{{ $ordersLastweeks['Jan'] }}",
           b: "{{ $ordersthisweeks['Jan'] }}"
         },
         {
           y: 'Feb',
           a:  "{{ $ordersLastweeks['Feb'] }}",
           b: "{{ $ordersthisweeks['Feb'] }}"
         },
         {
           y: 'Mar',
           a:  "{{ $ordersLastweeks['Mar'] }}",
           b: "{{ $ordersthisweeks['Mar'] }}"
         },
         {
             y: 'Apr',
             a:  "{{ $ordersLastweeks['Apr'] }}",
             b: "{{ $ordersthisweeks['Apr'] }}"
         },
         {
             y: 'May',
             a:  "{{ $ordersLastweeks['May'] }}",
             b: "{{ $ordersthisweeks['May'] }}"
         },
         {
             y: 'Jun',
             a:  "{{ $ordersLastweeks['Jun'] }}",
             b: "{{ $ordersthisweeks['Jun'] }}"
         },
         {
             y: 'Jul',
             a:  "{{ $ordersLastweeks['Jul'] }}",
             b: "{{ $ordersthisweeks['Jul'] }}"
         },
         {
             y: 'Aug',
             a:  "{{ $ordersLastweeks['Aug'] }}",
             b: "{{ $ordersthisweeks['Aug'] }}"
         },
        {
            y: 'Sep',
            a: "{{ $ordersLastweeks['Sep'] }}",
            b: "{{ $ordersthisweeks['Sep'] }}"
        },
        {
            y: 'Oct',
            a: "{{ $ordersLastweeks['Oct'] }}",
            b: "{{ $ordersthisweeks['Oct'] }}"
        },
        {
            y: 'Nov',
            a: "{{ $ordersLastweeks['Nov'] }}",
            b: "{{ $ordersthisweeks['Nov'] }}"
        },
        {
            y: 'Dec',
            a: "{{ $ordersLastweeks['Dec'] }}",
            b: "{{ $ordersthisweeks['Dec'] }}"
        }
    ],
      xkey: 'y',
      ykeys: ['a', 'b'],
      hideHover: 'auto',
      gridLineColor: '#eef0f2',
      resize: true,
      barSizeRatio: 0.4,
      labels: ['Last Week', 'This Week'] 
    });
  }



  $( document ).ready(function() {
  
    var DrawSparkline = function() {
        $('#sparkline1').sparkline([{{ $thismobthtran['Jan']}}, {{ $thismobthtran['Feb']}}, {{ $thismobthtran['Mar']}}, {{ $thismobthtran['Apr']}}, {{ $thismobthtran['May']}}, {{ $thismobthtran['Jun']}}, {{ $thismobthtran['Jul']}}, {{ $thismobthtran['Aug']}}, {{$thismobthtran['Sep']}},{{$thismobthtran['Oct']}},{{$thismobthtran['Nov']}},{{ $thismobthtran['Dec']}}]
        , {
            type: 'line',
            width: "100%",
            height: '297',
            chartRangeMax: 35,
            lineColor: '#1991eb',
            fillColor: 'rgba(25,118,210,0.18)',
            highlightLineColor: 'rgba(0,0,0,.1)',
            highlightSpotColor: 'rgba(0,0,0,.2)',
            maxSpotColor:false,
            minSpotColor: false,
            spotColor:false,
            lineWidth: 1
        });
      }

        DrawSparkline();
  
  var resizeChart;

  $(window).resize(function(e) {
      clearTimeout(resizeChart);
      resizeChart = setTimeout(function() {
          DrawSparkline();
      }, 300);

    });
  });

  if ($('#morris-line-example').length) {
    Morris.Line({
      element: 'morris-line-example',
      gridLineColor: '#eef0f2',
      lineColors: ['#f15050', '#e9ecef'],
      data: [{
          y: '2013',
          a: 80,
          b: 100
        },
        {
          y: '2014',
          a: 110,
          b: 130
        },
        {
          y: '2015',
          a: 90,
          b: 110
        },
        {
          y: '2016',
          a: 120,
          b: 140
        },
        {
          y: '2017',
          a: 110,
          b: 125
        },
        {
          y: '2018',
          a: 170,
          b: 190
        },
        {
          y: '2019',
          a: 120,
          b: 140
        }
      ],
      xkey: 'y',
      ykeys: ['a', 'b'],
      hideHover: 'auto',
      resize: true,
      labels: ['Series A', 'Series B']
    });
  }
});
if ($("#marketingOverview").length) {
        var marketingOverviewChart = document.getElementById("marketingOverview").getContext('2d');
        var marketingOverviewData = {
          labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
          datasets: [{
            label: 'Last Month',
            // data: ["{{ $ordersLastweeks['Jan'] }}", "{{ $ordersLastweeks['Feb'] }}", "{{ $ordersLastweeks['Mar'] }}", "{{ $ordersLastweeks['Apr'] }}", "{{ $ordersLastweeks['May'] }}", "{{ $ordersLastweeks['Jun'] }}", "{{ $ordersLastweeks['Jul'] }}", "{{ $ordersLastweeks['Aug'] }}", "{{ $ordersLastweeks['Sep'] }}", "{{ $ordersLastweeks['Oct'] }}", "{{ $ordersLastweeks['Nov'] }}", "{{ $ordersLastweeks['Dec'] }}"],
            backgroundColor: "#52CDFF",
            borderColor: [
              '#52CDFF',
            ],
            borderWidth: 0,
            fill: true, // 3: no fill

          }, {
            label: 'This Month',
            data: ["{{ $ordersthisweeks['Jan'] }}", "{{ $ordersthisweeks['Feb'] }}", "{{ $ordersthisweeks['Mar'] }}", "{{ $ordersthisweeks['Apr'] }}", "{{ $ordersthisweeks['May'] }}", "{{ $ordersthisweeks['Jun'] }}", "{{ $ordersthisweeks['Jul'] }}", "{{ $ordersthisweeks['Aug'] }}", "{{ $ordersthisweeks['Sep'] }}", "{{ $ordersthisweeks['Oct'] }}", "{{ $ordersthisweeks['Nov'] }}", "{{ $ordersthisweeks['Dec'] }}"],
            backgroundColor: "#1F3BB3",
            borderColor: [
              '#1F3BB3',
            ],
            borderWidth: 0,
            fill: true, // 3: no fill
          }]
        };

        var marketingOverviewOptions = {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              gridLines: {
                display: true,
                drawBorder: false,
                color: "#F0F0F0",
                zeroLineColor: '#F0F0F0',
              },
              ticks: {
                beginAtZero: true,
                autoSkip: true,
                maxTicksLimit: 5,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
            xAxes: [{
              stacked: true,
              barPercentage: 0.35,
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                beginAtZero: false,
                autoSkip: true,
                maxTicksLimit: 12,
                fontSize: 10,
                color: "#6B778C"
              }
            }],
          },
          legend: false,
          legendCallback: function(chart) {
            var text = [];
            text.push('<div class="chartjs-legend"><ul>');
            for (var i = 0; i < chart.data.datasets.length; i++) {
              console.log(chart.data.datasets[i]); // see what's inside the obj.
              text.push('<li class="text-muted text-small">');
              text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
              text.push(chart.data.datasets[i].label);
              text.push('</li>');
            }
            text.push('</ul></div>');
            return text.join("");
          },

          elements: {
            line: {
              tension: 0.4,
            }
          },
          tooltips: {
            backgroundColor: 'rgba(31, 59, 179, 1)',
          }
        }
        var marketingOverview = new Chart(marketingOverviewChart, {
          type: 'bar',
          data: marketingOverviewData,
          options: marketingOverviewOptions
        });
        // document.getElementById('marketing-overview-legend').innerHTML = marketingOverview.generateLegend();
      }
    </script>
    <script>
        
    </script>
</body>

</html>
