<?php

namespace App\Http\Controllers;

use App\Exports\CustomerOutletExport;
use App\Exports\ExportCustomer;
use App\Exports\ExportDiscount;
use App\Exports\ExportProduct;
use App\Exports\ExportRoles;
use App\Exports\ExportVehicle;
use App\Imports\CustomerDetailsImport;
use App\Imports\CustomerOutletImport;
use App\Imports\DiscountImport;
use App\Imports\ImportCustomer;
use App\Imports\ImportProduct;
use App\Imports\ImportRoles;
use App\Imports\ImportVehicle;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Vehicle;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use App\Models\Cart;
use App\Models\CustomerDetail;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProductAvailability;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Stock;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BackofficeController extends Controller
{
    // public function customers()
    // {
    //     $layout = 0;
    //     $customers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('users.roles', '=', 'customer')->get();
    //     return view('backoffice.customer')->with(compact('customers','layout'));
    // }
   
    public function roles()
    {
        $users = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
        ->where('users.roles', '!=', 'backoffice')->orderBy('userdetails.created_at', 'DESC')->get();
        return view('backoffice.roles')->with(compact('users'));
    }
    public function addroles()
    {
        $territory = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
        ->where('users.roles', '=', 'territory')->get();
        $relationship = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
        ->where('users.roles', '=', 'relationship')->get();
        $runner = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
        ->where('users.roles', '=', 'runner')->get();
        $warehouse = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
        ->where('users.roles', '=', 'warehouse')->get();
        $vehicle = Vehicle::get();
        return view('backoffice.addroles')->with(compact('territory','runner','vehicle','warehouse','relationship'));
    }
    public function saveroles(Request $request)
    {
        $request->validate([
            'roles' => 'required',
            'email' => 'required|unique:userdetails|unique:users',
            'password' => 'required',
        ]);
        $userDetails = new UserDetail();
        $userDetails->name = $request->input('name');
        $userDetails->warename = $request->input('warename');
        $userDetails->email = $request->input('email');
        $userDetails->phone = $request->input('phone');
        $userDetails->workaddress = $request->input('workaddress');
        $userDetails->homeaddress = $request->input('homeaddress');
        $userDetails->pincode = $request->input('pincode');
        $userDetails->city = $request->input('city');
        $userDetails->spoc_name = $request->input('spoc_name');
        $userDetails->spoc_number = $request->input('spoc_number');
        $userDetails->showpassword = $request->input('password');
        $userDetails->warehouse = $request->input('warehouse');
        $userDetails->vehicle = $request->input('vehicle');
        $userDetails->runner = $request->input('runner');
        $userDetails->note = $request->input('note');
        $userDetails->territory_manager = $request->input('territory_manager');
        $userDetails->relationship_manager = $request->input('relationship_manager');
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
        return redirect('backoffice/roles')->with('status', 'Role Added Successfully.');
    }
    public function vehicle()
    {
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get();
        return view('backoffice.vehicle')->with(compact('vehicles'));
     
    }

    public function carts(Request $request)
    {
        $carts = Cart::join('products', 'carts.product_id', '=', 'products.product_id')->where('carts.email', Auth()->user()->email)->get();
        $layout = 0;
        $customers = CustomerDetail::all();
        return view('backoffice.cart')->with(compact('layout', 'carts', 'customers'));
    }

    public function add_to_carts(Request $request)
    {
        $carts = Cart::where('product_id', $request->product_id)->where('email', auth()->user()->email)->first();
        if (!$carts) {
            $cart = new Cart;
            $cart->product_id = $request->product_id;
            $cart->email = auth()->user()->email;
            $cart->save();
            $total_carts=Cart::where('email', auth()->user()->email)->count();
            return response()->json(["success" => "Item add to cart",'total_carts'=>$total_carts]);
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
        $total_carts=Cart::where('email', auth()->user()->email)->count();
        return response()->json(['total_carts'=>$total_carts]);
    }
    
    // ==================Customers_Section====================
    public function customers()
    {
        $layout = 0;
        $customers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('users.roles', '=', 'customer')->orderBy('customers_details.created_at', 'DESC')->get();
        $relationship_managers = UserDetail::join('users', 'userdetails.email', '=', 'users.email')->where('users.roles', '=', 'relationship')->get();
        return view('backoffice.customer')->with(compact('layout', 'relationship_managers', 'customers'));
    }

    public function create_customers()
    {
        $layout = 1;
        $relationship_managers = User::where('roles', '=', 'relationship')->get();

        return view('backoffice.customer')->with(compact('layout', 'relationship_managers'));
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
        $userDetails->status = 'NotApproved';
        
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
        return redirect('backoffice/customers')->with('status', 'Customer added successfully.');
    }


    public function edit_customers($email)
    {
        $customer = CustomerDetail::where('email', $email)->first();
        $products = Product::all();
        $layout = 2; 
        $relationship_managers = UserDetail::join('users', 'userdetails.email', '=', 'users.email')->where('users.roles', '=', 'relationship')->get();
        return view('backoffice.customer')->with(compact('layout', 'customer', 'products', 'relationship_managers'));
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

        $userDetails->outlet_name = implode(',', $request->outlet_name);
        $userDetails->outlet_spoc = implode(',', $request->outlet_spoc);
        $userDetails->outlet_spoc_number = implode(',', $request->outlet_spoc_number);
        $userDetails->phone = implode(',', $request->phone);
        $userDetails->city = implode(',', $request->city);
        $userDetails->state = implode(',', $request->state);
        $userDetails->gst = implode(',', $request->gst);
        $userDetails->fda_license_number = implode(',', $request->fda_license_number);
        $userDetails->pincode = implode(',', $request->pincode);
        $userDetails->billing_address = implode(',', $request->billing_address);
        $userDetails->delivery_address = implode(',', $request->delivery_address);
        $userDetails->outlet_email = implode(',', $request->outlet_email);
        $userDetails->note = implode(',', $request->note);

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
        $userDetails->update();

        // Update name in users table
        $users = User::where('email', $email_id)->first();
        $users->name = $request->buisness_name;
        $users->email = $request->email;
        $users->update();

        return redirect('backoffice/customers')->with('status', 'Customer Updated Successfully.');
    }

    public function discount_customers(Request $request, $email_id)
    {
        if ($request->isMethod('post')) {
            $user = CustomerDetail::where('email', '=', $email_id)->first();
            $user->product_id = implode(',', $request->product_id);
            $user->discount_price = implode(',', $request->discount_price);
            $user->order_quantity = implode(',', $request->order_quantity);
            $user->save();

            return redirect('backoffice/customers')->with('status', 'Discount Updated Successfully.');
        } else {
            $customer = CustomerDetail::where('email', $email_id)->first();
            $products = Product::all();
            $layout = 3;
            return view('backoffice.customer')->with(compact('layout', 'customer', 'products'));
        }
    }


    public function delete_customers(Request $request, $email)
    {
        CustomerDetail::where('email', $email)->delete();
        User::where('email', $email)->delete();
        return redirect('backoffice/customers')->with('delete', 'Customer Deleted.');
    }




    public function checkFdaLicenceExpiry()
    {
        $customers = CustomerDetail::all();
        $expiredOutlets = [];
        $currentDate = now()->format('Y-m-d');
        $html='';
        $count=0;
        
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
    
        foreach ($expiredOutlets as $key => $value) {
            $html .= '<tr>
                <td class="mt-2 mr-2">' . ($key + 1) . '</td>
                <td>' . $value['outlet_name'] . '</td>
                <td>' . $value['customer_name'] . '</td>
                <td>' . ($value['expirydate']!=''?$value['expirydate']:'-') . '</td>
            </tr>';
        }
    
        $response = ['count' => $count, 'data' => $html];
    
        return response()->json($response);
    }
    

public function customerdetails($email)
{
    $layout = 4;
    $customers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('customers_details.email', '=', $email)->first();
    //dd($customers);
    return view('backoffice.customer')->with(compact('layout', 'customers'));
}

    // ======================Products_Manages===================

    public function products()
    {
        $layout = 0;
        $products = Product::orderBy('created_at', 'DESC')->get();
        $carts = Cart::where('email', auth()->user()->email)->get();
        $categories = Category::all();
        $stock = Stock::get();
        return view('backoffice.products')->with(compact('layout', 'products', 'carts', 'categories','stock'));
    }


    public function create_product(Request $request)
    {
        $layout = 1;
        $categories = Category::all();
        $users = UserDetail::all();
        return view('backoffice.products')->with(compact('layout', 'categories', 'users'));
    }


    public function save_product(Request $request)
    {

        $request->validate([
            'brand' => 'required',
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
            'hsncode'=>  'required',
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

        return redirect('backoffice/products')->with('status', 'product added Successfully');
    }                                                                                                                                                                                                                                                                                                                                                                                                                                          
    public function edit_product($id)
    {

        $layout = 2;
        $product = Product::find($id);
        $categories = Category::all();
        $users = UserDetail::all();
        return view('backoffice.products')->with(compact('layout', 'product', 'users', 'categories'));
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
            foreach ($images as $image) {
                $image_uploaded_path = $image->store($uploadFolder, 'public');
                $image_name =  basename($image_uploaded_path);
                $mime = $image->getClientMimeType();
                $images_path[] = $image_uploaded_path;
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
       return redirect('backoffice/products')->with('status', 'product Updated Successfully');
    }

    public function delete_product(Request $request, $id)
    {
        $product = Product::destroy($id);
        return redirect('backoffice/products')->with('delete', 'product Deleted');
    }
    public function product_details($id)
    {
        $layout = 3;
        $products = Product::find($id);
        return view('backoffice.productDetails')->with(compact('layout', 'products'));
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
                        <td><a href="' . url("backoffice/product-details/" . $item->id) . '">
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
                       
                    </tr>';
    
                $data .= '<script>
                    $(document).ready(function() {
                        $("#cart' . $item->id . '").change(function() {
                            if ($(this).is(":checked")) {
                                var product_id = $(this).data("product-id");
            
                                $.ajax({
                                    url: "' . url('backoffice/add-to-carts') . '",
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

    // =====================End_Products_Manages=====================
// ========================Category_Section==============================

public function category()
{
    $layout = 0;
    $category = Category::orderBy('created_at', 'DESC')->get();
    return view('backoffice.categories')->with(compact('layout', 'category'));
}

public function create_category(Request $request)
{
    $layout = 1;
    return view('backoffice.categories')->with(compact('layout'));
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
    return redirect('backoffice/category')->with('addcategory', $message);
}


public function edit_category($id)
{
    $layout = 2;
    $category = Category::find($id);
    return view('backoffice.categories')->with(compact('layout', 'category'));
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
    return redirect('backoffice/category')->with('deletecategory', $message);
}

// ===========================End_Category_Section===========================

    public function addvehicle()
    {
        $warehouse = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
        ->where('users.roles', '=', 'warehouse')->get();
        return view('backoffice.addVehicle')->with(compact('warehouse'));
    }
    public function fetch_warename(Request $request)
    {
        $warecity = UserDetail::join('users', 'userdetails.email', '=', 'users.email')->where('roles','=','warehouse')->where('city', '=', $request->warecity)->where('status', '=', 'Approved')->get();
        $options = '';
        foreach ($warecity as $item) {
            $options .= "<option value=" . $item['email'] . ">" . $item->name . "</option>";
        }
        return $options;
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
            return redirect('backoffice/vehicle')->with('status', 'Vehicle Added Successfully');
        } else {
            return view('backoffice.addVehicle');
        }
    }
    public function orders()
    {
     
        $layout = 0;
        $orders = Order::orderBy('created_at', 'DESC')->get();
        $territory = [];
        foreach($orders as $order)
        {
            $territory[] = UserDetail::join('orders','userdetails.relationship_manager','=','orders.relationship_manager')->where('orders.relationship_manager',$order->relationship_manager)->get('name')->toArray();
        }
        //dd( $territory);
        return view('backoffice.orders')->with(compact('layout','orders','territory'));
    }
    public function orders_details($id)
    {

        $layout = 3;
        $order_details = Order::where('id', $id)->first();

      $rm = UserDetail::where('email', $order_details['relationship_manager'])->first();
        
        $territory=UserDetail::where('email', $rm['territory_manager'])->first();
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


        return view('backoffice.orders')->with(compact('layout', 'order_details', 'product_details','territory'));
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
        return view('backoffice.invoice')->with(compact('order_details', 'product_details','territory','randomNumber','id','productscheck'));
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
        $pdf = PDF::loadView('backoffice.invoice', ['order_details' => $order_details,'product_details' => $product_details, 'territory' => $territory, 'randomNumber' => $randomNumber, 'id'=>$id,'productscheck'=> $productscheck]);
        return $pdf->download('Invoice_JC' . date('Y-') . '-' . $randomNumber . '.pdf');
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
            if($value['status']== 'Delivered'){
                $delivared_date = date('d-m-Y',strtotime($value->updated_at));
                }
            else{
                $delivared_date  = '-';
            }
            $data .= '
           <tr> 
            <td>' . $index . '</td>
            <td>' . date('d-m-Y',strtotime($value->created_at)) . '</td>
            <td>' .$delivared_date. '</td>
            <td>' . $value->outlet_name . '</td>
           
            <td>' . $value->delivery_address . '</td>
            <td>' . $diff_days . ' Days'. '</td>
        
            <td>
                <a
                    href="' . url("backoffice/orders-details/" . $value->id) . '">
                    <button type="button"
                        class="btn btn-primary waves-effect waves-light">
                        <i class="fas fa-eye"></i></button>
                </a>
            </td>
            <td>
                <a
                    href="' . url("backoffice/invoice/" . $value->id) . '">
                    <button type="button"
                        class="btn btn-success waves-effect waves-light">
                        <i class="fas fa-file-invoice"></i></button>
                </a>
            </td>
            <td>
                <button type="button"
                class="btn btn-outline-success waves-effect waves-light">' . $value->status . '</button>
            </td>
            <td>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter'.$value['order_id'].'">
                    Add
                </button>
            </td>
            </tr>';
        }
        return response()->json(['data' => $data]);
    }


    public function correction()
    {
       $customers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('users.roles', '=', 'customer')->where('customers_details.status', '=','NotApproved')->orWhere('customers_details.status', '=','Correction')->orderBy('customers_details.created_at', 'DESC')->get(); 
        $days = [];
        foreach($customers as $customer)
        {
            $toDate = Carbon::createFromFormat('Y-m-d H:s:i', $customer->created_at);
            $fromDate = Carbon::now();
            $days[] = $toDate->diffInDays($fromDate);
        }
        $approvedcustomers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('users.roles', '=', 'customer')->where('customers_details.status', '=','Approved')->orderBy('customers_details.created_at', 'DESC')->get(); 
        $appdays = [];
        foreach($approvedcustomers as $approvedcustomer)
        {
            $toDate = Carbon::createFromFormat('Y-m-d H:s:i', $approvedcustomer->created_at);
            $fromDate = Carbon::now();
            $appdays[] = $toDate->diffInDays($fromDate);
        }
    
        return view('backoffice.approval')->with(compact('customers','days','approvedcustomers','appdays'));
    }

    public function customerapproval(Request $request, $email)
    {
        $customers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('customers_details.email', '=', $email)->first();
        return view('backoffice.approvalCustomerDetails')->with(compact('customers')); 
    }


    public function changestatus(Request $request, $email)
    {
        $user = CustomerDetail::where('email', '=', $email)->first();
        $request->validate([
            'status' => 'required',
        ]);
        // Update user details in userdetails table
        $user->status = $request->status;
        $user->note = $request->note;
        $user->update();

        Mail::send('email', ['email' => $request->email, 'password' => ''], function (Message $message) use ($request) {
            $message->to($request->email)
                ->subject('You Are Approved');
        });
        return redirect('backoffice/correction')->with('status', 'Customer Updated Successfully.');
    }
  
    public function search(Request $request)
    {
       $projects = UserDetail::where([['name', '!=', NULL],[function ($query) use ($request){
        if(($term = $request->term)){
            $query->orWhere('name', 'Like', '%' . $term. '%')->get();
        }
       }]
       ])
       ->orderBy("id","desc")->paginate(10);
       return view('backoffice.roles',compact('projects'))->with('i',(request()->input('page',1)-1)*5);
    }

    public function filterroles(Request $request)
    {
        $data = '';

        $roles = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
        ->where('users.roles', '=', $request->roles)->get();

        foreach ($roles as $key => $value) {
            $Role = '';
            $statuses = '';
        if($value->roles=='warehouse')
            $Role = 'Warehouse';
        elseif($value->roles=='admin')
            $Role = 'Admin';
        elseif($value->roles=='runner')
            $Role = 'Runner';
        elseif($value->roles=='relationship')
            $Role = 'Relationship Manager';
        elseif($value->roles=='customer')
            $Role = 'Customer';
        elseif($value->roles=='territory')
            $Role = 'Territory Manager';
        elseif($value->roles=='inventory')
            $Role = 'Inventory';
        
        if ($value->status == 'Approved')
            $statuses = '<button type="button" class="btn btn-outline-success waves-effect waves-light">Approved</button>';
        elseif($value->status == 'NotApproved')
            $statuses = '<button type="button" class="btn btn-outline-danger waves-effect waves-light">Not Approved</button>';
        elseif($value->status == 'Correction')
            $statuses = '<button type="button" class="btn btn-outline-info waves-effect waves-light">Need Correction</button>';
        

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
            <td>'. $statuses.' </td>
          </tr>';
        }


        return response()->json(['data' => $data]);
        
    }
    public function productfororder()
    {
        $products = Product::all();
        return view('backoffice.productForOrder')->with(compact('products'));
    }
    public function orderdetails($id)
    {
       
        $order_details = Order::where('id', $id)->first();
    

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
        
        return view('backoffice.orderDetails')->with(compact('order_details','product_details'));
    }

    public function fetch_carts(){

        $carts=Cart::join('products','carts.product_id','=','products.product_id')->where('carts.email',Auth()->user()->email)->get();
 
        $html='';
         foreach ($carts as $key => $item) {
         
             $html.='<tr>
             <td class="cart-product-remove" id="deletecart'.$item->id.'">x</td>
             <td class="cart-product-image">
                 <a href="#"><img
                         src="'.url('image/'.$item->image).'"
                         alt="#"></a>
             </td>
             <td class="cart-product-info">
                 <h4><a href="#">'.$item->product_name.'</a>
                 </h4>
             </td>
             <td class="cart-product-price">'.$item->price.'</td>
             <td class="cart-product-quantity">
                 <div class="cart-plus-minus">
                     <span>-</span>
                     <input type="text" value="'.$item->min_order_quantity.'"
                         name="qtybutton"
                         class="cart-plus-minus-box">
                     <span>+</span>
                 </div>
             </td>
             <td class="cart-product-subtotal">'.$item->price*$item->min_order_quantity.'</td>
         </tr>';
         }
         return response()->json(['html' => $html]);
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
                <input type="hidden" class="price' . $value->product_id . '" value="' .  $value->jsp . '">
                <input type="hidden"  class="mrp" value="'. $value->price .'">
                 <td >
                        <div class="cart-plus-minus cart-plus-minus' . $value->product_id . '" onclick="changeMoq(\'' . $value->product_id . '\')">
                     <span class="minus minus' . $value->product_id . '">-</span>
                     <input type="text"
                         value="' . $value->min_order_quantity . '"
                         name="qtybutton"
                         class="cart-plus-minus-box cart-plus-minus-box' . $value->product_id . ' moqs' . $value->product_id . '">
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
 
                        <input type="hidden" class="price' . $product_id[$k] . '" value="' . ($discountPrices[$k] != '' ? $discountPrices[$k] : $products[$k]->jsp) . '">
                        <td >
                        <input type="hidden"  class="mrp" value="'. $products[$k]->price .'">
                        <div class="cart-plus-minus cart-plus-minus' . $product_id[$k] . '"  onclick="changeMoq(\'' . $product_id[$k] . '\')">
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
                    if (isset($product_id[$j])) {
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
            return response()->json(['error' => 'Warehouse Is Not Located In The '. $request->city. 'City']);

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


    

        foreach ($request->product_id as $key => $productId) {


            $product_name=Product::where('product_id',$productId)->pluck('product_name')->first();

            $product = Stock::join('products', 'products.product_id', '=', 'stocks.product_id')
                ->where('stocks.warehouse', $warehouse->email)
                ->where('stocks.product_id', $productId)->first();

                if(!$product){
                    return response()->json(['error' => 'This '.$product_name.' currently is not available in the'.$warehouse->name. ' warehouse']);

                }

            if ($product && $product->stocks >= $request->moq[$key]) {
                $stocks=Stock::where('warehouse',$warehouse->email)->where('product_id',$productId)->first();
                $stocks->stocks -= $request->moq[$key];
                $stocks->sold += $request->moq[$key];
                $stocks->save();
            } else {
                return response()->json([
                    'error' => 'Insufficient stock for ' . $product->product_name . '!! Available stocks: ' . max($product->stocks, 0)
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
        $url = url('backoffice/orders');
        return response()->json(['url' => $url]);
    }


 
 

 
     
public function importView(Request $request){
    return view('importFile');
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

public function purchaseorders()
{
    $layout = 0;
    $purchase = PurchaseDetail::orderBy('unique_purchase.created_at', 'DESC')->get();
    
    // $warehouse = User::join('unique_purchase', 'users.email', '=', 'unique_purchase.warehouse_email')
    //     ->where('users.roles', '=','warehouse')->get();
    
    $warename = User::where('roles','warehouse')->get();
   
    return view('backoffice.purchaseOrder')->with(compact('purchase','layout','warename'));
}
public function addpurchase()
{
    $layout = 1;
    $warehouse = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
        ->where('users.roles', '=', 'warehouse')->get();
    $runner = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
        ->where('users.roles', '=', 'runner')->get();
    $vehicle = Vehicle::get();
    $products = Product::all();

    return view('backoffice.purchaseOrder')->with(compact( 'runner', 'vehicle', 'warehouse', 'layout','products'));
}

public function addpurchaseorder(Request $request)
{
    // dd($request->all());
    
    $request->validate([
        'warehouse_email' => 'required',
        'product_name' => 'required',
        'manufacturer' => 'required',
        'packsize' => 'required',
        'hsn' => 'required',
        'mrp' => 'required',
        'rate' => 'required',
        'qty' => 'required',
        'vendor_name' => 'required',
        'address' => 'required',
        'gstin_number' => 'required',
        'contact_number' => 'required',
    ]);

    $purchase_id = 'PO'.rand();
    $purchase_id = $purchase_id;
    $product_name = $request->input('product_name');
    $manufacturer = $request->input('manufacturer');
    $packsize = $request->input('packsize');
    $hsn = $request->input('hsn');
    $mrp = $request->input('mrp');
    $rate = $request->input('rate');
    $qty = $request->input('qty');
    $gst = $request->input('gst');


    $purchasedeatails = new PurchaseDetail();
    $purchasedeatails->warehouse_email = $request->input('warehouse_email');
    $purchasedeatails->purchase_id = $purchase_id;
    $purchasedeatails->vendor_name = $request->input('vendor_name');
    $purchasedeatails->address = $request->input('address');
    $purchasedeatails->gstin_number = $request->input('gstin_number');
    $purchasedeatails->contact_number = $request->input('contact_number');
    $purchasedeatails->save();
  
        for($i=0;$i<count($product_name);$i++)
        {
            $datasave = [
                'purchase_id'=> $purchase_id,
                'product_name'=>$product_name[$i],
                'manufacturer'=>$manufacturer[$i],
                'packsize'=> $packsize[$i],
                'hsn'=> $hsn[$i],
                'mrp'=> $mrp[$i],
                'rate'=> $rate[$i],
                'qty'=> $qty[$i],
                'gst'=> $gst[$i],
                'created_at'=> date('Y-m-d h:i:s'),
                'updated_at'=> date('Y-m-d h:i:s'),
            ];
            DB::table('purchase_orders')->insert($datasave);
        }
        Session::put('success',"Save Data Successfulluy...!");

    return redirect('backoffice/purchaseorders')->with('status', 'Purchase Order added successfully.');
}
public function edit_purchaseorders($purchase_id)
{
   
    $purchase = PurchaseDetail::where('purchase_id',$purchase_id)->first();
    $purchasedeatails = Purchase::where('purchase_id',$purchase_id)->get();
    $products = Product::all();
//dd($purchasedeatails);
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
    return view('backoffice.purchaseOrder')->with(compact('layout', 'purchase', 'territory', 'runner', 'vehicle', 'warehouse', 'relationship','purchasedeatails','products'));
}
public function update_purchaseorders(Request $request, $purchase_id)
{
   
//   dd($request->all());
    $request->validate([
        'warehouse_email' => 'required',
        'product_name' => 'required',
        'manufacturer' => 'required',
        'packsize' => 'required',
        'hsn' => 'required',
        'mrp' => 'required',
        'rate' => 'required',
        'qty' => 'required',
        'vendor_name' => 'required',
        'address' => 'required',
        'gstin_number' => 'required',
        'contact_number' => 'required',
    ]);

    // Update user details in purchase table
    $purchase_id = $purchase_id;
    $id = $request->input('id');
    $product_name = $request->input('product_name');
    $manufacturer = $request->input('manufacturer');
    $packsize = $request->input('packsize');
    $hsn = $request->input('hsn');
    $mrp = $request->input('mrp');
    $rate = $request->input('rate');
    $qty = $request->input('qty');

    $purchasedeatails = PurchaseDetail::where('purchase_id', '=', $purchase_id)->first();
    $purchasedeatails->warehouse_email = $request->input('warehouse_email');
    $purchasedeatails->vendor_name = $request->input('vendor_name');
    $purchasedeatails->address = $request->input('address');
    $purchasedeatails->gstin_number = $request->input('gstin_number');
    $purchasedeatails->contact_number = $request->input('contact_number');
    $purchasedeatails->update();
  
        for($i=0;$i<count($product_name);$i++)
        {
            $datasave = [ 
                // 'purchase_id'=>$purchase_id,
                'product_name'=>$product_name[$i],
                'manufacturer'=>$manufacturer[$i],
                'packsize'=> $packsize[$i],
                'hsn'=> $hsn[$i],
                'mrp'=> $mrp[$i],
                'rate'=> $rate[$i],
                'qty'=> $qty[$i],
                'created_at'=> date('Y-m-d h:i:s'),
                'updated_at'=> date('Y-m-d h:i:s'),
            ];
        
            DB::table('purchase_orders')->where('id', $id[$i])->update($datasave);
            //DB::table('purchase_orders')->where('purchase_id', $purchase_id)->update($datasave);
        }
        Session::put('success',"Save Data Successfulluy...!");


    return redirect('backoffice/purchaseorders')->with('status', 'Purchase Orders Updated Successfully.');
}
public function delete_purchaseorders($purchase_id)
{
    Purchase::where('purchase_id', $purchase_id)->delete();
    PurchaseDetail::where('purchase_id', $purchase_id)->delete();
    return redirect('backoffice/purchaseorders')->with('status', 'Purchase Orders Deleted.');
}
public function upload_invoice(Request $request,$purchase_id)
{
    $request->validate([
        'invoice'=> 'required|mimetypes:application/pdf'
    ]);
    $purchase = PurchaseDetail::where('purchase_id', '=', $purchase_id)->first();

    if ($request->hasfile('invoice')) {
        $file = $request->file('invoice');
        $extension = $file->getclientoriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('invoice/', $filename);
        $purchase->invoice = $filename;
    }
    $purchase->save();
    return redirect('backoffice/purchaseorders')->with('status', 'Invoice Updated Successfully.');
}
public function purchaseorderdetails($purchase_id)
{
    $purchase = Purchase::where('purchase_id',$purchase_id)->get();
    $products = Product::get();
    $proname = [];

     
    foreach ($purchase as $pur) {
        foreach ($products as $product) {
            if ($pur->product_name == $product->product_id) {
                $proname[] = $product->product_name;
            }
        }
}
    $purchasedeatails = PurchaseDetail::where('purchase_id',$purchase_id)->get();
    return view('backoffice.purchaseOrderDetails')->with(compact('purchase','purchasedeatails','proname'));
}
public function getproduct()
{
    $product = Product::get();
   
        return response()->json($product);
    
}
public function get_product_details(Request $request)
{
    // $manufacturer = rand();
    // $packsize =  rand();
    // $mrp =  rand();
    $product = Product::where('product_id',$request->product_id)->first();
    
        $manufacturer = $product->manufacturer!= NULL ?  $product->manufacturer : 'Null';
        $packsize =  $product->packsize!= NULL ?  $product->packsize : 'Null';
        $mrp = $product->price!= NULL ?  $product->price : 'Null';
        $hsncode = $product->hsncode!= NULL ?  $product->hsncode : 'Null';
    
    return response()->json(['manufacturer' => $manufacturer,'packsize'=>$packsize,'mrp'=> $mrp,'hsncode'=>$hsncode]);
}
public function showpdf($purchase_id)
{
    $purchasedetails = PurchaseDetail::where('purchase_id', $purchase_id)->get();
    foreach($purchasedetails as $item)
    {
        return response()->file(public_path('invoice/'.$item->invoice),['content-type'=>'application/pdf']);
    }
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
    public function remarks(Request $request)
   {
    $orders = Order::where('order_id', '=', $request->order_id)->first();
      
    $orders->remarks = $request->remark;
    $orders->update();

    return redirect('backoffice/orders')->with('status', ' Updated Successfully.');
   }

}
