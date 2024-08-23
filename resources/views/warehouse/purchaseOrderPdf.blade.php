<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            max-width: 100%;
            font-family: system-ui;
            height: auto;
        }


.main{
    background: #fff;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    padding: 30px;
}   

.total span {
    float:left
}

.con{
    float: right;
}

h1{
    font-size: 25px;
    color: #006d00;
}

h2{
    font-size: 40px;
    color: #006d00;
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
    padding: 10px;
    color: #7b7b7b;
    font-weight: 600;
    border:2px solid #727672;
}

td{
    padding: 10px;
    color: #000;
    font-weight: 400;
    
}

        

 table, td, th {
    border:2px solid #727672;
}

.tab{
    text-align: left  !important;
    border-top: 2px solid #727672;
}

.tab-rs {
    
    text-align: left  !important;
    border-top: 2px solid #727672;
}


.table{
    margin-top: 30px;
    border:2px solid #727672;
}
 .table-new{
    margin-top: 0px !important;
    text-align: left !important;
}

.tab h3{
    margin: 0px;
}

.tab p, .tab span{
    font-size: 12px;
}

.border-none td, th{
    border: none;
}

.border-none td{
    font-weight: 600;
}


    </style>
</head>
 
<body>
<div class="main">
    <img src="{{url('https://website-project.in/jeniscare/public/img/janiscare-logo.svg')}}" alt="" style="height:40px;width:20%">
    <h3>Purchase Orders Details</h3>
<table class="table">
   
   <tr>
    <th>#</th>
    <th>Date</th>
    <th>Product Name</th>
    <th>Manufacturer</th>
    <th>Pack Size</th>
    <th>Hsn Number</th>
    <th>MRP</th>
    <th>Rate</th>
    <th>QTY</th>
    <th>Batch No</th>
    <th>Receive</th>
   </tr>
    @isset($purchase)
    @foreach($purchase as $index => $item)
   <tr>
    <td>{{ $index+1 }}</td>
    <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
    <td>
        {{$proname[$index]}}
    </td>
    <td>{{$item->manufacturer}}</td>
    <td>{{$item->packsize}}</td>
    <td>{{$item->hsn}}</td>
    <td>{{$item->mrp}}</td>
    <td>{{$item->rate}}</td>
    <td>{{$item->qty}}</td>

   @if($item->batch!=NULL && $item->batch!='')
        <td>{{$item->batch}}</td>
    @else
        <td>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$item->id}}">Edit</button>
        </td>
    @endif
     <td>
        @if($item->received_status==1)
        {{-- <input type="checkbox" name="fav_language{{$item->id}}" checked> --}}
        <label>Yes</label>
            {{-- <input type="radio" id="css" name="fav_language{{$item->id}}" value="CSS">
            <label for="css">No</label> --}}
        @elseif($item->received_status==0)
            {{-- <input type="radio" id="html" name="fav_language{{$item->id}}" value="HTML" >
            <label for="html">Yes</label> --}}
            {{-- <input type="checkbox" name="fav_language{{$item->id}}" checked> --}}
            <label>No</label>
        {{-- @else
            <input type="radio" id="html" name="fav_language{{$item->id}}" value="HTML">
            <label for="html">Yes</label>
            <input type="radio" id="css" name="fav_language{{$item->id}}" value="CSS">
            <label for="css">No</label> --}}
        @endif()
     </td>
   </tr>
   @endforeach
   @endisset
</table>
</div>

</body>
</html>