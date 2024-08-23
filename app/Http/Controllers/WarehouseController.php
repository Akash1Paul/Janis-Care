<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CustomerDetail;
use App\Models\DeliveryList;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Stock;
use App\Models\StockAnalytic;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\DNS1D;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use SebastianBergmann\Type\NullType;

class WarehouseController extends Controller
{


    public function index()
    {
        $userdetails = UserDetail::where('email', Auth()->user()->email)->first();
        $orders = CustomerDetail::join('orders', 'customers_details.email', '=', 'orders.email')->orderBy('customers_details.created_at', 'DESC')->where('orders.city',$userdetails->city)->get();
        //->where('orders.city',$userdetails->city)--> dont delete this line
        $runnerDetails = User::join('userdetails', 'userdetails.email', '=', 'users.email')
            ->where('userdetails.warehouse', Auth()->user()->email)
            ->get(['users.*', 'userdetails.*']);

        $vehicles = Vehicle::orderBy('created_at', 'desc')->where('vehicle.warename', Auth()->user()->email)->get();

        return view('warehouse.receivedOrders')->with(compact('orders', 'runnerDetails', 'vehicles'));
    }
    public function orders_details($id)
    {

        $layout = 3;
        $order_details = Order::where('id', $id)->first();
        $territory = UserDetail::where('relationship_manager', $order_details['relationship_manager'])->first();

        // Check if the order exists
        if ($order_details) {
            $product_ids = explode(',', $order_details->product_id);

            // Loop through all product IDs in the array
            for ($i = 0; $i < count($product_ids); $i++) {
                $product_id = $product_ids[$i];
                $product_details = Product::where('product_id', $product_id)->first();

                // Output product details (for debugging)
                // echo "<pre>";
                // print_r($product_details);
            }
        } else {
            echo "Order not found.";
        }


        return view('warehouse.orderDetails')->with(compact('layout', 'order_details', 'product_details', 'territory'));
    }
    public function send_to_runner(Request $request)
    {
        $deliverylist = new DeliveryList();
        $deliverylist->date = $request->date;
        $deliverylist->order_id = $request->order_id;
        $deliverylist->runner = $request->runner;
        $deliverylist->vehicle = $request->vehicle;
        $deliverylist->save();

        $orders = Order::where('order_id', '=', $request->order_id)->first();
        $orders->status = 'On-the-Way';
        $orders->update();
        return response()->json(["success" => "Item add to cart"]);
    }
    public function filter_orders(Request $request)
    {
        $data = '';

        $orders = Order::where('status', $request->status)->get();

        foreach ($orders as $key => $value) {
            $todayDate = date('d-m-Y');
            $created_Date = date('d-m-Y', strtotime($value->created_at));
            $diff_days = strtotime($todayDate) - strtotime($created_Date);
            $diff_days = floor($diff_days / (60 * 60 * 24));

            $action = '';
            if ($value->status == 'Delivered')
                $action = '<input type="checkbox" name="check" class="send"  id="orderid" value="{{ $value->order_id }}" disabled>';
            elseif ($value->status == 'On-the-Way')
                $action = ' <input type="checkbox" name="check" class="send"  id="orderid" value="{{ $value->order_id }}" disabled>';
            else
                $action = '<input type="checkbox" name="check" class="send"  id="orderid" value="{{ $value->order_id }}">';

            $index = $key + 1;
            $data .= '
           <tr> 
            <td>' . $index . '</td>
            <td>' . date('d-m-Y', strtotime($value->created_at)) . '</td>
            <td>' . $value->spoc_name . '</td>
            <td>' . $value->relationship_manager . '</td>
            <td>' . $value->delivery_address . '</td>
            <td>
                <a
                    href="' . url("warehouse/orders-details/" . $value->id) . '">
                    <button type="button"
                        class="btn btn-primary waves-effect waves-light">
                        <i class="fas fa-eye"></i></button>
                </a>
            </td>
            <td>
                <button type="button"
                class="btn btn-outline-success waves-effect waves-light">' . $value->status . '</button>
            </td>
            <th>
                
                ' . $action . '

            </th>
            </tr>';
        }


        return response()->json(['data' => $data]);
    }
    public function runner()
    {
        $warehousedetails = UserDetail::where('userdetails.email','=',auth()->user()->email)->get();
        foreach($warehousedetails as $warecity)
        {
            $city = $warecity->city;
        }
        $runnerDetails = User::join('userdetails', 'userdetails.email', '=', 'users.email')
            ->where('userdetails.warehouse', Auth()->user()->email)
            ->where('userdetails.city',$city)
            ->get(['users.*', 'userdetails.*']);

        return view('warehouse.runner')->with(compact('runnerDetails'));
    }

    public function vehicle()
    {
        $layout = 0;
        $vehicles = Vehicle::orderBy('created_at', 'desc')->where('vehicle.warename', Auth()->user()->email)->get();
        return view('warehouse.vehicle')->with(compact('vehicles','layout'));
    }
    public function addvehicle()
    {
        $layout = 1;
        $warehouse = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
        ->where('userdetails.email', '=', Auth()->user()->email)->get();
        return view('warehouse.vehicle')->with(compact('layout','warehouse'));
    }
    public function savevehicle(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'name' => 'required',
                'number' => 'required',
                'drivarname' => 'required',
                'type' => 'required',
                'warecity' => 'required',
                'warename' => 'required',
                'drivarnumber' => 'required'
            ]);
            $vehicles = new Vehicle();
            $vehicles->name = $request->input('name');
            $vehicles->number = $request->input('number');
            $vehicles->drivarname = $request->input('drivarname');
            $vehicles->type = $request->input('type');
            $vehicles->warecity = $request->input('warecity');
            $vehicles->warename = $request->input('warename');
            $vehicles->drivarnumber = $request->input('drivarnumber');
            $vehicles->save();
            return redirect('warehouse/vehicle')->with('status', 'Vehicle Added Successfully');
        } else {
            return view('warehouse.vehicle');
        }
    }

    public function deliverylist()
    {
        $delivery_list = DeliveryList::join('orders', 'delivery_list.order_id', '=', 'orders.order_id')->where('orders.status', 'Delivered')->orderBy('delivery_list.created_at', 'DESC')->get();
        $vehicles = '';
        $runner = '';
        foreach ($delivery_list as $delivery) {
            $vehicles = DeliveryList::join('vehicle', 'delivery_list.vehicle', '=', 'vehicle.number')->where('delivery_list.vehicle', $delivery->vehicle)->get();

            $runner = DeliveryList::join('userdetails', 'delivery_list.runner', '=', 'userdetails.email')->where('delivery_list.runner', $delivery->runner)->get();
        }

        return view('warehouse.deliveryList')->with(compact('delivery_list', 'vehicles', 'runner'));
    }

    public  function orderdetails()
    {
        return view('warehouse.orderDetails');
    }

    public  function addrunner()
    {
        return view('warehouse.addRunner');
    }

    public function saverunner(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'empid' => 'required',
                'name' => 'required',
                'roles' => 'required',
                'email' => 'required|email|unique:users|unique:userdetails',
                'password' => 'required',
                'phone' => 'required',
                'workaddress' => 'required',
                'homeaddress' => 'required',
            ]);
            $Runners = new User();
            $Runners->name = $request->input('name');
            $Runners->roles = $request->input('roles');
            $Runners->email = $request->input('email');
            $Runners->password = Hash::make($request->input('password'));
            $Runners->save();

            $warehousedetails = UserDetail::where('userdetails.email','=',auth()->user()->email)->get();
            foreach($warehousedetails as $warecity)
            {
                $city = $warecity->city;
            }
            $runnerdetails = new UserDetail();
            $runnerdetails->empid = $request->input('empid');
            $runnerdetails->name = $request->input('name');
            $runnerdetails->email = $request->input('email');
            $runnerdetails->phone = $request->input('phone');
            $runnerdetails->workaddress = $request->input('workaddress');
            $runnerdetails->homeaddress = $request->input('homeaddress');
            $runnerdetails->showpassword = $request->input('password');
            $runnerdetails->note = $request->input('note');
            $runnerdetails->warehouse = auth()->user()->email;
            $runnerdetails->city = $city;
            $runnerdetails->status = 'Approved';
            if ($request->hasfile('addressproof')) {
                $file = $request->file('addressproof');
                $extension = $file->getclientoriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('image/', $filename);
                $runnerdetails->addressproof = $filename;
            }
            if ($request->hasfile('document')) {
                $file = $request->file('document');
                $extension = $file->getclientoriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('image/', $filename);
                $runnerdetails->document = $filename;
            }
            $runnerdetails->save();
            return redirect('warehouse/runner')->with('status', 'Runner Added Successfully');
        } else {
            return view('warehouse.addRunner');
        }
    }
    public function delivery_order_details($id)
    {
        $layout = 3;
        $order_details = Order::where('id', $id)->first();


        // Check if the order exists
        if ($order_details) {
            $product_ids = explode(',', $order_details->product_id);

            // Loop through all product IDs in the arrterritoryay
            for ($i = 0; $i < count($product_ids); $i++) {
                $product_id = $product_ids[$i];
                $product_details = Product::where('product_id', $product_id)->first();

                // Output product details (for debugging)
                // echo "<pre>";
                // print_r($product_details);
            }
        } else {
            echo "Order not found.";
        }


        return view('warehouse.deliveryOrderDetails')->with(compact('layout', 'order_details', 'product_details'));
    }
    public function changestatus(Request $request, $id)
    {
        $orders = Order::where('id', '=', $id)->first();
        $request->validate([
            'status' => 'required',
        ]);
        $orders->status = $request->status;
        $orders->update();

        return redirect('warehouse/reeivedorders')->with('status', ' Updated Successfully.');
    }
    public function receivedGoods()
    {
        $purchase = PurchaseDetail::where('warehouse_email', Auth()->user()->email)->orderBy('created_at', 'DESC')->get();

        return view('warehouse.receivedGoods')->with(compact('purchase'));
    }
    public function purchaseorderdetails($purchase_id)
    {
        $purchase = Purchase::where('purchase_id', $purchase_id)->get();
        $jsonDataString = Purchase::where('purchase_id', $purchase_id)->pluck('products_batchwise')->first();
        // Assuming 'products_batchwise' is the name of the JSON field
        
        // Convert the JSON string to an array
        $jsonData = json_decode($jsonDataString, true);
        $products = Product::get();
        $finalgrn = PurchaseDetail::where('purchase_id',$purchase_id)->get();
        $proname = [];

        foreach ($purchase as $pur) {
            foreach ($products as $product) {
                if ($pur->product_name == $product->product_id) {
                    $proname[] = $product->product_name;

                    // Break the loop once the product is found
                }
            }
        }

//          $grn_status = [];
//       foreach($purchase as $purc)
//       {
//             $grn_status[] = $purc->grn_status;
//       }
//    // dd($grn_status);
//    $valueCounts = 0;
//     for($i=0;$i<count($grn_status);$i++)
//     {
//         if($grn_status[$i] == 'Received')
//         {
//             $valueCounts = array_count_values($grn_status);
//         }    
//     }
     
//  dd($valueCounts);
//       if (count($valueCounts) === 1) {
//        $showgrn = 'Yes';
//           // Do something...
//       }
//       else{
//         $showgrn = 'No';
//       }
    
        // $purchasedetails = PurchaseDetails::where('purchase_id',$purchase_id)->get();
        // $purid = '';
        // foreach ($purchasedetails as $pur) {
        //     if($pur->grn==NULL && $pur->grn=='')
        //     {
        //         $purid = $purchase_id;
        //     }
        // } ['jsonData' => $jsonData]

        return view('warehouse.purchaseOrderDetails')->with(compact('purchase', 'proname', 'purchase_id','finalgrn','jsonData'));
    }
    public function showpdf($purchase_id)
    {
        $purchase = Purchase::where('purchase_id', $purchase_id)->get();
        $products = Product::get();
        $proname = [];


        foreach ($purchase as $pur) {
            foreach ($products as $product) {
                if ($pur->product_name == $product->product_id) {
                    $proname[] = $product->product_name;

                    // Break the loop once the product is found
                }
            }
        }
        // return view('warehouse.purchaseOrderPdf')->with(compact('purchase','proname','purchase_id'));
        $pdf = PDF::loadView('warehouse.purchaseOrderPdf', ['purchase' => $purchase, 'proname' => $proname, 'purchase_id' => $purchase_id]);
        return $pdf->download('Purchase' . date('Y') . '-' . $purchase_id . '.pdf');
    }
    public function edit_batch(Request $request, $id)
    {
        $purchase = Purchase::where('id', '=', $id)->first();
        $request->validate([
            'batch' => 'required',
            'expiry_date'=>'required'
        ]);
        $purchase->batch = $request->batch;
        $purchase->expiry_date = $request->expiry_date;
        $purchase->update();

        return back()->with('status', ' Updated Successfully.');
    }
    public function add_grn(Request $request, $id)
    {
        $purchasedetails = Purchase::where('id', '=', $id)->first();
        $request->validate([
            'status' => 'required'
        ]);
        $purchasedetails->grn_status = $request->status;
        $purchasedetails->grn = $request->grn;
        $purchasedetails->update();

        return back()->with('status', ' Updated Successfully.');
    }
    public function add_maingrn(Request $request, $purchase_id)
    {
        $purchasedetails = PurchaseDetail::where('purchase_id', '=', $purchase_id)->first();
        $request->validate([
            'status' => 'required'
        ]);
        $purchasedetails->status = $request->status;
        $purchasedetails->grn = $request->grn;
        $purchasedetails->update();

        return back()->with('status', ' Updated Successfully.');
    }
    public function update_received(Request $request)
    {
       
        $purchase = Purchase::where('id', '=', $request->id)->first();
        $request->validate([
            'val' => 'required',
        ]);
        $purchase->received_status = $request->val;
        $purchase->update();

        $get_purchase_id = $purchase->purchase_id;

        $purchasedetails = PurchaseDetail::where('purchase_id', $get_purchase_id)->first();

        $stockanalytics = new StockAnalytic();
        $product = Product::where('product_id', $purchase->product_name)->first();
        $randomNumber = random_int(100000, 999999);
        $batch_id = Carbon::now()->format('y') . 'H2' . $randomNumber;

        if ($purchase->received_status == '1') {
            if ($product) {

                $newstock = new Stock();
                $barcode = new DNS1D();
                $barcodeFolder = 'barcodes';
                $barcode->setStorPath(public_path($barcodeFolder));
                $newstock->product_id = $purchase->product_name;
                $newstock->warehouse = $purchasedetails->warehouse_email;
                $barcodeValue = [$purchase->product_name,$purchase->product_name,$purchase->product_name];

                $barcodeValueString = json_encode($barcodeValue); // Convert array to string
                $barcodePath = $barcode->getBarcodePNGPath($barcodeValueString, 'C128');                
                $newstock->barcode_path = basename($barcodePath);
                $newstock->max_stocks =  $purchase->qty;
                $newstock->stocks = $purchase->qty;
                $newstock->batch_id = $batch_id;
                $newstock->purchase_id =  $get_purchase_id;
                $newstock->save();

                $stockanalytics->purchase_id =  $get_purchase_id;
                $stockanalytics->product_id =  $purchase->product_name;
                $stockanalytics->stocks =  $purchase->qty;
                $stockanalytics->save();
            }
        }
        if ($purchase->received_status == 1) {
            $message = "Received";
        } else {
            $message = "Not Received";
        }
        return response()->json(['success' => "Product has been $message"]);
    }
    public function update_no(Request $request)
    {
        $purchase = Purchase::where('id', '=', $request->id)->first();
        $request->validate([
            'val' => 'required',
        ]);
        $purchase->received_status = $request->val;
        $purchase->update();


        $get_purchase_id = $purchase->purchase_id;

       
        DB::table('stocks')->where('purchase_id',$get_purchase_id)->where('product_id',$purchase->product_name)->delete();
        DB::table('stock_analytics')->where('purchase_id',$get_purchase_id)->where('product_id',$purchase->product_name)->delete();
        
        
        // $purchasedetails = PurchaseDetail::where('purchase_id', $get_purchase_id)->first();

        // $stockanalytics = new StockAnalytic();
        // $product = Product::where('product_id', $purchase->product_name)->first();
        // $randomNumber = random_int(100000, 999999);
        // $batch_id = Carbon::now()->format('y') . 'H2' . $randomNumber;

        // if ($purchase->received_status == '0') {
        //     if ($product) {

        //         $newstock = new Stock();
        //         $barcode = new DNS1D();
        //         $barcodeFolder = 'barcodes';
        //         $barcode->setStorPath(public_path($barcodeFolder));
        //         $newstock->product_id = $purchase->product_name;
        //         $newstock->warehouse = $purchasedetails->warehouse_email;
        //         $barcodeValue = [$purchase->product_name,$purchase->product_name,$purchase->product_name];

        //         $barcodeValueString = json_encode($barcodeValue); // Convert array to string
        //         $barcodePath = $barcode->getBarcodePNGPath($barcodeValueString, 'C128');                
        //         $newstock->barcode_path = basename($barcodePath);
        //         $newstock->max_stocks =  $newstock->max_stocks-$purchase->qty;
        //         $newstock->stocks = $newstock->stocks-$purchase->qty;
        //         $newstock->update();

        //         // $stockanalytics->product_id =  $purchase->product_name;
        //         // $stockanalytics->stocks =  $purchase->qty;
        //         // $stockanalytics->save();
        //     }
        // }
        if ($purchase->received_status == 1) {
            $message = "Received";
        } else {
            $message = "Not Received";
        }
        return response()->json(['success' => "Product has been $message"]);
    }
 


    public function stocks()
    {
        $warehoue_name = UserDetail::where('email', auth()->user()->email)->first();
        $stocks2 = Stock::join('products', 'products.product_id', '=', 'stocks.product_id')
        ->where('stocks.warehouse', '=', auth()->user()->email)
        ->distinct('product_id')
        ->get();

        $stocks = $stocks2->unique('product_id');
        $stocks->values()->all();

        $categories = Category::all();
        $batch_id = stock::get()->last();
        //dd( $stocks );
        $layout = 0;
        return view('warehouse.inventory')->with(compact('stocks', 'layout', 'categories', 'batch_id', 'warehoue_name','stocks2'));
    }

    public function stocks_details($id)
    {

        $warehoue_name = UserDetail::where('email', auth()->user()->email)->first();
        $stocks = Stock::join('products', 'products.product_id', '=', 'stocks.product_id')
            ->where('stocks.product_id', $id)
            ->where('stocks.warehouse',auth()->user()->email)->get();
        $categories = Category::all();
        $batch_id = stock::get()->last();
        //dd( $stocks );
        $layout = 1;
        return view('warehouse.inventory')->with(compact('stocks', 'layout', 'categories', 'batch_id', 'warehoue_name'));
    }


    public function filter_stocks(Request $request)
    {
        $user_details = UserDetail::where('email', auth()->user()->email)->first();


        if ($request->category) {
            $stocks2 = Stock::join('products', 'products.product_id', '=', 'stocks.product_id')->where('products.categories', $request->category)->get();
            $stocks = $stocks2->unique('product_id');
            $stocks->values()->all();
        } else {
            $products =  Stock::join('products', 'products.product_id', '=', 'stocks.product_id')
                ->where('stocks.warehouse', '=', $user_details->email)->get();
        }

        $data = '';

        foreach ($stocks as $key => $item) {
            $percentage = (100 / $item->max_stocks) * $item->stocks;
            if ($percentage >= 0 && $percentage < 25)
            {
                $percentagedata = ' <div class="progress"><div class="progress-bar bg-danger"
                role="progressbar"
                style="width: '.$percentage .'%"
                aria-valuenow="'. $percentage .'"
                aria-valuemin="0" aria-valuemax="100">
                '. round($percentage) .'%</div></div>';
            }
            elseif($percentage >= +25 && $percentage < +50)
            {
                $percentagedata = '<div class="progress"><div class="progress-bar bg-warning"
                role="progressbar"
                style="width: '.$percentage .'%"
                aria-valuenow="'.$percentage .'"
                aria-valuemin="0" aria-valuemax="100">
                '. round($percentage) .'%</div></div>';
            }
            elseif($percentage >= +50 && $percentage < +75)
            {
                $percentagedata = '<div class="progress"><div class="progress-bar bg-primary"
                role="progressbar"
                style="width: '.$percentage .'%"
                aria-valuenow="'.$percentage .'"
                aria-valuemin="0" aria-valuemax="100">
                '. round($percentage) .'%</div></div>';
            }
            else
            {
                $percentagedata = '<div class="progress"><div class="progress-bar bg-success"
                role="progressbar"
                style="width: '.$percentage .'%"
                aria-valuenow="'.$percentage .'"
                aria-valuemin="0" aria-valuemax="100">
                '. round($percentage) .'%</div></div>';
            }
            $totalstock = 0;
            foreach ($stocks2 as $key2 => $item2)
            {
             
                if($item->product_id == $item2->product_id ) {
                    $totalstock += $item2->stocks;
                }
            } 
            $totalsold = 0;
            foreach ($stocks2 as $key2 => $item2)
            {
             
                if($item->product_id == $item2->product_id ) {
                    $totalsold += $item2->sold;
                }
            }         
            $data .= '<tr rowspan="2">
                <td class="mt-2 mr-2">' . ($key + 1) . '</td>
                <td>' . $item->product_id . '</td>
                <td>' . date('d-m-Y', strtotime($item->created_at)) . '</td>
                <td>' . $item->product_name . '</td>
                <td>' . $item->categories . '</td>
                <td>' . $totalsold. '</td>
                <td>' . $item->stocks . '</td>
                <td><img src="' . url("image/" . $item->image) . '" style="width:50px;height:50px;border-radius:50%" alt=""></td>
                <td>'.$percentagedata.'</td>
                <td><a href="' . url("warehouse/inventory-details/" . $item->product_id) . '">
                        <button type="button"
                            class="btn btn-primary waves-effect waves-light">
                            Details</button>
                    </a></td>
                                   
                </tr>';
        }

        return response()->json(['data' => $data]);
    }

    public function invoice($id)
    {
        $order_details = Order::where('id', $id)->first();

        $territory = UserDetail::where('relationship_manager', $order_details['relationship_manager'])->first();
        //dd(   $territory);
        // Check if the order exists
        if ($order_details) {
            $product_ids = explode(',', $order_details->product_id);

            // Loop through all product IDs in the array
            for ($i = 0; $i < count($product_ids); $i++) {
                $product_id = $product_ids[$i];
                $product_details = Product::where('product_id', $product_id)->first();

                // Output product details (for debugging)
                // echo "<pre>";
                // print_r($product_details);
            }
        } else {
            echo "Order not found.";
        }
        $productscheck = Product::get();
        $randomNumber = random_int(100000, 999999);
        return view('warehouse.invoice')->with(compact('order_details','productscheck', 'product_details','territory','randomNumber','id'));
    }
    public function generatePDF($id)
    {
        $order_details = Order::where('id', $id)->first();

        $territory = UserDetail::where('relationship_manager', $order_details['relationship_manager'])->first();
        //dd(   $territory);
        // Check if the order exists
        if ($order_details) {
            $product_ids = explode(',', $order_details->product_id);
            // Loop through all product IDs in the array
            for ($i = 0; $i < count($product_ids); $i++) {
                $product_id = $product_ids[$i];
                $product_details = Product::where('product_id', $product_id)->first();

                // Output product details (for debugging)
                // echo "<pre>";
                // print_r($product_details);
        
            }
        } else {
            echo "Order not found.";
        }
        $productscheck = Product::get();
        $randomNumber = random_int(100000, 999999);
        $pdf = PDF::loadView('admin.invoice', ['order_details' => $order_details,'product_details' => $product_details, 'territory' => $territory, 'randomNumber' => $randomNumber, 'id'=>$id,'productscheck'=>$productscheck]);
        return $pdf->download('Invoice_JC' . date('Y-') . '-' . $randomNumber . '.pdf');
    }
    public function updateqty(Request $request,$id)
    {
        $purchase=Purchase::find($id);
        $purchase->qty = $request->qty;
        $purchase->update();
        return back();
    }
    public function updatebatch(Request $request,$id)
    {
        $purchase=Purchase::find($id);
        $purchase->batch = $request->batch;
        $purchase->update();
        return back();
    }
    public function addmultiprodbatch(Request $request,$id)
    {
        $purchase = Purchase::where('id', $id)->get();
        return view('warehouse.addmultiprodbatch')->with(compact('id','purchase'));
    }
    public function editmultiprodbatch(Request $request,$id)
    {
        $purchase = Purchase::where('id', $id)->get();
        $jsonDataString = Purchase::where('id', $id)->pluck('products_batchwise')->first();
        $jsonData = json_decode($jsonDataString, true);
        return view('warehouse.editmultiprodbatch')->with(compact('id','jsonData','purchase'));
    }

    public function add_multiple_batch(Request $request,$id)
    {
        // Extract data from the request
        $batch = $request->input('batch');
        $qty = $request->input('qty');
        $expdate = $request->input('expdate');
        
        // Initialize an empty array to hold the transformed data
        $transformedData = [];
        
        // Loop through each item and transform it
        for ($i = 0; $i < count($batch); $i++) {
            $transformedData[$i + 1] = [
                'batch' => $batch[$i],
                'qty' => $qty[$i],
                'expdate' => $expdate[$i]
            ];
        }
        $purchase =  Purchase::where('id',$id)->first();
        Purchase::where('id',$id)->update(['products_batchwise' => $transformedData]);
        return redirect('warehouse/purchaseorderdetails/'.$purchase->purchase_id);
    }
    public function update_multiple_batch(Request $request,$id)
    {
        // Extract data from the request
        $batch = $request->input('batch');
        $qty = $request->input('qty');
        $expdate = $request->input('expdate');
        
        // Initialize an empty array to hold the transformed data
        $transformedData = [];
        
        // Loop through each item and transform it
        for ($i = 0; $i < count($batch); $i++) {
            $transformedData[$i + 1] = [
                'batch' => $batch[$i],
                'qty' => $qty[$i],
                'expdate' => $expdate[$i]
            ];
        }
        $purchase =  Purchase::where('id',$id)->first();
         Purchase::where('id',$id)->update(['products_batchwise' => $transformedData]);
        return back();
    }
    public function batchdelete(Request $request){
        $id = $request->id;
        $rowId = $request->key;
        // Retrieve the model instance from the database
        $record = Purchase::find($id); // Assuming the data is stored in the row with id 5

        // Retrieve the JSON data from the database column
        $jsonData = $record->products_batchwise;

        // Decode the JSON data into a PHP associative array
        $data = json_decode($jsonData, true);

        // Check if the rowId exists in the data array
        if (isset($data[$rowId])) {
            // Remove the specific row using unset
            unset($data[$rowId]);

            // Encode the modified associative array back to JSON
            $updatedJsonData = json_encode($data);

            // Update the database column with the modified JSON data
            $record->products_batchwise = $updatedJsonData;
            $record->save();

            return response()->json(['message' => 'Row deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Row not found'], 404);
        }
    }
   
//     public function upgrade_stocks(Request $request)
//     {
//         $checkProduct = Product::where('product_id', $request->product_id)->first();
//         $randomNumber = random_int(100000, 999999);
//         $batch_id = Carbon::now()->format('y') . 'H2' . $randomNumber;

//         if ($checkProduct) {
//             $stock = new Stock();
//             $barcode = new DNS1D();
//             $barcodeFolder = 'barcodes';
//             $barcode->setStorPath(public_path($barcodeFolder));
//             $barcodeValue = ['expiry_date'=>$stock->created_at,'mrp'=>'123','batch_id'=>'asf'];
//             $barcodePath = $barcode->getBarcodePNGPath($barcodeValue, 'C128');
            
//             $stock->warehouse=auth()->user()->email;
//             $stock->product_id = $request->product_id;
//             $stock->barcode_path = basename($barcodePath);
//             $stock->max_stocks = $stock->stocks + $request->stocks;
//             $stock->stocks += $request->stocks;
//             $stock->batch_id = $batch_id;
//             $stock->update();
//         }
       


//         return response()->json(['message' => 'stocks updated'], 200);
//     }

 }
