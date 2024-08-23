<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- endinject -->
    <link rel="shortcut icon" href="{{url('images/favicon.png')}}" />
    <style>
        .full {
            clear: both;
        }

        body {
            max-width: 100%;
            /* padding: 0px 50px; */
            font-family: system-ui;
            height: auto;
        }

        .left {
            float: left;
            width: 46%;
            margin-bottom: 0px;
        }

        .left-new {
            float: left;
            width: 60%;
            margin-bottom: 30px;
        }

        .right {
            float: right;
            width: 49%;
        }

        .con {
            float: right;
        }

        h1 {
            font-size: 20px;
            color: #070b5a;
        }

        h2 {
            font-size: 20px;
            color: #020540;
            text-align: right;
        }

        p {
            font-size: 10px;
            font-weight: 500;
            color: black;
        }
        .head-bg {
            background: #006d00;
            padding: 5px;
            color: #fff;
            font-weight: 500;
            margin-top: 10px;
        }

        .foot-bg {
            background: #8fbc8f;
            padding: 10px;
            color: #006d00;
            font-weight: 700;
            text-align: center;
            font-style: italic;
        }

        .right-footer {
            background: #82cd82;
            padding: 10px;
            color: #006d00;
            font-weight: 700;
            text-align: center;
            font-style: italic;
        }

        .right-new {
            float: right;
            width: 40%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #006d00;
            padding: 5px;
            color: #fff;
            font-weight: 500;
        }

        td {
            font-size: 12px;
            padding: 5px;
            color: #000;
            font-weight: 400;
            border: 1px solid #000;
        }

        .tab td {
            text-align: center;
        }

        table,
        td,
        th {
            border: 1px solid #838383;
        }

        .table {
            margin-top: 30px;
        }

        .table {
            margin-top: 10px;
        }

        .border-none td,
        th {
            border: none;
        }

        .border-none td {
            font-weight: 600;
        }

        .copy-wright {
            clear: both;
            margin-top: 30px;
            text-align: center;
            margin-bottom: 40px;
        }

        .copy-wright p {
            font-size: 14px;
            color: #000;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .copy-wright h5 {
            margin: 0px;
        }

        .button {
            background: #298FCE;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            color: rgb(255, 255, 255);
            outline: none !important;
            margin-left: 40px;
        }
    </style>
</head>

<body>

    @if(Request::url() == url('backoffice/invoice/'.$id))

    <div class="row mt-4 mb-4" style="display: flex; justify-content: end" id="showdwonload">
        <div class="col offset-lg-10">
            <a href="{{ url('backoffice/generate_pdf/'.$id) }}"><button class="btn btn-primary button">Download PDF</button></a>
        </div>
    </div>


    @endif
  
 
  
{{-- 
    @php

    $quality_choices = [];
    $product_type = [];
    foreach($fruits as $fruit)
    {
    $quality_choices[] = json_decode($fruit['quality_choice'], true);
    $product_type[] =  $fruit['product_type'];
    }

    @endphp --}}
    <div class="container">
        <div class="main">
            <div class="left">
                <div class="content">
                    <h1>JANIS CARE PVT.LTD</h1>
                    <p>108,FIRST FLOOR,TC JAINA TOWER-1 <br>
                        JANAKPURI DISTRICT CENTER DELHI-110058 <br>
                        Phone : 011-44786295,44786301 <br>
                        E-Mail : infodelhi@janiscare.com <br>
                        GSTIN : 07AAFCJ2052F1ZW</p>
                   
             
                    <div class="head">
                        <div class="head-bg">BILL TO</div>
                        <p>Marmalade Grove</p>
                        <p>7215 Santa Monica Blvd.</p>
                        <p>West Hollywood, CA 90046</p>
                    </div>
                     
                </div>
            </div>

            <div class="right">
                <h2>INVOICE</h2>
                <br>
                <table class="tab">
                    <tr>
                        <th>INVOICE NO</th>
                        <th>DATE</th>
                    </tr>

                    <tr>
                        <td>JC{{ date('Y-') }}{{ $randomNumber }}</td>
                        <td>{{ date('d/m/Y') }}</td>
                    </tr>

                </table>

                {{-- <table class="table tab">
                    <tr>
                        <th>CUSTOMER PO#</th>
                        <th>TERMS</th>
                    </tr>

                    <tr>
                        <td>Peter</td>
                        <td>Due Upon Receipt</td>
                    </tr>

                </table> --}}

            </div>
        {{-- <div class="full">
            <table class="table">
                <tr>
                    <th>RECEIVED FRUITS</th>
                    <th>UNITS</th>
                    <th>TYPE</th>
                    <th>WEIGHT</th>
                </tr>

                @foreach ($picker as $index => $item)
                    <tr>
                      <td>{{ $item['product_type'] }}</td>
                      <td>{{ $item['units'] }}</td>
                      <td>{{ $item['types'] }}</td>
                      <td>{{ $item['weight'] }}</td>
                    </tr>
                @endforeach
               
            </table>
        </div> --}}
            
        </div>
        <div class="full">
            <table class="table">
                <tr>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>SPOC Name</th>
                    <th>SPOC Number</th>
                    <th>TM Name</th>
                </tr>

              
                
                <tr>
                    <td>{{ $order_details->outlet_name }}</td>
                    <td> {{ $order_details->address }}</td>
                    <td>{{ $order_details->city }}</td>
                    <td>{{ $order_details->spoc_name }}</td>
                    <td>{{ $order_details->spoc_number }}</td>
                    <td>{{$territory->name}}</td>
                </tr>
                   
                   
                
            </table>
            <div class="full">
                <table class="table" >
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>MOQ</th>
                        <th>Price</th>
                
                       
                    </tr>
                    @php
                                                    
                                                    $products=explode(',',$order_details->product_id);
                                                    $moq=explode(',',$order_details->moq);
                                                    $price=explode(',',$order_details->price);

                                                @endphp

                                                @foreach ($products as $index=> $item)
                                                <tr>
                                                    <td>{{ $index+1 }}</td>
                                                    <td>{{ $product_details->product_name }}</td>
                                                    <td>{{ $product_details->categories }}</td>
                                                 
                                     
                                                    <td>{{ $moq[$index] }}</td>
                                                    <td>{{ $price[$index] }}</td>
                                                    {{-- <td>{{ $moq[$index]*$price[$index] }}</td> --}}
                                                   
                                                </tr>
                                                 
                                              
                                                
                                               
                </table>
            </div>
            <div class="left-new">
                <div class="foot-bg">Thank You For Your Business!</div>
            </div>
            <div class="right-new">
                <div class="right-footer">
                    <table class="border-none">
                        <tr>
                            <td>SUBTOTAL -</td>
                            <td>{{ $moq[$index]*$price[$index] }}</td>
                        </tr>

                        <tr>
                            <td>TAX RATE-</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>TAX -</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>TOTAL</td>
                            <td>{{ $order_details->total_price }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        {{-- @endif --}}
        <div class="copy-wright">
            <p>If you have any questions about this invoice, please contact</p>
            <h5>info@janiscare.com
            </h5>
        </div>
    </div>
</body>

</html>