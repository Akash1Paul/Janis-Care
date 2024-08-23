<?php

namespace App\Http\Controllers;

use App\Exports\CustomerOutletExport;
use App\Exports\ExportCustomer;
use App\Exports\ExportDiscount;
use App\Exports\ExportProduct;
use App\Exports\ExportRoles;
use App\Exports\ExportVehicle;
use App\Exports\ProductPincodeExport;
use App\Exports\SalesExport;
use App\Http\Controllers\Controller;
use App\Imports\CustomerDetailsImport;
use App\Imports\CustomerOutletImport;
use App\Imports\DiscountImport;
use App\Imports\ImportProduct;
use App\Imports\ImportRoles;
use App\Imports\ImportVehicle;
use App\Imports\ProductPincodeImport;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\UserDetail;
use App\Models\CustomerDetail;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductAvailability;
use App\Models\Stock;
use App\Models\StockAnalytic;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Vehicle;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

use GuzzleHttp\Handler\Proxy;
use Maatwebsite\Excel\Facades\Excel;

class SuperAdminController extends Controller
{



    public function validateFDANumber(Request $request)
    {



        $validator = Validator::make($request->all(), [
            'fda_number' => 'required|regex:/^\d{11}$/',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        } else {
            return response()->json(['message' => 'Fda verified' . $request->input('fda_number')], 200);
        }
    }

    public function index()
    {
        $layout = 0;
        $products = Product::all();
        $orders = Order::all();
        $categories = Category::all();
        $users = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('users.roles', '=', 'customer')->orderBy('customers_details.created_at', 'DESC')->get();

        $total_customer=CustomerDetail::count();
        $approvedcustomer = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('users.roles', '=', 'customer')->where('customers_details.status', '=', 'Approved')->orderBy('customers_details.created_at', 'DESC')->get();

        if($total_customer == Null || $total_customer == 0){
            $approvedcustomers = 0;
        }else{
            $approvedcustomers=round((count($approvedcustomer)/$total_customer)*100);
        }
      


        $Delivered = Order::where('status', 'Delivered')->get();

        $ordersthisweek = Order::whereYear('created_at', date('Y'))->get()->toArray();

        $ordersthisweeks = [
            'Jan' => 0,
            'Feb' => 0,
            'Mar' => 0,
            'Apr' => 0,
            'May' => 0,
            'Jun' => 0,
            'Jul' => 0,
            'Aug' => 0,
            'Sep' => 0,
            'Oct' => 0,
            'Nov' => 0,
            'Dec' => 0
        ];
        foreach ($ordersthisweek as $thisorders) {
            $getmonth = date('M', strtotime($thisorders['created_at']));
            if ($getmonth == 'Jan') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $thisorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersthisweeks['Jan'] += $count;
            }
            if ($getmonth == 'Feb') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $thisorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersthisweeks['Feb'] += $count;
            }
            if ($getmonth == 'Mar') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $thisorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersthisweeks['Mar'] += $count;
            }
            if ($getmonth == 'Apr') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $thisorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersthisweeks['Apr'] += $count;
            }
            if ($getmonth == 'May') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $thisorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersthisweeks['May'] += $count;
            }
            if ($getmonth == 'Jun') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $thisorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersthisweeks['Jun'] += $count;
            }
            if ($getmonth == 'Jul') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $thisorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersthisweeks['Jul'] += $count;
            }
            if ($getmonth == 'Aug') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $thisorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersthisweeks['Aug'] += $count;
            }
            if ($getmonth == 'Sep') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $thisorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersthisweeks['Sep'] += $count;
            }
            if ($getmonth == 'Oct') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $thisorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersthisweeks['Oct'] += $count;
            }
            if ($getmonth == 'Nov') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $thisorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersthisweeks['Nov'] += $count;
            }
            if ($getmonth == 'Dec') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $thisorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersthisweeks['Dec'] += $count;
            }
        }
        $currentYear = date('Y');
        $previousYear = $currentYear - 1;
        $ordersLastweek = Order::whereYear('created_at', $currentYear)->get()->toArray();
        //dd($ordersLastweek);
        $ordersLastweeks = [
            'Jan' => 0,
            'Feb' => 0,
            'Mar' => 0,
            'Apr' => 0,
            'May' => 0,
            'Jun' => 0,
            'Jul' => 0,
            'Aug' => 0,
            'Sep' => 0,
            'Oct' => 0,
            'Nov' => 0,
            'Dec' => 0
        ];
        foreach ($ordersLastweek as $lastorders) {
            $getmonth = date('M', strtotime($lastorders['created_at']));
            if ($getmonth == 'Jan') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $lastorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersLastweeks['Jan'] += $count;
            }
            if ($getmonth == 'Feb') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $lastorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersLastweeks['Feb'] += $count;
            }
            if ($getmonth == 'Mar') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $lastorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersLastweeks['Mar'] += $count;
            }
            if ($getmonth == 'Apr') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $lastorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersLastweeks['Apr'] += $count;
            }
            if ($getmonth == 'May') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $lastorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersLastweeks['Jun'] += $count;
            }
            if ($getmonth == 'Jul') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $lastorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersLastweeks['Jul'] += $count;
            }
            if ($getmonth == 'Aug') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $lastorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersLastweeks['Aug'] += $count;
            }
            if ($getmonth == 'Sep') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $lastorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersLastweeks['Sep'] += $count;
            }
            if ($getmonth == 'Oct') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $lastorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersLastweeks['Oct'] += $count;
            }
            if ($getmonth == 'Nov') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $lastorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersLastweeks['Nov'] += $count;
            }
            if ($getmonth == 'Dec') {
                $ordersperday = [];
                $count = 0;
                $ordersperday = explode(',', $lastorders['moq']);
                foreach ($ordersperday as $info) {
                    $count += $info;
                }
                $ordersLastweeks['Dec'] += $count;
            }
        }

        // Total Orders Part Start---->
        $curentmonthorder = Order::whereMonth('created_at', Carbon::now()->month)->get();
        $thismonthorder = 0;
        foreach ($curentmonthorder as $currentorder) {
            $thismonthorder += count(explode(',', $currentorder->product_id));
        }

        $lastmonthorder = Order::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get();
        $lastmonthsorder = 0;
        foreach ($lastmonthorder as $lastorder) {
            $lastmonthsorder += count(explode(',', $lastorder->product_id));
        }
        // Total Orders Part End---->

        // Total Customers Part Start---->
        $curentmonthcustomer = CustomerDetail::whereMonth('customers_details.created_at', Carbon::now()->month)->join('users', 'customers_details.email', '=', 'users.email')->where('users.roles', '=', 'customer')->orderBy('customers_details.created_at', 'DESC')->get()->count();

        $lastmonthcustomer = CustomerDetail::whereMonth('customers_details.created_at', '=', Carbon::now()->subMonth()->month)->join('users', 'customers_details.email', '=', 'users.email')->where('users.roles', '=', 'customer')->orderBy('customers_details.created_at', 'DESC')->get()->count();

        $totalcustomer = ($curentmonthcustomer - $lastmonthcustomer) / 100;
        // Total Customers Part End---->

        // Total Delivered Part Start---->
        $currentmonthdelivered = Order::whereMonth('updated_at', Carbon::now()->month)->where('status', 'Delivered')->get()->count();

        $lastmonthdelivered = Order::whereMonth('updated_at', '=', Carbon::now()->subMonth()->month)->where('status', 'Delivered')->get()->count();

        $totaldelivered = ($currentmonthdelivered - $lastmonthdelivered) / 100;
        // Total Delivered Part End---->

        // Total Products Part Start---->
        $currentmonthproduct = Product::whereMonth('updated_at', Carbon::now()->month)->get()->count();

        $lastmonthproduct = Product::whereMonth('updated_at', '=', Carbon::now()->subMonth()->month)->get()->count();
        $totalproduct = ($currentmonthproduct - $lastmonthproduct) / 100;
        // Total Products Part End---->

        // Total Transaction Part Start---->
      
        $transaction = Order::whereYear('created_at', $currentYear)->get()->toArray();
        
        $totalTransaction = 0;

        $thismobthtran = [
            'Jan' => 0,
            'Feb' => 0,
            'Mar' => 0,
            'Apr' => 0,
            'May' => 0,
            'Jun' => 0,
            'Jul' => 0,
            'Aug' => 0,
            'Sep' => 0,
            'Oct' => 0,
            'Nov' => 0,
            'Dec' => 0
        ];
        foreach ($transaction as $tran) {
            $totalTransaction += $tran['total_price'];
            $getmonth = date('M', strtotime($tran['created_at']));
            if ($getmonth == 'Jan') {
                $count = 0;
                $count += $tran['total_price'];
                $thismobthtran['Jan'] += $count;
            }
            if ($getmonth == 'Feb') {
                $count = 0;
                $count += $tran['total_price'];
                $thismobthtran['Feb'] += $count;
            }
            if ($getmonth == 'Mar') {
                $count = 0;
                $count += $tran['total_price'];
                $thismobthtran['Mar'] += $count;
            }
            if ($getmonth == 'Apr') {
                $count = 0;
                $count += $tran['total_price'];
                $thismobthtran['Apr'] += $count;
            }
            if ($getmonth == 'May') {
                $count = 0;
                $count += $tran['total_price'];
                $thismobthtran['May'] += $count;
            }
            if ($getmonth == 'Jun') {
                $count = 0;
                $count += $tran['total_price'];
                $thismobthtran['Jun'] += $count;
            }
            if ($getmonth == 'Jul') {
                $count = 0;
                $count += $tran['total_price'];
                $thismobthtran['Jul'] += $count;
            }
            if ($getmonth == 'Aug') {
                $count = 0;
                $count += $tran['total_price'];
                $thismobthtran['Aug'] += $count;
            }
            if ($getmonth == 'Sep') {
                $count = 0;
                $count += $tran['total_price'];
                $thismobthtran['Sep'] += $count;
            }
            if ($getmonth == 'Oct') {
                $count = 0;
                $count += $tran['total_price'];
                $thismobthtran['Oct'] += $count;
            }
            if ($getmonth == 'Nov') {
                $count = 0;
                $count += $tran['total_price'];
                $thismobthtran['Nov'] += $count;
            }
            if ($getmonth == 'Dec') {
                $count = 0;
                $count += $tran['total_price'];
                $thismobthtran['Dec'] += $count;
            }
        }
        // Total Transaction Part End---->
        $lastmonthtran = Order::whereMonth('updated_at', '=', Carbon::now()->subMonth()->month)->get()->toArray();
        $totallastmonthtran = 0;
        foreach ($lastmonthtran as $lasttran) {
            $totallastmonthtran += $lasttran['total_price'];
        }
        $totaltranpercentage = round((($totalTransaction - $totallastmonthtran) / 100), 2);


        return view('superadmin.dashboard')->with(compact('layout', 'users', 'products', 'users', 'categories', 'orders', 'ordersthisweeks', 'ordersLastweeks', 'approvedcustomers', 'Delivered', 'thismonthorder', 'lastmonthsorder', 'totalcustomer', 'totaldelivered', 'totalproduct', 'thismobthtran', 'totalTransaction', 'totaltranpercentage'));
    }


    // ======================Products_Manages===================

    public function products()
    {
       
        $layout = 0;
        $products = Product::orderBy('created_at', 'DESC')->get();
        $carts = Cart::where('email', auth()->user()->email)->get();
        // dd($products);
        $stock = Stock::get();
        $categories = Category::all();
        return view('superadmin.products')->with(compact('layout', 'products', 'carts', 'categories', 'stock'));
    }


    public function create_product(Request $request)
    {
        $layout = 1;
        $categories = Category::all();
        $users = UserDetail::all();
        return view('superadmin.products')->with(compact('layout', 'categories', 'users'));
    }


    public function save_product(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'manufacturer'=>'required',
            'product_name' => 'required',
            'images' => 'required',
            'description' => 'required',
            'price' => 'required',
            'categories' => 'required',
            'sub_categories' => 'required',
            'sub_sub_categories' => 'required',
            'min_order_quantity' => 'required',
            'packsize' => 'required',
            'unit' => 'required',
            'jsp' => 'required',
            'gstin' =>  'required',
            'hsncode'=>  'required'
        ]);

        $product = new Product;
        $product->product_id = str_replace(' ', '', 'JANIS' . rand(1000, 9999));
        $product->manufacturer = $request['manufacturer'];
        $product->brand_name = $request['brand'];
        $product->product_name = $request['product_name'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        $product->categories = $request['categories'];
        $product->sub_categories = $request['sub_categories'];
        $product->sub_sub_categories = $request['sub_sub_categories	'];
        $product->min_order_quantity = $request['min_order_quantity'];
        $product->packsize = $request['packsize'];
        $product->unit = $request['unit'];
        $product->jsp = $request['jsp'];
        $product->gstin = $request['gstin'];
        $product->hsncode = $request['hsncode'];


        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $product->image = $filename;
        }

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $uploadFolder = 'image';

            foreach ($images as $image) {
                $image_uploaded_path = $image->store($uploadFolder, 'public');
                $image_name =  basename($image_uploaded_path);
                $mime = $image->getClientMimeType();
                $images_path[] = $image_uploaded_path;
            }
            $product['others_image'] = implode(',', $images_path);
        }
        $product->save();

        return redirect('superadmin/products')->with('status', 'product added Successfully');
    }


    public function edit_product($id)
    {

        $layout = 2;
        $product = Product::find($id);
        $categories = Category::all();
        $users = UserDetail::all();
        return view('superadmin.products')->with(compact('layout', 'product', 'users', 'categories'));
    }


    public function update_product(Request $request, $id)
    {
        
        $product = Product::find($id);
        $request->validate([
            'brand' => 'required',
            'product_name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'categories' => 'required',
            'sub_categories' => 'required',
            'sub_sub_categories' => 'required',
            'min_order_quantity' => 'required',
            'packsize' =>  'required',
            'unit' => 'required',
            'jsp' => 'required',
            'gstin' =>  'required',
            'hsncode'=>  'required'
        ]);

        $product->manufacturer = $request['manufacturer'];
        $product->brand_name = $request['brand'];
        $product->product_name = $request['product_name'];
        $product->description = $request['description'];
        $product->image = $request['image'];
        $product->others_image = $request['old_images'];
        $product->price = $request['price'];
        $product->categories = $request['categories'];
        $product->sub_categories = $request['sub_categories'];
        $product->sub_sub_categories = $request['sub_sub_categories'];
        $product->min_order_quantity = $request['min_order_quantity'];
        $product->packsize = $request['packsize'];
        $product->unit = $request['unit'];
        $product->jsp = $request['jsp'];
        $product->gstin = $request['gstin'];
        $product->hsncode = $request['hsncode'];

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $uploadFolder = 'image';
            $images_path = []; // Initialize array to store paths of uploaded images
            foreach ($images as $image) {
                $image_uploaded_path = $image->store($uploadFolder, 'public');
                // Check if file was uploaded successfully
                if ($image_uploaded_path) {
                    // File uploaded successfully
                    $image_name =  basename($image_uploaded_path);
                    $mime = $image->getClientMimeType();
                    $images_path[] = $image_uploaded_path;
                } else {
                    // File upload failed
                    // Handle the failure here, you can log an error message or take appropriate action
                    // For example:
                    // Log::error('Failed to upload file: ' . $image->getClientOriginalName());
                }
            }
            $product['others_image'] = implode(',', $images_path);
        }
        

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $product->image = $filename;
        }

        $product->update();
        return redirect('superadmin/products')->with('status', 'product Updated Successfully');
    }

    public function delete_product(Request $request, $id)
    {
        $product = Product::destroy($id);
        return redirect('superadmin/products')->with('delete', 'product Deleted');
    }

    public function product_details($id)
    {
        $layout = 3;
        $product_details = Product::find($id);
        return view('superadmin.products')->with(compact('layout', 'product_details'));
    }

    public function filter_products(Request $request)
    {
    $carts=Cart::where('email',auth()->user()->email)->get();
    
        
        if ($request->input('category')) 
        {
            $products = Product::where('categories', $request->category)->get();
        }elseif($request->input('sub_category')){
            $products = Product::where('sub_categories', $request->sub_category)->get();
        }elseif( $request->input('sub_sub_category')){
     
            $products = Product::where('sub_sub_categories', $request->sub_sub_category)->get();
        }
        else {
            $products = Product::orderBy('id', 'DESC')->get();
        }

        $data = '';
        foreach ($products as $key => $item) {
            $data .= '<tr rowspan="2">
                    <td class="mt-2 mr-2">' . ($key + 1) . '</td>
                    <td>' . $item->product_id . '</td>
                    <td>' . date("d-m-Y", strtotime($item->created_at)) . '</td>
                    <td>' . $item->product_name . '</td>
                    <td>' . $item->categories . '</td>
                    <td>' . $item->min_order_quantity . '</td>
                    <td>' . $item->price . '</td>
                    <input type="hidden" id="product_id' . $item->id . '"
                        value="' . $item->product_id . '" />
                    <td><img src="' . url("image/" . $item->image) . '"
                            style="width:50px;height:50px;border-radius:50%"
                            alt=""></td>
                    <td><a href="' . url("superadmin/product-details/" . $item->id) . '">
                            <button type="button"
                                class="btn btn-primary waves-effect waves-light">
                                <i class="fas fa-eye"></i></button>
                        </a></td>
                    <td>';


                    $cartProductIds = $carts->pluck("product_id")->toArray();
            $data .= '<input type="checkbox" id="cart' . $item->id . '"
                        class="cart-checkbox"
                        data-product-id="' . $item->product_id . '" ' . (in_array($item->product_id, $cartProductIds) ? "checked" : '') . ' >
                    </td>
                    <td>
                        <a href="' . url("superadmin/edit-product/" . $item->id) . '"><button
                                class="btn btn-primary"
                                style="color:white">Edit</button></a>
                        <a href="' . url("superadmin/delete-product/" . $item->id) . '"><button
                                class="btn btn-danger">Delete</button></a>
                    </td>
                </tr>';

            $data .= '<script>
                $(document).ready(function() {
                    $("#cart' . $item->id . '").change(function() {
                        if ($(this).is(":checked")) {
                            var product_id = $(this).data("product-id");
        
                            $.ajax({
                                url: "' . url('superadmin/add-to-carts') . '",
                                type: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": $("meta[name=\'csrf-token\']").attr("content")
                                },
                                data: {
                                    product_id: product_id,
                                },
                                success: function(response) {
                                    if (response.success) {
                                        // Handle success if needed
                                    } else {
                                        alert("Item already in a cart");
                                    }
                                }
                            });
                        }
                    });
                });
                </script>';
        }


        
        return response()->json(['data' => $data,]);

        
     
    }



    public function carts(Request $request)
    {
        $carts = Cart::join('products', 'carts.product_id', '=', 'products.product_id')->where('carts.email', Auth()->user()->email)->get();
        $layout = 0;
        $customers = CustomerDetail::all();
        return view('superadmin.carts')->with(compact('layout', 'carts', 'customers'));
    }

    public function fetch_carts()
    {

        $html = '';
        $sub_total = null;



        $carts = Cart::join('products', 'products.product_id', '=', 'carts.product_id')->where('carts.email', auth()->user()->email)->get();

        if ($carts) {
            foreach ($carts as $key => $value) {
                $subtotal1[] = intval($value->price) * intval($value->min_order_quantity);
                $sub_total += $subtotal1[$key];

                if ($sub_total < 1000) {
                    $delivery_charges = 150;
                    $total = $sub_total + 150;
                } else {
                    $delivery_charges = 0;
                    $total = $sub_total + 0;
                }
            }
            foreach ($carts as $key => $value) {
                // $subtotal1[] = intval($value->price) * intval($value->min_order_quantity);
                $html .= '<tr id="hide' . $value->product_id . '">
                <input type="hidden" 
                    id="deleteid' . $value->product_id . '"
                    value="' . $value->product_id . '">
                
                <td>
                    <a href="#"><img src="' . url('image/' . $value->image) . '" alt="#" style="height:40px; width:40px;"></a>
                </td>
                <td >
                     ' . $value->product_name . '
                </td>
                <td
                    data-price="' . $value->price . '">
                    ' .  $value->price  . '
                </td> 
                <input type="hidden" class="price" value="' .  $value->price . '">
                <td >
                    <div class="cart-plus-minus">
                        <span class="minus">-</span>
                        <input type="text"
                            value="' . $value->min_order_quantity . '"
                            name="qtybutton"
                            class="cart-plus-minus-box moq">
                        <span class="plus">+</span>
                    </div>
                </td>
                <td >
                ' .  intval($value->price) * intval($value->min_order_quantity) . '
                </td>
                <td class="cart-product-remove' . $value->product_id . '"
                    id="deletecart' . $value->product_id . '">x
                </td>
        
                </tr> ';
            }
            return response()->json([
                'delivery_charge' => $delivery_charges,
                'html' => $html,
                'total' => $total,
            ]);
        }
    }



    public function add_to_carts(Request $request)
    {
        $carts = Cart::where('product_id', $request->product_id)->where('email', auth()->user()->email)->first();
        if (!$carts) {
            $cart = new Cart;
            $cart->product_id = $request->product_id;
            $cart->email = auth()->user()->email;
            $cart->save();
            $total_carts = Cart::where('email', auth()->user()->email)->count();
            return response()->json(["success" => "Item add to cart", 'total_carts' => $total_carts]);
        } else {
            return response()->json(["error" => "Item already in a cart"]);
        }
    }

    public function total_carts()
    {
        $email = auth()->user()->email;
        $total_carts = Cart::where('email', $email)->count();
        return response()->json(['total_carts' => $total_carts]);
    }


    public function delete_carts(Request $request)
    {
        Cart::where('product_id', $request->id)->delete();
        $total_carts = Cart::where('email', auth()->user()->email)->count();
        return response()->json(['total_carts' => $total_carts]);
    }


    // =====================End_Products_Manages=====================

    // ==================Customers_Section====================
    public function customers()
    {
        $layout = 0;
        $customers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('users.roles', '=', 'customer')->orderBy('customers_details.created_at', 'DESC')->get();
        $relationship_managers = UserDetail::join('users', 'userdetails.email', '=', 'users.email')->where('users.roles', '=', 'relationship')->get();
        return view('superadmin.customers')->with(compact('layout', 'relationship_managers', 'customers'));
    }

    public function create_customers()
    {
        $layout = 1;
        $relationship_managers = User::where('roles', '=', 'relationship')->get();
        return view('superadmin.customers')->with(compact('layout', 'relationship_managers'));
    }
 

    public function save_customers(Request $request)
    {

       

        $validator = Validator::make($request->all(), [
            // 'gst' => ['required', 'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/'],
            // 'fda_license_number' => ['required', 'regex:/^[A-Z]{2}[0-9]{4}[0-9A-Z]{2}[0-9]{4}$/'],
            'buisness_name' => 'required',
            'customer_city' => 'required',
            'brand_name'=>'required',
            'company_name' => 'required',
            'relationship_manager' => 'required',
            // 'spoc_name' => 'required',
            'email' => 'required|unique:customers_details|unique:users',
            // 'spoc_number' => 'required|unique:customers_details|max:12',
            'credit_amount' => 'required',
            'credit_period' => 'required',
            // 'outlet_name'=> 'required',
            // 'outlet_spoc'=> 'required',
            // 'outlet_spoc_number'=> 'required',
            // 'phone' => 'required',

            // 'expirydate' => 'required',
            // 'pincode'=> 'required',
            // 'state' => 'required',
            // 'city' => 'required',
            // 'billing_address' => 'required',
            // 'delivery_address' => 'required', 
            // 'outlet_email'=>'required'
         
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

    
        $password = rand();

        // Create a new user
        $roles = 'customer';
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->buisness_name;
        $user->roles = $roles;
        $user->password = bcrypt($password);
        $user->save();

        $userDetails = new CustomerDetail;

        // Map request data to model fields
        $userDetails->brand_name = $request->brand_name;
        $userDetails->buisness_name = $request->buisness_name;
        $userDetails->company_name = $request->company_name;
        $userDetails->relationship_manager = $request->relationship_manager;
        $userDetails->email = $request->email;
        $userDetails->spoc_name = $request->spoc_name;
        $userDetails->spoc_number = $request->spoc_number;
        $userDetails->credit_amount = $request->credit_amount;
        $userDetails->credit_period = $request->credit_period;
        $userDetails->customer_city = $request->customer_city;
        $userDetails->status = 'Approved';
        
        $properties = [
            'issuedate',
            'expirydate',
            'outlet_name',
            'outlet_spoc',
            'outlet_spoc_number',
            'phone',
            'city',
            'state',
            'gst',
            'fda_license_number',
            'pincode',
            'billing_address',
            'delivery_address',
            'outlet_email',
            'note',
        ];

        foreach ($properties as $property) {
            if (isset($request->$property)) {
                if (is_array($request->$property)) {
                    $userDetails->$property = implode(',', $request->$property);
                } else {
                    $userDetails->$property = $request->$property;
                }
            } else {
                $userDetails->$property = '';
            }
        }

        if ($request->hasfile('document')) {
            $files = $request->file('document'); // Get an array of uploaded files
            $filenames = []; // Initialize an array to store the filenames

            foreach ($files as $file) {
                // Process each file individually
                $extension = $file->getClientOriginalExtension(); // Get the file extension
                $filename = time() . '.' . $extension; // Generate a unique filename
                $file->move('image/', $filename);
                $filenames[] = $filename;
            }
            $filenamesString = implode(',', $filenames);
            $userDetails->document = $filenamesString;
        }
        if ($request->hasfile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userDetails->photo = $filename;
        }

        $userDetails->save();


        // Send welcome email

        Mail::send('email', ['email' => $request->email, 'password' => $password], function (Message $message) use ($request) {
            $message->to($request->email)
                ->subject('Welcome to our website');
        });
        return redirect('superadmin/customers')->with('status', 'Customer added successfully.');
    }


    public function edit_customers($email_id)
    {
        $customer = CustomerDetail::where('email', $email_id)->first();
        $products = Product::all();
        $layout = 2;
        $relationship_managers = UserDetail::join('users', 'userdetails.email', '=', 'users.email')->where('users.roles', '=', 'relationship')->get();
        return view('superadmin.customers')->with(compact('layout', 'customer', 'products', 'relationship_managers'));
    }

    public function map($data1): array
    {
        $maindata = [];
        $customers = CustomerDetail::all();

        foreach ($customers as $item) {
            $email = $item->email;
            $state = explode(',', $item->state);
            $city = explode(',', $item->city);
            $outlet_name = explode(',', $item->outlet_name);
            $outlet_spoc = explode(',', $item->outlet_spoc);
            $outlet_spoc_number = explode(',', $item->outlet_spoc_number);
            $phone = explode(',', $item->phone);
            $gst = explode(',', $item->gst);
            $fda_license_number = explode(',', $item->fda_license_number);
            $issuedate = explode(',', $item->issuedate);
            $expirydate = explode(',', $item->expirydate);
            $pincode = explode(',', $item->pincode);
            $billing_address = explode(',', $item->billing_address);
            $delivery_address = explode(',', $item->delivery_address);
            $outlet_email = explode(',', $item->outlet_email);
            $note = explode(',', $item->note);

            $count = count($outlet_name);

            for ($i = 0; $i < $count; $i++) {
                $maindata[] = [
                    'Id' => $email,
                    'state' => isset($state[$i]) ? $state[$i] : null,
                    'city' => isset($city[$i]) ? $city[$i] : null,
                    'outlet_name' => isset($outlet_name[$i]) ? $outlet_name[$i] : null,
                    'outlet_spoc' => isset($outlet_spoc[$i]) ? $outlet_spoc[$i] : null,
                    'outlet_spoc_number' => isset($outlet_spoc_number[$i]) ? $outlet_spoc_number[$i] : null,
                    'phone' => isset($phone[$i]) ? $phone[$i] : null,
                    'gst' => isset($gst[$i]) ? $gst[$i] : null,
                    'fda_license_number' => isset($fda_license_number[$i]) ? $fda_license_number[$i] : null,
                    'issuedate' => isset($issuedate[$i]) ? $issuedate[$i] : null,
                    'expirydate' => isset($expirydate[$i]) ? $expirydate[$i] : null,
                    'pincode' => isset($pincode[$i]) ? $pincode[$i] : null,
                    'billing_address' => isset($billing_address[$i]) ? $billing_address[$i] : null,
                    'delivery_address' => isset($delivery_address[$i]) ? $delivery_address[$i] : null,
                    'outlet_email' => isset($outlet_email[$i]) ? $outlet_email[$i] : null,
                    'note' => isset($note[$i]) ? $note[$i] : null,

                ];
            }
        }


        return $maindata;
    }

    public function update_customers(Request $request, $email_id)
    {
        $userDetails = CustomerDetail::where('email', '=', $email_id)->first();

        $request->validate([
            'buisness_name' => 'required',
            'company_name' => 'required',
            'relationship_manager' => 'required',
            'email' => 'required',
            'spoc_number' => 'required',
            'customer_city' => 'required'
        ]);

        // Update user details in userdetails table
        // Map request data to model fields
        $userDetails->brand_name = $request->brand_name;
        $userDetails->buisness_name = $request->buisness_name;
        $userDetails->company_name = $request->company_name;
        $userDetails->relationship_manager = $request->relationship_manager;
        $userDetails->email = $request->email;
        $userDetails->spoc_name = $request->spoc_name;
        $userDetails->spoc_number = $request->spoc_number;
        $userDetails->credit_amount = $request->credit_amount;
        $userDetails->credit_period = $request->credit_period;
        $userDetails->customer_city = $request->customer_city;
        $properties = [
            'issuedate',
            'expirydate',
            'outlet_name',
            'outlet_spoc',
            'outlet_spoc_number',
            'phone',
            'city',
            'state',
            'gst',
            'fda_license_number',
            'pincode',
            'billing_address',
            'delivery_address',
            'outlet_email',
            'note',
        ];

        foreach ($properties as $property) {
            if (isset($request->$property)) {
                if (is_array($request->$property)) {
                    $userDetails->$property = implode(',', $request->$property);
                } else {
                    $userDetails->$property = $request->$property;
                }
            } else {
                $userDetails->$property = '';
            }
        }


        if ($request->hasfile('document')) {
            $files = $request->file('document'); // Get an array of uploaded files
            $filenames = []; // Initialize an array to store the filenames

            foreach ($files as $file) {
                // Process each file individually
                $extension = $file->getClientOriginalExtension(); // Get the file extension
                $filename = time() . '.' . $extension; // Generate a unique filename
                $file->move('image/', $filename);
                $filenames[] = $filename;
            }
            $filenamesString = implode(',', $filenames);
            $userDetails->document = $filenamesString;
        }
        if ($request->hasfile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userDetails->photo = $filename;
        }

        $userDetails->update();

        // Update name in users table
        $users = User::where('email', $email_id)->first();
        $users->name = $request->buisness_name;
        $users->email = $request->email;
        $users->update();

        return redirect('superadmin/customers')->with('status', 'Customer Updated Successfully.');
    }


    public function discount_customers(Request $request, $email_id)
    {
        if ($request->isMethod('post')) {
            $user = CustomerDetail::where('email', '=', $email_id)->first();
            $user->product_id = implode(',', $request->product_id);
            $user->discount_price = implode(',', $request->discount_price);
            $user->order_quantity = implode(',', $request->order_quantity);
            $user->save();

            return redirect('superadmin/customers')->with('status', 'Discount Updated Successfully.');
        } else {
            $customer = CustomerDetail::where('email', $email_id)->first();
            $products = Product::all();
            $layout = 3;
            return view('superadmin.customers')->with(compact('layout', 'customer', 'products'));
        }
    }


    public function delete_customers(Request $request, $email)
    {
        CustomerDetail::where('email', $email)->delete();
        User::where('email', $email)->delete();
        return redirect('superadmin/customers')->with('delete', 'Customer Deleted.');
    }

    public function get_outlets_with_discount(Request $request)
    {

        if ($request->customer == '' || $request->outlet == '') {

            $customers = CustomerDetail::where('email', $request->customer)->first();
            if (!$customers) {
                return response()->json(['message' => 'Customer not found'], 404);
            }

            $data = '<option>Select Outlet</option>';
            $outlet_names = explode(',', $customers->outlet_name);

            for ($i = 0; $i < count($outlet_names); $i++) {
                $data .= '
                 <option value="' . $outlet_names[$i] . '">' . $outlet_names[$i] . '</option>
                 ';
            }
            $delivery_charges = '';
            $found = false;
            $foundIndex = null;
            //Retrieve cart items for the customer
            $orderQuantities = null;
            $discountPrices = null;
            $product_id = null;

            $orderQuantitiesArray = explode(',', $customers->order_quantity);
            $discountPricesArray = explode(',', $customers->discount_price);
            $product_ids = explode(',', $customers->product_id);

            $html = '';
            $total = null;
            $sub_total = 0;
            if ($customers->product_id == null) {


                $carts = Cart::join('products', 'products.product_id', '=', 'carts.product_id')->where('carts.email', auth()->user()->email)->get();

                if ($carts) {
                    foreach ($carts as $key => $value) {
                        $subtotal1[] = intval($value->jsp) * intval($value->min_order_quantity);
                        $sub_total += $subtotal1[$key];

                    }
                    
                        if ($sub_total < 1000) {
                            $delivery_charges = 150;
                            $total = $sub_total + 150;
                        } else {
                            $delivery_charges = 0;
                            $total = $sub_total + 0;
                        }
                    foreach ($carts as $key => $value) {
                        // $subtotal1[] = intval($value->price) * intval($value->min_order_quantity);
                        $html .= '<tr id="hide' . $value->product_id . '">
     <input type="hidden" class="product_id"
         id="deleteid' . $value->product_id . '"
         value="' .  $value->product_id  . '">
     
     <td>
         <a href="#"><img src="' . url('image/' . $value->image) . '" alt="#" style="height:40px; width:40px;" ></a>
     </td>
                 <td >
                      ' . $value->product_name . '
                 </td>
                 <td
                     data-price="' . $value->jsp . '">
                     ' .  $value->jsp  . '
                 </td> 
                <input type="hidden" class="price price' . $value->product_id . '" value="' .  $value->jsp . '">
                <input type="hidden"  class="mrp" value="'. $value->price .'">
                 <td >
                        <div class="cart-plus-minus cart-plus-minus' . $value->product_id . '" onclick="changeMoq(\'' . $value->product_id . '\')">
                     <span class="minus minus' . $value->product_id . '">-</span>
                     <input type="text"
                         value="' . $value->min_order_quantity . '"
                         name="qtybutton"
                         class="cart-plus-minus-box  moq cart-plus-minus-box' . $value->product_id . ' moqs' . $value->product_id . '">
                     <span class="plus plus' . $value->product_id . '">+</span>
                 </div>
                 </td>
                 <td class="cart-product-sub cart-product-subtotal' . $value->product_id . '">
                 ' .  intval($value->jsp) * intval($value->min_order_quantity) . '
                 </td>
                 <td class="cart-product-remove"
                     id="deletecart' . $value->product_id . '"onclick="deleteProduct(\'' . $value->product_id . '\')">x
                 </td>
                 </tr> ';
                    }
                    return response()->json([
                        'delivery_charge' => $delivery_charges,
                        'data' => $data,
                        'order_quantities' => $orderQuantities,
                        'discount_prices' => $discountPrices,
                        'product_id' => $product_id,
                        'html' => $html,
                        'total' => $total,
                        'sub_total' => $sub_total,

                    ]);
                }
            } else {
                $html1 = '';
                $productsCount = Product::count();
                $totalcarts = Cart::where('email', auth()->user()->email)->count();

                for ($i = 0; $i <= $productsCount; $i++) {

                    $carts = Cart::join('products', 'products.product_id', '=', 'carts.product_id')
                        ->where('carts.product_id', isset($product_ids[$i]) ? $product_ids[$i] : '') // isset check
                        ->where('carts.email', auth()->user()->email)
                        ->first();


                    // here apply if condition for getting  only those products which are in the carts 

                    if ($carts) {
                        $product_id[] = trim(isset($product_ids[$i]) ? $product_ids[$i] : '');
                        $orderQuantities[] = trim(isset($orderQuantitiesArray[$i]) ? $orderQuantitiesArray[$i] : '');
                        $discountPrices[] = trim(isset($discountPricesArray[$i]) ? $discountPricesArray[$i] : '');
                        $products[] = Product::where('product_id', isset($product_ids[$i]) ? $product_ids[$i] : '')->first();
                    }
                }
                for ($k = 0; $k < $totalcarts; $k++) {
                    if (isset($product_id[$k])) {
                        $html1 .= '<tr id="hide' . $product_id[$k] . '">
                        <input type="hidden" class="product_id"
                     id="deleteid' . $product_id[$k] . '"
                        value="' . $product_id[$k] . '">
                        
                        <td>
                            <a href="#"><img src="' . url('image/' . $products[$k]->image) . '" alt="#"   style="height:40px; width:40px;" ></a>
                        </td>
                        <td>
                            ' . $products[$k]->product_name . '
                        </td>
                        <td data-price="' . ($discountPrices[$k] != '' ? $discountPrices[$k] : $products[$k]->jsp) . '">
                            ' . ($discountPrices[$k] != null ? $discountPrices[$k] : $products[$k]->jsp) . '
                        </td>
 
                        <input type="hidden" class="price price' . $product_id[$k] . '" value="' . ($discountPrices[$k] != '' ? $discountPrices[$k] : $products[$k]->jsp) . '">
                        <td >
                        <input type="hidden"  class="mrp" value="'. $products[$k]->price .'">

                        <div class="cart-plus-minus moq cart-plus-minus' . $product_id[$k] . '"  onclick="changeMoq(\'' . $product_id[$k] . '\')">
                                <span class="minus minus' . $product_id[$k] . '">-</span>
                                <input type="text" value="' . ($orderQuantities[$k] != null ? $orderQuantities[$k] : $products[$k]->min_order_quantity) . '" name="qtybutton" class="cart-plus-minus-box cart-plus-minus-box' . $product_id[$k] . ' moqs' . $product_id[$k] . '">
                                <span class="plus plus' . $product_id[$k] . '">+</span>
                            </div>
                         
                            </td>                    
                        <td class="cart-product-sub cart-product-subtotal' . $product_id[$k] . '">
                            ' . ($discountPrices[$k] != null ? intval($discountPrices[$k]) : intval($products[$k]->jsp)) * ($orderQuantities[$k] != null ? intval($orderQuantities[$k]) : intval($products[$k]->min_order_quantity)) . '
                        </td>
                        <td class="cart-product-remove"
                            id="deletecart' . $product_id[$k] . '" onclick="deleteProduct(\'' . $product_id[$k] . '\')">x
                        </td>
                    </tr>';
                    }
                }

                for ($j = 0; $j < $totalcarts; $j++) {
                
                        $subtotal[] = (
                            isset($discountPrices[$j]) && $discountPrices[$j] != null
                            ? intval($discountPrices[$j])
                            : intval($products[$j]->jsp)
                        ) * (
                            isset($orderQuantities[$j]) && $orderQuantities[$j] != null
                            ? intval($orderQuantities[$j])
                            : intval($products[$j]->min_order_quantity)
                        );

                        $total += isset($subtotal[$j]) ? $subtotal[$j] : 0;
                        $sub_total += isset($subtotal[$j]) ? $subtotal[$j] : 0;

                        if ($total < 1000) {
                            $delivery_charges = 150;
                            $total = $total + $delivery_charges;
                        } else {
                            $delivery_charges = 0;
                        }
                    }
                
                return response()->json([
                    'data' => $data,
                    'delivery_charge' => $delivery_charges,
                    'order_quantities' => $orderQuantities,
                    'discount_prices' => $discountPrices,
                    'product_id' => $product_id,
                    'total' => $total,
                    'sub_total' => $sub_total,
                    'html' => $html1,

                ]);
            }
        } elseif ($request->outlet) {

            $customers = CustomerDetail::where('email', $request->customer)->first();

            if ($customers) {
                $outletsArray = explode(',', $customers->outlet_name);
                $requestOutlet = $request->outlet;

                $outletsArray = array_map('trim', $outletsArray);
                $found = false;
                $foundIndex = '';

                foreach ($outletsArray as $index => $value) {
                    if ($value === $requestOutlet) {
                        $found = true;
                        $foundIndex = $index;
                        break;
                    }
                }

                if ($found) {
                    $outletsArray = explode(',', $customers->delivery_address);
                    foreach ($outletsArray as $key => $value) {
                        if ($value[$key] === $foundIndex) {
                            return $value;
                        }
                    }
                } else {
                    echo "Value not found in the array";
                }

                if ($found) {
                    $delivery_address = explode(',', $customers->delivery_address);
                    $billing_address = explode(',', $customers->billing_address);
                    $phone = explode(',', $customers->phone);
                    $outlet_email = explode(',', $customers->outlet_email);
                    $outlet_name = explode(',', $customers->outlet_name);
                    $city = explode(',', $customers->city);
                    $state = explode(',', $customers->state);
                    $outlet_spoc = explode(',', $customers->outlet_spoc);
                    $outlet_spoc_number = explode(',', $customers->outlet_spoc_number);
                    $relationship_manager = explode(',', $customers->relationship_manager);
                    $credit_period = explode(',', $customers->credit_period);
                    $email = explode(',', $customers->email);
                    $pincode = explode(',', $customers->pincode);
                    $gst = explode(',', $customers->gst);




                    if (array_key_exists($foundIndex, $delivery_address)) {
                        $deliveryAddress = trim($delivery_address[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $billing_address)) {
                        $billingAddress = trim($billing_address[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $outlet_name)) {
                        $outlet_name = trim($outlet_name[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $phone)) {
                        $phoneNumber = trim($phone[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $outlet_email)) {
                        $outletEmail = trim($outlet_email[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $state)) {
                        $state = trim($state[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $city)) {
                        $city = trim($city[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $outlet_spoc)) {
                        $outlet_spoc = trim($outlet_spoc[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $outlet_spoc_number)) {
                        $outlet_spoc_number = trim($outlet_spoc_number[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $relationship_manager)) {
                        $relationship_manager = trim($relationship_manager[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $credit_period)) {
                        $credit_period = trim($credit_period[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $email)) {
                        $email = trim($email[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $pincode)) {
                        $pincode = trim($pincode[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $gst)) {
                        $gst = trim($gst[$foundIndex]);
                    }
                    return response()->json(['pincode' => $pincode, 'outlet_name' => $outlet_name, 'delivery_address' => $deliveryAddress, 'phone' => $phoneNumber, 'email' => $outletEmail, 'state' => $state, 'city' => $city, 'relationship_manager' => $relationship_manager, 'outlet_spoc_number' => $outlet_spoc_number, 'outlet_spoc' => $outlet_spoc, 'gst' => $gst, 'billing_address' => $billingAddress]);
                } else {
                    echo "Value not found in the array";
                }
            } else {
                // Handle the case where no customer with the specified email was found
                echo "Customer not found";
            }
        } else {
            $data = '<option value=""></option>';
            return response()->json(['data' => $data]);
        }
    }




  public function create_order(Request $request)
    {

        $orderId = rand();
        $credit_amount = 0;
        $latestOrder = Order::where('email', $request->customer_email)->where('payment_status', '0')->latest()->first();
        $customer = CustomerDetail::where('email', $request->customer_email)->first();
        $credit_amount = Order::where('email', $request->customer_email)->where('payment_status', '0')->sum('total_price');

        $warehouse = UserDetail::join('users', 'users.email', '=', 'userdetails.email')
        ->where('users.roles', 'warehouse')
        ->where('userdetails.city', $request->city)
        ->first();

        if(!$warehouse){
            return response()->json(['error' => 'Warehouse Is Not Located In The '. $request->city. ' City']);

        }
    

        $available_credit_amount = $customer->credit_amount - $credit_amount;

        if ($credit_amount > $customer->credit_amount || $request->totalprice > $available_credit_amount) {
            return response()->json(['error' => 'This Customer Reached Their Credit Amount. Upto '  . $available_credit_amount . ' INR Booking we Allowed']);
        }

        if ($latestOrder) {
            $created_at = $latestOrder->created_at;
            $today_date = now();
            $countLastOrderDay = $today_date->diffInDays($created_at);
            if ($countLastOrderDay >= $customer->credit_period) {
                return response()->json(['error' => 'This Customer Reached Their Credit Period!! Please Clear Dew bills']);
            }
        }


        // foreach ($request->product_id as $key => $productId) {
        //     $productAvailable = ProductAvailability::where('product_id', $productId)->where('city', $request->city)->first();
        //     if (!$productAvailable) {
        //         $product = Product::where('product_id', $productId)->first();
        //         return response()->json([
        //             'error' => 'The product ' . $product->product_name . ' Not Available In '. $request->city.' City ' 
        //         ]);
        //     }
        // }

        foreach ($request->product_id as $key => $productId) {

            $product_name=Product::where('product_id',$productId)->pluck('product_name')->first();

            $product = Stock::join('products', 'products.product_id', '=', 'stocks.product_id')
                ->where('stocks.warehouse', $warehouse->email)
                ->where('stocks.product_id', $productId)->first();

                if(!$product){
                    return response()->json(['error' => 'This '.$product_name.' currently is not available in the '.$warehouse->name.' warehouse']);

                }

            $product = Stock::join('products', 'products.product_id', '=', 'stocks.product_id')
                ->where('stocks.warehouse', $warehouse->email)
                ->where('stocks.product_id', $productId)->first();

            if ($product && $product->stocks >= $request->moq[$key]) {
                $stocks=Stock::where('warehouse',$warehouse->email)->where('product_id',$productId)->first();
                $stocks->stocks -= $request->moq[$key];
                $stocks->sold += $request->moq[$key];
                $stocks->save();
            } else {
                return response()->json([
              'error' => 'Insufficient stock for ' . isset($product->product_name)?$product->product_name:$productId . '!! Available stocks: ' . max($product->stocks, 0)
                ]);
            }
        }

        $lastordersno = Order::get('billno')->last();
        $billno = 000001;
        if($lastordersno == null || $lastordersno == '')
        {
            $billno ;
        }
        else{
            $billno = str_pad($lastordersno->no+1,6, "0", STR_PAD_LEFT);
        }


        $orders = new Order([
            'order_id' => $orderId,
            'product_id' => implode(',', $request->product_id),
            'moq' => implode(',', $request->moq),
            'price' => implode(',', $request->price),
            'outlet_name' => $request->outlet_name,
            'total_price' => $request->totalprice,
            'delivery_address' => $request->delivery_address,
            'billing_address' => $request->billing_address,
            'phone' => $request->phone,
            'state' => $request->state,
            'city' => $request->city,
            'spoc_name' => $request->spoc_name,
            'spoc_number' => $request->spoc_number,
            'relationship_manager' => $request->relationship_manager,
            'status' => 'Received',
            'email' => $request->customer_email,
            'pincode' => $request->pincode,
            'gst' => $request->gst,
            'billno' => 'A'.$billno,
            'MRP' => implode(',', $request->mrp)
        ]);


        $orders->save();
        
         foreach ($request->product_id as $key => $productId) {

            $delete_product=Cart::where('product_id',$productId)->where('email',auth()->user()->email)->delete();
         
            }
        $url = url('superadmin/orders');
        return response()->json(['url' => $url]);
    }

    //==============================End_Customers_Section===========================

    //===========================Users_Section================================

    public function users()
    {
        $layout = 0;
        $users = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '!=', 'customer')->orderBy('userdetails.created_at', 'DESC')->get();

        return view('superadmin/users')->with(compact('layout', 'users'));
    }

    public function create_users()
    {
        $layout = 1;
        $territory = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'territory')->get();
        $relationship = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'relationship')->get();
        $runner = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'runner')->get();
        $warehouse = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
           // ->where('userdetails.warehouse_booked', '0')
            ->where('users.roles', '=', 'warehouse')->get();


        $vehicle = Vehicle::get();

        return view('superadmin/users')->with(compact('territory', 'runner', 'vehicle', 'warehouse', 'layout', 'relationship'));
    }


    public function save_users(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'roles' => 'required',
            'email' => 'required|unique:userdetails|unique:users',
            'password' => 'required',
        ]);
        $userDetails = new UserDetail();
        $userDetails->name = $request->input('name');
        $userDetails->warename = $request->input('warename');
        $userDetails->warehouse_inventory = $request->input('warehouse_inventory');


        $userDetails->email = $request->input('email');
        $userDetails->phone = $request->input('phone');
        $userDetails->workaddress = $request->input('workaddress');
        $userDetails->homeaddress = $request->input('homeaddress');
        $userDetails->pincode = $request->input('pincode');
        $userDetails->city = $request->input('city');
        // $userDetails->spoc_name = $request->input('spoc_name');
        // $userDetails->spoc_number = $request->input('spoc_number');
        $userDetails->showpassword = $request->input('password');
        $userDetails->warehouse = $request->input('warehouse');
        $userDetails->vehicle = $request->input('vehicle');
        $userDetails->runner = $request->input('runner');
        $userDetails->note = $request->input('note');
        $userDetails->territory_manager = $request->input('territory_manager');
        $userDetails->relationship_manager = $request->input('relationship_manager');
        $userDetails->warehouse_inventory = $request->input('warehouse_inventory');
       
        $userDetails->empid = $request->input('empid');
        $userDetails->status = 'Approved';


        if ($request->hasfile('addressproof')) {
            $file = $request->file('addressproof');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userDetails->addressproof = $filename;
        }
        if ($request->hasfile('document')) {
            $file = $request->file('document');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userDetails->document = $filename;
        }
        if ($request->hasfile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userDetails->photo = $filename;
        }

        $userDetails->save();

        $warehouse = UserDetail::where('email', $request->input('warehouse_inventory'))->first();
        if ($warehouse) {
            $warehouse->warehouse_booked = 1;
            $warehouse->update();
        }

        $user = new User();
        $user->roles = $request->input('roles');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Mail::send('email', ['email' => $request->email, 'password' => $request->password], function (Message $message) use ($request) {
            $message->to($request->email)
                ->subject('Welcome to our website');
        });
        return redirect('superadmin/users')->with('status', 'User added successfully.');
    }
                                                                  

    public function edit_users($email_id)
    {
        $user = UserDetail::join('users', 'users.email', '=', 'userdetails.email')->where('userdetails.email', $email_id)->first();
        $products = Product::all();
        $territory = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'territory')->get();
        $relationship = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'relationship')->get();
        $runner = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'runner')->get();
        $warehouse = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'warehouse')->get();
        $vehicle = Vehicle::get();
        $layout = 2;
        return view('superadmin/users')->with(compact('layout', 'user', 'products', 'territory', 'runner', 'vehicle', 'warehouse', 'relationship'));
    }


    public function update_users(Request $request, $email)
    {
      
        $userdetails = UserDetail::where('email', '=', $email)->first();
        $user = User::where('email', '=', $email)->first();


        // Update user details in userdetails table
        $userdetails->territory_manager = $request->territory_manager;
        $userdetails->relationship_manager = $request->relationship_manager;
        $userdetails->empid = $request->empid;
        $userdetails->name = $request->name;
        $userdetails->phone = $request->phone;
        $userdetails->city = $request->city;
        $userdetails->workaddress = $request->workaddress;
        $userdetails->homeaddress = $request->homeaddress;
        $userdetails->pincode = $request->pincode;
        $userdetails->warehouse = $request->warehouse;
        $userdetails->spoc_name = $request->spoc_name;
        $userdetails->spoc_number = $request->spoc_number;
        $userdetails->vehicle = $request->vehicle;
        $userdetails->runner = $request->runner;
        $userdetails->note = $request->note;
        $userdetails->showpassword = $request->input('password');

        if ($request->hasfile('addressproof')) {
            $file = $request->file('addressproof');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userdetails->addressproof = $filename;
        }
        if ($request->hasfile('document')) {
            $file = $request->file('document');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userdetails->document = $filename;
        }
        if ($request->hasfile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userdetails->photo = $filename;
        }

        $userdetails->update();

        // Update name in users table
        $user->roles = $request->roles;
        $user->name = $request->name;
        $user->password = Hash::make($request->input('password'));
        $user->update();


        return redirect('superadmin/users')->with('status', 'User Updated Successfully.');
    }

    public function warehouse()
    {
        $stocks2 = Product::join('stocks', 'products.product_id', '=', 'stocks.product_id')
            ->distinct('products.product_id')
            ->get();
        $stocks = $stocks2->unique('product_id');
        $stocks->values()->all();
        //dd($stocks);
        $warehouse = User::where('roles', 'warehouse')->get();
        $products = Product::all();
        $categories = Category::all();
        $batch_id = stock::get()->last();
        $layout = 0;
        return view('superadmin.warehouse')->with(compact('products','stocks', 'layout', 'warehouse','stocks2','categories'));

    }

    public function filter_warehouse(Request $request)
    {
        $html = '';

        if ($request->warehouse_email) {
            $stocks2 = Product::join('stocks', 'products.product_id', '=', 'stocks.product_id')->where('stocks.warehouse', $request->warehouse_email)->get();
            $stocks = $stocks2->unique('product_id');
            $stocks->values()->all();
        } elseif ($request->product_id) {
            $stocks2 = Stock::join('products', 'products.product_id', '=', 'stocks.product_id')->where('stocks.product_id', $request->product_id)->get();
            $stocks = $stocks2->unique('product_id');
            $stocks->values()->all();
        } elseif ($request->warehouse_email && $request->product_id) {
            $stocks = Stock::join('products', 'products.product_id', '=', 'stocks.product_id')->where('stocks.warehouse', $request->warehouse_email)->where('product_id', $request->product_id)->get();
        } else {
            $stocks = Stock::all();
        }
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
            $html .= '<tr rowspan="2">
                <td class="mt-2 mr-2">' . $key + 1 . '</td>
                <td>' . $item->product_id . '</td>
                <td>' . date('d-m-Y', strtotime($item->created_at)) . '</td>
                <td>' . $item->product_name . '</td>
                <td>' . $item->categories . '</td>

                <td>' . $totalsold. '</td>
                <td>' . $totalstock . '</td>
                <td><img src="' . url('image/' . $item->image) . '"
                        style="width:50px;height:50px;border-radius:50%"
                        alt=""></td>
                <td>'.$percentagedata.'</td>

                <td>
                    <a
                        href="' . url('superadmin/inventory-details/' . $item->id) . '"><button
                            class="btn btn-primary">Details</button></a>
                </td>

                </tr>';
                        }



        return response()->json(['html' => $html]);
    }
    public function filter_product_id(Request $request)
    {
      
        $html = '';

        if ($request->category) {
            $stocks2 = Stock::join('products', 'products.product_id', '=', 'stocks.product_id')->where('products.categories', $request->category)->get();
            $stocks = $stocks2->unique('product_id');
            $stocks->values()->all();
        } elseif ($request->warehouse_email && $request->product_id) {
            $stocks = Stock::join('products', 'products.product_id', '=', 'stocks.product_id')->where('stocks.warehouse', $request->warehouse_email)->where('product_id', $request->product_id)->get();
        } else {
            $stocks = Stock::all();
        }
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
            $html .= '<tr rowspan="2">
                <td class="mt-2 mr-2">' . $key + 1 . '</td>
                <td>' . $item->product_id . '</td>
                <td>' . date('d-m-Y', strtotime($item->created_at)) . '</td>
                <td>' . $item->product_name . '</td>
                <td>' . $item->categories . '</td>
                <td>' . $totalsold. '</td>
                <td>' . $totalstock . '</td>
                <td><img src="' . url('image/' . $item->image) . '"
                        style="width:50px;height:50px;border-radius:50%"
                        alt=""></td>
                <td>'.$percentagedata.'</td>

                <td>
                    <a
                        href="' . url('superadmin/inventory-details/' . $item->product_id) . '"><button
                            class="btn btn-primary">Details</button></a>
                </td>

                </tr>';
                        }



        return response()->json(['html' => $html]);
    }


    public function inventory_details($id)
    {

        $product_id = Stock::where('id', $id)->first();
        $stocks = Stock::join('products', 'products.product_id', '=', 'stocks.product_id')
            ->where('stocks.product_id', $product_id->product_id)
            ->get();

        $categories = Category::all();
        $batch_id = stock::get()->last();
        //dd( $stocks );
        $layout = 1;
        return view('superadmin.warehouse')->with(compact('stocks', 'layout', 'categories'));
    }

    public function delete_users(Request $request, $email)
    {
        UserDetail::where('email', $email)->delete();
        User::where('email', $email)->delete();
        return redirect('superadmin/users')->with('delete', 'User Deleted.');
    }

    public function filterroles(Request $request)
    {

        $data = '';

        $roles = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', $request->roles)->get();

        foreach ($roles as $key => $value) {

            $Role = '';

            if ($value->roles == 'warehouse')
                $Role = 'Warehouse';
            elseif ($value->roles == 'admin')
                $Role = 'Admin';
            elseif ($value->roles == 'runner')
                $Role = 'Runner';
            elseif ($value->roles == 'relationship')
                $Role = 'Relationship Manager';
            elseif ($value->roles == 'customer')
                $Role = 'Customer';
            elseif ($value->roles == 'territory')
                $Role = 'Territory Manager';
            elseif ($value->roles == 'inventory')
                $Role = 'Inventory';
            elseif ($value->roles == 'hr')
                $Role = 'HR';
            $index = $key + 1;

            $data .= '
           <tr> 
            <td>' . $index . '</td>
            <td>' . date('d-m-Y', strtotime($value->created_at)) . '</td>
            <td>' . $value->name . '</td>
            <td>' . $Role . '</td>
            <td>' . $value->phone . '</td>
            <td>' . $value->email . '</td>
            <td>' . $value->showpassword . '</td>
         
       
            <td>
                <a
                href="' . url("superadmin/edit-users/" . $value->email) . '">
                <button type="button"
                    class="btn btn-primary waves-effect waves-light">Edit</button>
                </a>
                
                <a
                    href="' . url("superadmin/delete-users/" . $value->email) . '">
                    <button type="button" class="btn btn-danger waves-effect waves-light">Delete</button>
                </a>
            </td>
            </tr>';
        }


        return response()->json(['data' => $data]);
    }
    //=================================End_users_Section==========================


    // ========================Category_Section==============================

    public function category()
    {
        $layout = 0;
        $category = Category::orderBy('created_at', 'DESC')->get();
        return view('superadmin.categories')->with(compact('layout', 'category'));
    }

    public function create_category(Request $request)
    {
        $layout = 1;
        return view('superadmin.categories')->with(compact('layout'));
    }

    public function save_category(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $category = new Category;
        $category->category_name = $request['category_name'];
        $category->sub_category = $request['sub_category'];
        $category->sub_sub_category = $request['sub_sub_category'];
        $category->access = $request['access'];

        $category->save();
        $message = 'Category added successfully.';
        session()->flash('addcategory', $message);
        // Redirect back to the previous page with the success message
        return redirect('superadmin/category')->with('addcategory', $message);
    }


    public function edit_category($id)
    {
        $layout = 2;
        $category = Category::find($id);
        return view('superadmin.categories')->with(compact('layout', 'category'));
    }


    public function update_category(Request $request, $id)
    {
        $category = Category::find($id);

        $request->validate([
            'category_name' => 'required',
        ]);

        $category->category_name = $request['category_name'];
        $category->sub_category = $request['sub_category'];
        $category->sub_sub_category = $request['sub_sub_category'];
        $category->access = $request['access'];

        $category->update();
        $message = 'Category updated successfully.';
        session()->flash('updatecategory', $message);
        // Redirect back to the previous page with the success message
        return redirect('superadmin/category')->with('updatecategory', $message);
    }

    public function delete_category(Request $request, $id)
    {
        $category = Category::destroy($id);
        $message = 'Category deleted successfully.';
        session()->flash('deletecategory', $message);
        // Redirect back to the previous page with the success message
        return redirect('superadmin/category')->with('deletecategory', $message);
    }

    // ===========================End_Category_Section===========================



    public function checkFdaLicenceExpiry()
    {
        $customers = CustomerDetail::all();
        $expiredOutlets = [];
        $currentDate = now()->format('Y-m-d');
        $html = '';
        $count = 0;
    
        foreach ($customers as $customer) {
            $fdaExpiryDates = explode(',', $customer->expirydate);
            $outletNames = explode(',', $customer->outlet_name);
    
            foreach ($outletNames as $key => $outletName) {
                $expiryDate = isset($fdaExpiryDates[$key]) ? $fdaExpiryDates[$key] : $currentDate;
    
                if ($currentDate >= $expiryDate) {
                    $count++;
                    $expiredOutlets[] = [
                        'outlet_name' => $outletName,
                        'expirydate' => isset($fdaExpiryDates[$key]) ? $fdaExpiryDates[$key] : $currentDate,
                        'customer_name' => $customer->company_name,
                    ];
                }
            }
        }
    
        // Sort the expiredOutlets array based on expirydate in descending order
        usort($expiredOutlets, function ($a, $b) {
            return strtotime($b['expirydate']) - strtotime($a['expirydate']);
        });
    
        foreach ($expiredOutlets as $key => $value) {
            $html .= '<tr>
                <td class="mt-2 mr-2">' . ($key + 1) . '</td>
                <td>' . $value['outlet_name'] . '</td>
                <td>' . $value['customer_name'] . '</td>
                <td>' . ($value['expirydate'] != '' ? $value['expirydate'] : '-') . '</td>
            </tr>';
        }
    
        $response = ['count' => $count, 'data' => $html];
    
        return response()->json($response);
    }
    



    public function orders()
    {
        $layout = 0;
        $orders = Order::orderBy('created_at', 'DESC')->get();
        $users = [];

        // First, retrieve the relationship_manager for each order
        $relationshipManagers = UserDetail::whereIn('email', $orders->pluck('relationship_manager'))->get();
        // Then, retrieve the territory_manager for each relationship_manager

        foreach ($relationshipManagers as $manager) {
            $territoryManager = UserDetail::where('email', $manager->territory_manager)->first();
            if ($territoryManager) {
                $users[] = $territoryManager;
            }
        }
        return view('superadmin.orders')->with(compact('layout', 'orders', 'users'));
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

            $index = $key + 1;
            $delivared_date = NULL;
        if($value['status']== 'Delivered'){
            $delivared_date = date('d-m-Y',strtotime($value->updated_at));
            }
        else{
            $delivared_date  = '-';
        }
            $data .= '
           <tr> 
            <td>' . $index . '</td>
            <td>' . date('d-m-Y', strtotime($value->created_at)) . '</td>
            <td>' .$delivared_date. '</td>
            <td>' . $value->spoc_name . '</td>
            
            <td>' . $value->delivery_address . '</td>
            <td>' . $diff_days . ' Days' . '</td>
            <td>
                <a
                    href="' . url("superadmin/orders-details/" . $value->id) . '">
                    <button type="button"
                        class="btn btn-primary waves-effect waves-light">
                        <i class="fas fa-eye"></i></button>
                </a>
            </td>
            <td>
                <a
                    href="' . url("superadmin/invoice/" . $value->id) . '">
                    <button type="button"
                        class="btn btn-success waves-effect waves-light">
                        <i class="fas fa-file-invoice"></i></button>
                </a>
            </td>
            <td>
                <button type="button"
                    class="btn btn-outline-success waves-effect waves-light">' . $value->status . '</button>
            </td>
            
            </tr>';
        }


        return response()->json(['data' => $data]);
    }

    public function fetch_products(Request $request)
    {
        $products = Product::where('categories', '=', $request->category)->get();
        $options = '';
        foreach ($products as $item) {
            $options .= "<option value=" . $item['product_id'] . ">" . $item->product_name . "</option>";
        }
        return $options;
    }

    public function fetch_products_details(Request $request)
    {

        $product_details = Product::where('product_id', '=', $request->product_id)->first();
        return $product_details;
    }



    public function fetch_user_details(Request $request)
    {
        $user_details = UserDetail::where('phone', '=', $request->phone)->get();
        return response()->json($user_details);
    }



    public function edit_orders(Request $request, $id)
    {

        if ($request->isMethod('get')) {
            $layout = 2;
            $odrer = Order::find($id);
            return view('superadmin.orders')->with(compact('layout', 'order'));
        }
    }

    public function delete_orders($id)
    {
        Order::destroy($id);
        return redirect('superadmin/orders')->with('delete', 'Order Deleted');
    }


    public function orders_details($id)
    {

        $layout = 3;
        $order_details = Order::where('id', $id)->first();

        $rm = UserDetail::where('email', $order_details['relationship_manager'])->first();
        
        $territory=UserDetail::where('email', $rm['territory_manager'])->first();
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
        return view('superadmin.orders')->with(compact('layout', 'order_details', 'product_details', 'territory'));
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
        return view('superadmin.invoice')->with(compact('order_details','productscheck', 'product_details', 'territory', 'randomNumber', 'id'));
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
        $randomNumber = random_int(100000, 999999);
        $productscheck = Product::get();
        $pdf = PDF::loadView('superadmin.invoice', ['order_details' => $order_details, 'product_details' => $product_details, 'territory' => $territory, 'randomNumber' => $randomNumber, 'id' => $id,'productscheck'=>$productscheck]);
        return $pdf->download('Invoice_JC' . date('Y-') . '-' . $randomNumber . '.pdf');
    }


    public function product_availability()
    {

        $products_availability = ProductAvailability::all();
        $products = Product::all();
        $layout = 0;
        return view('superadmin.products_availability')->with(compact('layout', 'products', 'products_availability'));
    }

    public function add_product_availability(Request $request)
    {


        if ($request->isMethod('post')) {
            //dd($request['city']);
            $city = $request['city'];
            $products_availability = new ProductAvailability();
            for ($i = 0; $i < count($city); $i++) {
                $products_availability->product_id = $request['product_id'];
                $products_availability->city = $city[$i];
                $products_availability->save();
            }

            return redirect('superadmin/product-availability');
        } else {
            $layout = 1;
            $products_availability = ProductAvailability::all();
            $products = Product::all();
            return view('superadmin.products_availability')->with(compact('layout', 'products', 'products_availability'));
        }
    }

    public function edit_product_availability(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $products_availability = ProductAvailability::find($id);
            $products_availability->product_id = $request['product_id'];
            $products_availability->city = $request['city'];
            $products_availability->save();
            return redirect('superadmin/product-availability');
        } else {
            $layout = 2;
            $products_availability = ProductAvailability::find($id);
            $products = Product::all();
            return view('superadmin.products_availability')->with(compact('products', 'layout', 'products_availability',));
        }
    }


    public function delete_product_availability($id)
    {
        ProductAvailability::destroy($id);
        return redirect('superadmin/product-availability');
    }

    public function correction()
    {
        $customers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('users.roles', '=', 'customer')->orderBy('customers_details.created_at', 'DESC')->get();
        return view('superadmin.corrections')->with(compact('customers'));
    }

    public function correctiondetails(Request $request, $email)
    {
        $customers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('customers_details.email', '=', $email)->first();
        return view('superadmin.correctionDetails')->with(compact('customers'));
    }


    public function filtercorrection(Request $request)
    {
        // if ($status == 'all') {
        //     $status = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')
        //         ->where('users.roles', '!=', 'superadmin')->get();
        //     return $status;
        // } else {
        //     $status = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')
        //         ->where('customers_details.status', '=', $status)->get()->toArray();
        //     return $status;
        // }
        $data = '';

        $orders = $status = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')
            ->where('customers_details.status', '=', $request->status)->get();

        foreach ($orders as $key => $value) {
            $newstatus = '';
            if ($value->status == 'Approved')
                $newstatus =  '<button type="button" class="btn btn-outline-success waves-effect waves-light">Approved</button>';
            else if ($value->status == 'NotApproved')
                $newstatus = '<button type="button" class="btn btn-outline-danger waves-effect waves-light">Not Approved</button>';
            else if ($value->status == 'Correction')
                $newstatus = '<button type="button" class="btn btn-outline-info waves-effect waves-light">Need Correction</button>';
            $index = $key + 1;
            $data .= '
           <tr> 
            <td>' . $index . '</td>
            <td>' . date('d-m-Y', strtotime($value->created_at)) . '</td>
            <td>' . $value->spoc_name . '</td>
            <td>' . $value->email . '</td>
            <td>
                
                <a href="' . url("superadmin/correctiondetails/" . $value->email) . '">
                    <button type="button" class="btn btn-primary waves-effect waves-light"> <i class="fas fa-eye"></i></button>
                </a>
            </td>
            <td>' . $newstatus . '</td>            
            </tr>';
        }

        return response()->json(['data' => $data]);
    }
    public function filter_city(Request $request)
    {

        $data = '';
        $pincodes = ProductAvailability::where('city', '=', $request->city)->get();
        foreach ($pincodes as $key => $value) {
            $index = $key + 1;
            $data .= '
           <tr> 
            <td>' . $index . '</td>
            <td>' . $value->product_id . '</td>
            <td>' . $value->city . '</td>
       
            <td>
                <a
                href="' . url("superadmin/edit-product-availability/" . $value->id) . '">
                <button type="button"
                    class="btn btn-primary waves-effect waves-light">Edit</button>
                </a>
                <a
                    href="' . url("superadmin/delete-product-availability/" . $value->id) . '">
                    <button type="button" class="btn btn-danger waves-effect waves-light">Delete</button>
                </a>
            </td>        
            </tr>';
        }
        return response()->json(['data' => $data]);
    }

    public function importpincode(Request $request)
    {

        Excel::import(new ProductPincodeImport, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportpincode(Request $request)
    {
        return Excel::download(new ProductPincodeExport, 'Product_pincode.xlsx');
    }


    public function report()
    {

        $orders = Order::where('status', 'Delivered')->orderBy('created_at', 'DESC')->get();
        $customers_details = CustomerDetail::all();
        $product_details = Product::all();

        $avaragesalesyearly = 0;
        $sumoftotalprice = 0;
        foreach ($orders as $order) {
            $sumoftotalprice += $order->total_price;
        }
        $avaragesalesyearly = round($sumoftotalprice / 365, 2);


        $preveousyear = date('Y') - 1;
        $previousesales = Order::where('status', 'Delivered')->whereYear('created_at', '=', $preveousyear)->orderBy('created_at', 'DESC')->get();
        $salesgrowth = 0;
        $previousyeartotalprice = 0;
        foreach ($previousesales as $prisales) {
            $previousyeartotalprice += $prisales->total_price;
        }

        if ($previousyeartotalprice > 0) {
            $salesgrowth = round((($sumoftotalprice - $previousyeartotalprice) / $previousyeartotalprice) * 100, 2);
        }

        $customersdailyaddition = CustomerDetail::whereDate('created_at', Carbon::today())->get()->count();

        $totalcustomers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('users.roles', '=', 'customer')->orderBy('customers_details.created_at', 'DESC')->get()->count();

        $curentmonthcustomer = CustomerDetail::whereMonth('customers_details.created_at', Carbon::now()->month)->join('users', 'customers_details.email', '=', 'users.email')->where('users.roles', '=', 'customer')->orderBy('customers_details.created_at', 'DESC')->get()->count();

        $lastmonthcustomer = CustomerDetail::whereMonth('customers_details.created_at', '=', Carbon::now()->subMonth()->month)->join('users', 'customers_details.email', '=', 'users.email')->where('users.roles', '=', 'customer')->orderBy('customers_details.created_at', 'DESC')->get()->count();
        $growth = round(($curentmonthcustomer - $lastmonthcustomer) / 100, 2);
        //dd($lastmonthcustomer);
        $stocks2 = Stock::all();
        $products = Product::get();
        $proname = [];

        $stocks = $stocks2->unique('product_id');
        $stocks->values()->all();
        foreach ($stocks2 as $pur) {
            foreach ($products as $product) {
                if ($pur->product_id == $product->product_id) {
                    $proname[] = $product->product_name;

                    // Break the loop once the product is found
                }
            }
        }

        $sumofpremonthstock = 1;
        $sumofthismonthstock = 1;

        $premonthstock = StockAnalytic::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get();
        foreach ($premonthstock as $prestock) {
            $sumofpremonthstock += $prestock->stocks;
        }

        $thismonthstock = StockAnalytic::whereMonth('created_at', '=', Carbon::now()->month)->get();
        foreach ($thismonthstock as $thisstock) {
            $sumofthismonthstock += $thisstock->stocks;
        }

        $geowthofstock = round(($sumofthismonthstock - $sumofpremonthstock) / $sumofthismonthstock, 2);


        $warehouse = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'warehouse')->get();
        return view('superadmin.reports')->with(compact('orders', 'customersdailyaddition', 'totalcustomers', 'growth', 'avaragesalesyearly', 'salesgrowth', 'stocks', 'geowthofstock', 'proname', 'warehouse','stocks2','customers_details','product_details'));
    }


    public function filter_sales(Request $request)
    {
      
        $data = '';

        $orders = Order::where('status',   'Delivered')->whereBetween('updated_at' ,[$request->from_date, $request->end_date])->orderBy('updated_at', 'DESC')->get();
       // dd($orders);
        $customers_details = CustomerDetail::all();
        $product_details = Product::all();

        foreach ($orders as $key => $value) {
      
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
            foreach ($customers_details as $customers){
            if($customers->email == $value->email){
                $party_name = $customers->company_name;
            }
            }
            foreach ($product_details as $product){
                foreach ($ordersperday as $i => $info){                                              
                    if($product->product_id ==  $products[$i]){
                        $product_name = $product->product_name;
                       
                        }
                    }
                }
                foreach ($product_details as $product){
                    foreach ($ordersperday as $i => $info){                                              
                        if($product->product_id ==  $products[$i]){
                            $pack_size = $product->packsize;
                            }
                        }
                    }
                foreach ($ordersperday as $i => $info){ 
                    $qty =  $moq[$i];
                }
              
            $data .= '
           <tr> 
            <td>' . date('d-m-Y', strtotime($value->updated_at)) . '</td>
            <td>' .'A'.$value->billno. '</td>
            <td>' . $party_name . '</td>
            <td>' . $product_name . '</td>
            <td>' . $pack_size . '</td>
            <td>' . $qty . '</td>
            <td>' . round($value->total_price) .'.00' . '</td>
            <td>' . '0.00' . '</td>
            <td>' . round($value->total_price) .'.00' . '</td>
            <td>'. round(round(($value->total_price)*6/100) *2).'.00'.'</td>
            <td>'. round($value->total_price + round(($value->total_price)*6/100) *2) .'.00'.'</td>
            </tr>';
        }


        return response()->json(['data' => $data]);

    }

    public function changestatus(Request $request, $email)
    {
        $user = CustomerDetail::where('email', '=', $email)->first();
        $request->validate([
            'status' => 'required',
        ]);
        $user->status = $request->status;
        $user->note = $request->note;
        $user->update();

        if ($request->status == 'Approved') {
            Mail::send('email', ['email' => $request->email, 'password' => ''], function (Message $message) use ($request) {
                $message->to($request->email)
                    ->subject('You Are Approved');
            });
        }

        return redirect('superadmin/correction')->with('status', 'Customer Updated Successfully.');
    }

    public function salesexport(Request $request)
    {
        return Excel::download(new SalesExport, 'sales.xlsx');
    }

    public function import(Request $request){
        Excel::import(new ImportProduct, 
                      $request->file('file')->store('files'));
        return redirect()->back();
    }
    
    public function exportUsers(Request $request){
        return Excel::download(new ExportProduct, 'products.xlsx');
    }

    public function truncateproduct(){
        Product::query()->truncate();
        return redirect()->back();
    }
      
    public function vehiclesimport(Request $request){
        Excel::import(new ImportVehicle, $request->file('file')->store('files'));
        return redirect()->back();
    }


            public function vehiclesexport(Request $request){
                return Excel::download(new ExportVehicle, 'vehicle.xlsx');
            }


            public function rolesimport(Request $request){
                Excel::import(new ImportRoles, $request->file('file')->store('files'));
                return redirect()->back();
            }

            public function rolesexport(Request $request){
                return Excel::download(new ExportRoles, 'roles.xlsx');
            }


            public function importcustomers(Request $request){
                Excel::import(new CustomerDetailsImport, $request->file('file')->store('files'));
                return redirect()->back();
            }

            public function exportcustomers(Request $request){
                return Excel::download(new ExportCustomer, 'customers.xlsx');
            }

            public function outletsimport(Request $request){
                Excel::import(new CustomerOutletImport, $request->file('file')->store('files'));
                return redirect()->back();
            }

            public function outletsexport(Request $request){
                return Excel::download(new CustomerOutletExport, 'outlets.xlsx');
            }
            public function discountimport(Request $request){
                Excel::import(new DiscountImport, $request->file('file')->store('files'));
                return redirect()->back();
            }

            public function discountexport(Request $request){
                return Excel::download(new ExportDiscount, 'discount.xlsx');
            }



            public function fetch_sub_categories(Request $request)    
            {
                $categories = Category::where('category_name', $request->category)->get();
            
                $sub_category_html = '<option value="">Select sub category</option>';
                $sub_sub_category_html = '<option value="">Select sub sub category</option>';
            
                if (count($categories) > 0) {
                    foreach ($categories as $value) {
                        if (!empty($value->sub_category)) {
                            $sub_category_html .= '<option value="' . $value->sub_category . '">' . $value->sub_category . '</option>';
                        }
                    }
            
                    foreach ($categories as $value) {
                        if (!empty($value->sub_sub_category)) {
                            $sub_sub_category_html .= '<option value="' . $value->sub_sub_category . '">' . $value->sub_sub_category . '</option>';
                        }
                    }
                }
            
                return response()->json(['sub_category_html' => $sub_category_html, 'sub_sub_category_html' => $sub_sub_category_html]);
            }
            
            public function customerdetails($email)
    {
        $layout = 4;
        $customers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('customers_details.email', '=', $email)->first();
        //dd($customers);
        return view('superadmin.customers')->with(compact('layout', 'customers'));
    }
}
