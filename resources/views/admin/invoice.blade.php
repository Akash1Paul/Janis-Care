@php 
    $url = $_SERVER['REQUEST_URI'];
    //print_r($url);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            max-width: 100%;
            /* padding: 0px 50px; */
            font-family: system-ui;
            height: auto;
        }

.left{
    /* float: left;
    width: 46%;
    margin-bottom: 30px; */
    }

.left-new{
    /* float: left;
    width: 75%;
    margin-bottom: 30px; */
}

.right{
    /* float: right;
    width: 100%; */
}

.total span {
    /* float:left; */
    /* clear:both; */
}

.con{
    float: right;
}

h1{
    font-size: 25px;
    color: #006d00;
}

h2{
    font-size: 20px;

    text-align: right;
}

p{
    font-weight: 500;
    color: #838383;
}

.head-bg{
    background: #006d00;
    padding: 10px;
    color: #fff;
    font-weight: 500;
    margin-top: 45px;
}

.foot-bg{
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


.right-new{
    float: right;
    width: 25%;
}

table{
    width: 100%;
    border-collapse: collapse;
    text-align: center;
    font-size: 10px;
}

table th{
    background: #c3c2c2;
    padding: 10px;
    color: #000000;
    font-weight: 500;
    font-weight: bold;
    border:1px solid #000
}

td{
    padding: 10px;
    color: #000;
    font-weight: 400;
}

        

 table, td, th {
    border-left:1px solid #000000;
    border-right:1px solid #000000;
}

.tab{
    text-align: left  !important;
    border-top: 1px solid #000000;
}

.tab-rs {
    
    text-align: left  !important;
    border-top: 1px solid #000000;
}


.table{
    /* margin-top: 30px; */
  
   
}
 .table-new{
    margin-top: 0px !important;
    text-align: left !important;
    border-bottom: 1px solid  #000000;
}

.tab h3{
    margin: 0px;
}

.tab p, .tab span{
    font-size: 9px;
}

.border-none td, th{
    border: none;
}

.border-none td{
    font-weight: 600;
}

.copy-wright{
    clear: both;
    margin-top: 30px;
    text-align: center;
    margin-bottom: 40px;
}

.copy-wright p{
    font-size: 14px;
    color: #000;
    font-weight: 500;
    margin-bottom:10px;
}

.copy-wright h5{
    margin: 0px;
}

.text-left {
    text-align: right ;
    margin: 0px;
}

.total-tab{
    text-align: left !important;
}
.footer-tab{
    border-bottom: 1px solid  #000000;
}
    </style>
</head>
 
<body>
   
   
    @if($url == '/admin/invoice/'.$id)
  
    <div class="row mt-4 mb-4" style="display: flex; justify-content: end" id="showdwonload">
        <div class="col offset-lg-10">
            <a href="{{ url('admin/generate_pdf/'.$id) }}"><button class="btn btn-primary button">Download PDF</button></a>
        </div>
    </div>


    @endif
   <div class="main">
        
        <h3 style="text-align: center;margin-bottom:0;font-family: Georgia, serif;font-size:15px;color:#1E1C90 ">GST INVOICE</h3>
    <div class="right">
            <!-- <h2>INVOICE</h2> -->
            <br />
        <table class="tab">
            <tr>
                <td style="color:#1E1C90">
                    <h3>JANIS CARE PVT.LTD</h3>
                    <p style="color:#1E1C90">108,FIRST FLOOR, <br>TC JAINA TOWER-1 <br>
                    JANAKPURI DISTRICT <br> CENTER DELHI-110058</p>

                     <p style="color:#1E1C90">Phone : 011-44786295,44786301
                        <br />
                        E-Mail : infodelhi@janiscare.com
                        <br />
                        D.L.No. : WLF21B2022DL001095,<br>WLF20B2022DL001102
                        <br />
                        GSTIN : 07AAFCJ2052F1ZW
                        </p>
                </td>

                <td>
                   
                <div class="total">
                    <span>Invoice No</span><br>
                    <p class="text-left">JC/{{ date('y').'-'.date('y')+1 }}/A{{$order_details->billno}}</p>
                    </div>
                <div class="total">
                    <span>Invoice Date</span><br>
                    <p class="text-left">{{ date('d-m-Y') }}</p>
                    </div>
                <div class="total">
                    <span>Due Date </span><br>
                    <p class="text-left">{{ date('d-m-Y') }}</p>
                    </div>
                <div class="total">
                <span>M.R NAME : <br>MOHIT JI</span>
                {{-- <p class="text-left">Cases 0</p> --}}
                </div>
                </td>

                <td>
                    <strong>BILL TO :</strong><br>
                    <strong>{{ $order_details->spoc_name }}</strong>
                    <br />
                    <span>{{ $order_details->billing_address }}
                       
                        <br />
                    <span>PHONE. : {{ $order_details->spoc_number }}</span>
                    <br />
                        GSTIN : {{ $order_details->gst}}
                    <br />
                    {{-- <strong>AREA NAME : {{ $order_details->state }}</strong> --}}
                </td>
                <td>
                    <strong>SHIP TO :</strong><br>
                    <strong>{{ $order_details->spoc_name }}</strong>
                    <br />
                    <span>{{ $order_details->delivery_address }} <br>
                    <span>PHONE. : {{ $order_details->spoc_number }}</span>
                    <br />
                        GSTIN : {{ $order_details->gst}}
                    <br />
                    {{-- <strong>AREA NAME : {{ $order_details->state }}</strong> --}}
                </td>
                    </tr>
        </table>
               

        </table>

        
        
    </div>
   </div>

   <table class="table">
    <tr>
        <th>S.</th>
        <th>Qty.</th>
        <th>Mfr</th>
        <th>Pack</th>
        <th>Product Name</th>
        <th>Batch</th>
        <th>Exp</th>
        <th>HSN</th>
        <th>M.R.P</th>
        <th>Rate</th>
        <th>DIS</th>
        <th>SGST</th>
        <th>CGST</th>
        <th>Amount</th>
        <th>Net</th>
    </tr>
@php                                                 
    $products=explode(',',$order_details->product_id);
    $moq=explode(',',$order_details->moq);
    $price=explode(',',$order_details->price);
    $mrp=explode(',',$order_details->MRP);
    $ordersperday = [];
    $count = 0;
    $totalproduct = 0;
    $ordersperday = explode(',', $order_details->moq);
    foreach ($ordersperday as $index => $info) 
    {
        $count += $info;
        $totalproduct = $index+1;
    }
@endphp
@foreach ($products as $index=> $item)
    <tr style="text-align: right">
        <td>{{$index+1}}</td>
        <td>{{ $moq[$index] }}</td>
        <td>
            @foreach ($productscheck as $manu)
                @if ($manu->product_id == $item)
                    {{ $manu->manufacturer }}
                @endif
            @endforeach
        </td>
        <td> 
            @foreach ($productscheck as $pack)
                @if ($pack->product_id == $item)
                    {{ $pack->packsize }}
                @endif
            @endforeach
        </td>
        <td>
            @foreach ($productscheck as $name)
                @if ($name->product_id == $item)
                    {{ $name->product_name }}
                @endif
            @endforeach
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{ sprintf('%.2f', $mrp[$index]) }}</td>
        <td>{{ sprintf('%.2f', $price[$index]) }}</td>
        <td>0.00</td>
        <td>6.00</td>
        <td>6.00</td>
        <td>{{ sprintf('%.2f',  $price[$index]*$moq[$index]) }}</td>
        <td>{{ sprintf('%.2f', $price[$index]*$moq[$index]+sprintf('%.2f', ($price[$index]*$moq[$index])*6/100) *2 )}}</td>
    </tr>
    
  
   
    
@endforeach
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
    <tr>
       
    </tr>
    <tr>
       
    </tr>
    <tr>
        
    </tr>
</table>

<table class="table table-new ">
    <tr>
        <th>CLASS</th>
        
        <th>TOTAL</th>
        
        <th>SCHEME</th>
        
        <th>DISCOUNT</th>
        
        <th>SGST</th>
        
        <th>CGST</th>
        
        <th>TOTAL GST</th>
        
        <th></th>
     
        <th style="background: white;"><span>TOTAL</span>  <span style="float: right">
            @php
            $TotalAmount = 0;
            foreach ($products as $index=> $item){
                $TotalAmount += ($price[$index]*$moq[$index]) ;
            }
            @endphp
            
          {{ sprintf('%.2f',  $TotalAmount)}}
        </span></th>
        
    </tr>
     
    <tr>
        <td style="background: #c3c2c2;">
            <span>GST 5.00%</span>
            <br />
            <span>GST 12.00%</span>
            <br />
            <span>GST 18.00%</span>
            <br />
            <span>GST 28.00%</span>
            
        </td>
        <td style="text-align:right">
            <span>0.00</span>
            <br />
            <span> @php
                $TotalAmount = 0;
                foreach ($products as $index=> $item){
                    $TotalAmount += ($price[$index]*$moq[$index]) ;
                }
                @endphp
                {{  sprintf('%.2f', $TotalAmount)}}</span>
            <br />
            <span>0.00</span>
            <br />
            <span>0.00</span>
           
        </td>

        <td style="text-align:right">
            <span>0.00</span>
            <br />
            <span>0.00</span>
            <br />
            <span>0.00</span>
            <br />
            <span>0.00</span>
        </td>

        <td style="text-align:right">
            <span>0.00</span>
            <br />
            <span>0.00</span>
            <br />
            <span>0.00</span>
            <br />
            <span>0.00</span>
        </td>

        <td style="text-align:right">
            <span>0.00</span>
            <br />
            <span>{{sprintf('%.2f', ($TotalAmount)*6/100) }}</span>
            <br />
            <span>0.00</span>
            <br />
            <span>0.00</span>
        </td>

        <td style="text-align:right">
            <span>0.00</span>
            <br />
            <span>{{sprintf('%.2f', ($TotalAmount)*6/100) }}</span>
            <br />
            <span>0.00</span>
            <br />
            <span>0.00</span>
        </td>

        <td style="text-align:right">
            <span>0.00</span>
            <br />
            <span>{{ sprintf('%.2f', (($TotalAmount)*6/100) *2)}}</span>
            <br />
            <span>0.00</span>
            <br />
            <span>0.00</span>
        </td>

        
        <td>
            Total Items :- {{$totalproduct}}
             <br />
            Total Qty :- {{ $count}}
            <br />
            <br />
            {{-- <strong>LEDGER BALANCE : 4760.00</strong> --}}
        </td>
        <td>
            <div class="total">
            <span>DIS AMT</span>
            <p class="text-left">0.00</p>
            </div>
            <div class="total">
            <span>SGST PAYBLE</span>
            <p class="text-left">{{ sprintf('%.2f', ($TotalAmount)*6/100) }}</p>
            </div>
            <div class="total">
            <span>CGST PAYBLE</span>
            <p class="text-left">{{ sprintf('%.2f', ($TotalAmount)*6/100) }}</p>
            </div>
            <div class="total">
            <span>CR/DR NOTE</span>
            <p class="text-left">0.00</p>
            </div>
        </td>
    </tr>
    
</table>

<table class="total-tab" >
    <tr>
        <td style="width:12.6%;border-right:none;">
            <Strong>Total</Strong>
        </td>

        <td  style="width:10%;border-left:none;border-right:none;"> @php
            $TotalAmount = 0;
            foreach ($products as $index=> $item){
                $TotalAmount += ($price[$index]*$moq[$index]) ;
            }
            @endphp
            {{sprintf('%.2f', $TotalAmount)}}</td>
        <td  style="width:10.1%;border-left:none;border-right:none;">00.00</td>
        <td  style="width:11.8%;border-left:none;border-right:none;">00.00</td>
        <td style="width:9.2%;border-left:none;border-right:none;">{{ sprintf('%.2f', ($TotalAmount)*6/100) }}</td>
        <td style="width:9.1%;border-left:none;border-right:none;">{{ sprintf('%.2f', ($TotalAmount)*6/100) }}</td>
        <td style="border-left:none;border-right:none;">{{sprintf('%.2f', (($TotalAmount)*6/100) *2)}}</td>
        <td style="border-left:none;border-right:none;"></td>
        <td style="border-left:none;border-right:none;"></td>
        <td style="border-left:none;"></td>
       
    </tr>
</table>

@php
$number = sprintf('%.2f',round($TotalAmount+(($TotalAmount)*6/100) *2))  ;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
//   echo $result . "Rupees  " . $points . " Paise";
@endphp
<table class="tab-rs">
    <tr>
        <td>
            <span style="font-weight:bold">Rs. {{$result}} Only</span>
        </td>
    </tr>
</table>

<table class="tab footer-tab">
    <tr>
        <td style="width:40%;">
            <div >
                <h3 style="font-style: italic; text-decoration: underline;">Terms & Conditions</h3>
                <p>E&OE</p>
                <p>Goods once sold will not be taken back or exchanged.<br> {{sprintf('%.2f',round($TotalAmount+(($TotalAmount)*6/100) *2)) }}
                    Bills not paid due date will attract 24% per annum interest.<br>
                    All disputes subject to Jurisdication only.</p>
                    <h3>CHEQUE BOUNCING CHARGES : 500/-</h3>
            </div>
                <img src="https://qrcg-free-editor.qr-code-generator.com/main/assets/images/websiteQRCode_noFrame.png" alt="" style="width: 70px; ">
        </td>

        <td>
            <h3 style="font-style: italic; text-decoration: underline;">Company Bank Details</h3>
            <h3>A/C HOLDER NAME : Janis care pvt.ltd</h3>
            <p>Bank Name : IDFC FIRST BANK</p>
            <p>A/C NO : 10083691609</p>
            <p>IFS CODE : IDFB0040102</p>
              
        </td>

        <td>
            <h3>FOR JANIS CARE PVT.LTD</h3>
            <p></p>
            <p></p>
            <p></p>
            <h3 style="padding-top:50px;">Authorised Signatory</h3>
        </td>
        <td style="background: #c3c2c2;">
           <h2 style="text-align:center">Grand Total <br>{{  sprintf('%.2f',round($TotalAmount+(($TotalAmount)*6/100) *2))  }}</h2>
        </td>
            </tr>
</table>

    

</body>
</html>