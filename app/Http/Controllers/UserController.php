<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\contactus;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\CustomerDetail;
use App\Models\Order;
use App\Models\ProductAvailability;
use App\Models\ProductPincode;
use App\Models\Stock;
use App\Models\User;
use App\Models\UserDetail;
use Stripe\Exception\CardException;
use Stripe\Stripe;
use Illuminate\Support\Facades\DB;
use Stripe\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{

    public function index()
    {
        return view('usernew.home');
    }
    public function login()
    {
        return view('usernew.login');
    }
    public function user_login(Request $request)
    {
            $credentials = $request->validate([
              'email' => 'required|email',
              'password' => 'required',
            ]);
           
            if (Auth::attempt($credentials)) {

              $user = User::where('email', $request->email)->get()->toArray();
              $userDetails = CustomerDetail::where('email', $request->email)->get()->toArray();
        
             if ($user[0]['roles'] == 'customer' ) {
                if($userDetails[0]['status'] == 'Approved'){
                    $request->session()->regenerate();
                    return redirect()->intended('product');
                }
                else{
                    return redirect()->back()->withErrors('You are not Approved');
                }
               
              }
              else {
                return redirect()->back()->withErrors('Please enter valid credentials');
              }
            } else {
              return redirect()->back()->withErrors('Please Enter Correct Email Address & Password');
            }
          
    }
    public function product()
    {
        if (auth()->check()) {
            $products = DB::table('products')
                ->leftJoin('customers_details', function ($join) {
                    $join->on(DB::raw("FIND_IN_SET(products.product_id, customers_details.product_id)"), '>', DB::raw('0'))
                        ->where('customers_details.email', '=', auth()->user()->email);
                })
                ->select(
                    'products.id',
                    'products.product_id',
                    'products.product_name',
                    'products.categories',
                    'products.description',
                    'products.image',
                    'products.others_image',
                    'products.price',
                    'customers_details.discount_price',
                    'customers_details.order_quantity',
                    'products.min_order_quantity'
                )
                ->get();

            $products = $products->map(function ($product, $index) {
                $discounts = explode(',', $product->discount_price);
                $newIndex = $index % count($discounts);
                $product->discount_price = $discounts[$newIndex];
                if (!empty($product->order_quantity)) {
                    $discountOrderQuantities = explode(',', $product->order_quantity);
                    $discountOrderQuantitiesCount = count($discountOrderQuantities);
                    $newIndex = $index % $discountOrderQuantitiesCount;
                    $product->order_quantity = $discountOrderQuantities[$newIndex];
                }

                return $product;
            });

            $customercity =  CustomerDetail::where('email', auth()->user()->email)->get('customer_city');
            foreach($customercity as $city){
                $warecity = $city->customer_city;
            }
            //dd($warecity);
            $warehouse = UserDetail::join('users','userdetails.email','=','users.email')->where('roles','warehouse')->where('city',$warecity)->get();
            foreach($warehouse as $ware){
                $wareemail= $ware->email;
            }
             // dd($warehouse);
            $stock = Stock::where('warehouse',$wareemail)->get();


            $carts = Cart::join('products', 'products.product_id', '=', 'carts.product_id')->where('carts.email', auth()->user()->email)->get();
            $orders = Order::where('email', auth()->user()->email)->get();
            $catagory = Category::all();
            $totalstocks = Stock::all();
            $instock = 0;
            $outofstock = 0;
            $prod = DB::table('products')->join('categories', 'categories.category_name', '=', 'products.categories')->get();
            foreach($prod as $product){

                foreach($totalstocks as $stock){

                    if($product->product_id == $stock->product_id){

                        $instock++;
                    }
                    else{
                        $outofstock++;
                    }
                }
            }
          
            return view('usernew.products')->with(compact('products', 'carts', 'orders','stock','catagory','instock','outofstock'));
                                                                                                                                                  
        } else {
            $products = DB::table('products')->join('categories', 'categories.category_name', '=', 'products.categories')->where('categories.access', '0')->get();
            $catagory = Category::all();
            $stocks = Stock::all();
            $instock = 0;
            $outofstock = 0;
            foreach($products as $product){

                foreach($stocks as $stock){

                    if($product->product_id == $stock->product_id){

                        $instock++;
                    }
                    else{
                        $outofstock++;
                    }
                }
            }
          
            return view('usernew.products')->with(compact('products','catagory','instock','outofstock'));
        }

        //return view('usernew.products');
    }
    public function about()
    {
        return view('usernew.about');
    }
    // .....Profile..........
    public function profile(Request $request)
    {
        if ($request->isMethod('post')) {
            $customers = CustomerDetail::where('email', auth()->user()->email)->first();
            $customers->buisness_name = $request->input('buisness_name');
            $customers->phone = $request->input('phone');
            $customers->billing_address = $request->input('billing_address');
            $customers->delivery_address = $request->input('delivery_address');
            $customers->photo = $request->input('photo');

            if ($request->hasfile('photo')) {
                $file = $request->file('photo');
                $extension = $file->getclientoriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('image/', $filename);
                $customers->photo = $filename;
            }

            $customers->save();

            // Update name and email in users table
            $user = User::where('email', auth()->user()->email)->first();
            $user->name = $request->input('buisness_name');

            $user->save();
            return redirect('my-account')->with('status', 'Your Profile has been successfully Updated');
        } else {

            $user = CustomerDetail::where('email', auth()->user()->email)->first();


            $carts = Cart::join('products', 'products.product_id', '=', 'carts.product_id')->where('carts.email', auth()->user()->email)->get();

            $orders = Order::orderBy('created_at', 'DESC')->where('orders.email', auth()->user()->email)->get();

            return view('users.my-account')->with(compact('user', 'carts', 'orders'));
        }
    }

    public function cart(Request $request)
    {
        $carts = new Cart;
        $carts->product_id = $request['product_id'];
        $carts->quantity = $request['moq'];
        $carts->cart_price = $request['price'];
        $carts->email = auth()->user()->email;
        $carts->save();
    }

    public function cart_delete($id)
    {
        $cart = Cart::where('email', auth()->user()->email)
            ->where('id', $id)
            ->first();

        if ($cart) {
            $cart->delete();
            return back();
        }
    }

    public function total_carts()
    {
        $email = auth()->user()->email;
        $total_carts = Cart::where('email', $email)->count();
        return response()->json(['total_carts' => $total_carts]);
    }

   //..................checkOut-part..............
    
    public function checkout()
    {
        $carts = Cart::join('products', 'products.product_id', '=', 'carts.product_id')
            ->join('customers_details', 'customers_details.email', '=', 'carts.email')->where('carts.email', auth()->user()->email)->get();


        $productId = Cart::where('carts.email', auth()->user()->email)->get();


        $customers = CustomerDetail::where('email', auth()->user()->email)->first();
        return view('usernew.checkout')->with(compact('carts', 'customers', 'productId'));
    }
    
    public function filter_products(Request $request)
    {

        $data = '';
        $data1='';
        if (auth()->check()) {
            if ($request->sort_value == 'htl') {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->orderBy('products.price', 'DESC')->get();
            } elseif ($request->sort_value == 'lth') {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->orderBy('products.price', 'ASC')->get();
            } elseif ($request->sort_value == 'new') {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->orderBy('products.id', 'DESC')->get();
            } else {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->get();
            }

        } else {

            $access = 0;
            if ($request->sort_value == 'htl') {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->where('categories.access', $access)->orderBy('products.price', 'DESC')->get();
            } elseif ($request->sort_value == 'lth') {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->where('categories.access', $access)->orderBy('products.price', 'ASC')->get();
            } elseif ($request->sort_value == 'new') {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->where('categories.access', $access)->orderBy('products.id', 'DESC')->get();
            } else {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->where('categories.access', $access)->get();
            }
        }
       
         foreach ($products as $key => $item) {
            $data .=' <div class="col-lg-4">
            <div class="product-box">
              <div class="img">
                <img  src="'.url('image/' . $item->image).'" alt="">
              </div>

              <div class="content">
                <h3>'. $item->product_name.' </h3>
                
                <p class="text">'.$item->description.'</p>

             
              </div>
            </div>
          </div>';


            //  '<div class="col-xl-3 col-lg-4 col-sm-6 col-6 searchproduct" id="hide">
            // <div class="ltn__product-item ltn__product-item-3 text-center">
            //     <div class="product-img">
            //         <a href="#" title="Quick View" data-bs-toggle="modal"
            //             data-bs-target="#quick_view_modal' . $item->product_id . '"><img
            //                 src="' . url('image/' . $item->image) . '"
            //                 alt="#"></a>
    
            //         <div class="product-badge">
            //             <ul>
            //                 <li class="sale-badge">New</li>
            //             </ul>
            //         </div>
            //         <div class="product-hover-action">
            //             <ul>
            //                 <li>
            //                     <a href="#" title="Quick View"
            //                         data-bs-toggle="modal"
            //                         data-bs-target="#quick_view_modal' . $item->product_id . '">
            //                         <i class="far fa-eye"></i>
            //                     </a>
            //                 </li>
                           
            //             </ul>
            //         </div> 
            //     </div>

            //     <div class="product-info">
            //         <div class="product-ratting">        
            //         </div>
            //         <h2 class="product-title name"> <a
            //                 href="' . url('product/' . $item->product_id) . '">
            //                 ' . $item->product_name . ' </a></h2>      
            //     </div>
            // </div>
            // </div>';

            $data1.=
            '<div class="col-lg-4">
            <div class="product-box">
              <div class="img">
                <img src="'.url('image/' . $item->image).'" alt="">
              </div>

              <div class="content">
                <h3>'. $item->product_name .' </h3>
               
                 <p class="text-new">
                   ₹ '. $item->price .'
                  </p>
               
                
                 
                <p class="text">'.$item->description.'</p>

                <ul class="d-flex justify-content-between aling-items-center mt-5">
                  <li><button><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button></li>
                  <li class="pt-2"><a href="">
                  
                 
                 </a></li>
                </ul>
              </div>
            </div>
          </div>';
            
            
            ' <div class="col-lg-12 searchproduct">
          
            <div class="ltn__product-item ltn__product-item-3">
                <div class="product-img">

                    <a href="#" title="Quick View" data-bs-toggle="modal"
                        data-bs-target="#quick_view_modal'.$item->product_id.'"><img
                            src="'.url('image/' . $item->image).'"
                            alt="#"></a>


                    <div class="product-badge">
                        <ul>
                            <li class="sale-badge">New</li>
                        </ul>
                    </div>
                </div>

                <div class="product-info">

                 <h2 class="product-title name"><a href="'.url('product/' . $item->product_id).'">'.$item->product_name.'</a></h2>

                    <div class="product-ratting">
                    </div>

                    <div class="product-price">         
                    </div>

                    <div class="product-brief">
                        <p>'.$item->description.'</p>
                    </div>

                </div>
            </div>
        </div>';

        }
        return response()->json(['data'=>$data,'data1'=>$data1]);
    }
    public function filter_products_auth(Request $request)
    {

        $data = '';
        $data1='';
        if (auth()->check()) {
            if ($request->sort_value == 'htl') {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->orderBy('products.price', 'DESC')->get();
            } elseif ($request->sort_value == 'lth') {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->orderBy('products.price', 'ASC')->get();
            } elseif ($request->sort_value == 'new') {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->orderBy('products.id', 'DESC')->get();
            } else {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->get();
            }

        } else {

            $access = 0;
            if ($request->sort_value == 'htl') {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->where('categories.access', $access)->orderBy('products.price', 'DESC')->get();
            } elseif ($request->sort_value == 'lth') {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->where('categories.access', $access)->orderBy('products.price', 'ASC')->get();
            } elseif ($request->sort_value == 'new') {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->where('categories.access', $access)->orderBy('products.id', 'DESC')->get();
            } else {
                $products = Product::join('categories', 'categories.category_name', '=', 'products.categories')->where('categories.access', $access)->get();
            }
        }
       
         foreach ($products as $key => $item) {
            $data .=' <div class="col-lg-4">
            <div class="product-box">
              <div class="img">
                <img  src="'.url('image/' . $item->image).'" alt="">
              </div>

              <div class="content">
                <h3>'. $item->product_name.' </h3>
                
                <p class="text">'.$item->description.'</p>

                <ul class="d-flex justify-content-between aling-items-center mt-5">
                  <li><button><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button></li>
                  <li class="pt-2"><a href="">
                 </a></li>
                </ul>
              </div>
            </div>
          </div>';


            //  '<div class="col-xl-3 col-lg-4 col-sm-6 col-6 searchproduct" id="hide">
            // <div class="ltn__product-item ltn__product-item-3 text-center">
            //     <div class="product-img">
            //         <a href="#" title="Quick View" data-bs-toggle="modal"
            //             data-bs-target="#quick_view_modal' . $item->product_id . '"><img
            //                 src="' . url('image/' . $item->image) . '"
            //                 alt="#"></a>
    
            //         <div class="product-badge">
            //             <ul>
            //                 <li class="sale-badge">New</li>
            //             </ul>
            //         </div>
            //         <div class="product-hover-action">
            //             <ul>
            //                 <li>
            //                     <a href="#" title="Quick View"
            //                         data-bs-toggle="modal"
            //                         data-bs-target="#quick_view_modal' . $item->product_id . '">
            //                         <i class="far fa-eye"></i>
            //                     </a>
            //                 </li>
                           
            //             </ul>
            //         </div> 
            //     </div>

            //     <div class="product-info">
            //         <div class="product-ratting">        
            //         </div>
            //         <h2 class="product-title name"> <a
            //                 href="' . url('product/' . $item->product_id) . '">
            //                 ' . $item->product_name . ' </a></h2>      
            //     </div>
            // </div>
            // </div>';

            $data1.=
            '<div class="col-lg-4">
            <div class="product-box">
              <div class="img">
                <img src="'.url('image/' . $item->image).'" alt="">
              </div>

              <div class="content">
                <h3>'. $item->product_name .' </h3>
               
                 <p class="text-new">
                   ₹ '. $item->price .'
                  </p>
               
                
                 
                <p class="text">'.$item->description.'</p>

                <ul class="d-flex justify-content-between aling-items-center mt-5">
                  <li><button><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button></li>
                  <li class="pt-2"><a href="">
                  
                 
                 </a></li>
                </ul>
              </div>
            </div>
          </div>';
            
            
            ' <div class="col-lg-12 searchproduct">
          
            <div class="ltn__product-item ltn__product-item-3">
                <div class="product-img">

                    <a href="#" title="Quick View" data-bs-toggle="modal"
                        data-bs-target="#quick_view_modal'.$item->product_id.'"><img
                            src="'.url('image/' . $item->image).'"
                            alt="#"></a>


                    <div class="product-badge">
                        <ul>
                            <li class="sale-badge">New</li>
                        </ul>
                    </div>
                </div>

                <div class="product-info">

                 <h2 class="product-title name"><a href="'.url('product/' . $item->product_id).'">'.$item->product_name.'</a></h2>

                    <div class="product-ratting">
                    </div>

                    <div class="product-price">         
                    </div>

                    <div class="product-brief">
                        <p>'.$item->description.'</p>
                    </div>

                </div>
            </div>
        </div>';

        }
        return response()->json(['data'=>$data,'data1'=>$data1]);
    }
    public function products(Request $request)
    {
        if (auth()->check()) {
            $products = DB::table('products')
                ->leftJoin('customers_details', function ($join) {
                    $join->on(DB::raw("FIND_IN_SET(products.product_id, customers_details.product_id)"), '>', DB::raw('0'))
                        ->where('customers_details.email', '=', auth()->user()->email);
                })
                ->select(
                    'products.id',
                    'products.product_id',
                    'products.product_name',
                    'products.categories',
                    'products.description',
                    'products.image',
                    'products.others_image',
                    'products.price',
                    'customers_details.discount_price',
                    'customers_details.order_quantity',
                    'products.min_order_quantity'
                )
                ->get();

            $products = $products->map(function ($product, $index) {
                $discounts = explode(',', $product->discount_price);
                $newIndex = $index % count($discounts);
                $product->discount_price = $discounts[$newIndex];
                if (!empty($product->order_quantity)) {
                    $discountOrderQuantities = explode(',', $product->order_quantity);
                    $discountOrderQuantitiesCount = count($discountOrderQuantities);
                    $newIndex = $index % $discountOrderQuantitiesCount;
                    $product->order_quantity = $discountOrderQuantities[$newIndex];
                }

                return $product;
            });

            $carts = Cart::join('products', 'products.product_id', '=', 'carts.product_id')->where('carts.email', auth()->user()->email)->get();
            $orders = Order::where('email', auth()->user()->email)->get();
            return view('users.products')->with(compact('products', 'carts', 'orders'));
                                                                                                                                                  
        } else {
            $products = DB::table('products')->join('categories', 'categories.category_name', '=', 'products.categories')->where('categories.access', '0')->get();
            return view('users.products')->with(compact('products'));
        }
    }

    public function product_details($product_id)
    {
        $recomendation_product = Product::all();
        if (auth()->check()) {
            
            $useremail = auth()->user()->email;

            $products = DB::table('products')
            ->leftJoin('customers_details', function ($join) {
                $join->on(DB::raw("FIND_IN_SET(products.product_id, customers_details.product_id)"), '>', DB::raw('0'))
                    ->where('customers_details.email', '=', auth()->user()->email);
            })
            ->select(
                'products.id',
                'products.product_id',
                'products.product_name',
                'products.categories',
                'products.description',
                'products.image',
                'products.others_image',
                'products.price',
                'customers_details.discount_price',
                'customers_details.order_quantity',
                'products.min_order_quantity'
            )
            ->where('products.product_id',$product_id)
            ->get();

        $product = $products->map(function ($product, $index) {
            $discounts = explode(',', $product->discount_price);

            $newIndex = $index % count($discounts);
            $product->discount_price = $discounts[$newIndex];
            if (!empty($product->order_quantity)) {
                $discountOrderQuantities = explode(',', $product->order_quantity);
                $discountOrderQuantitiesCount = count($discountOrderQuantities);
                $newIndex = $index % $discountOrderQuantitiesCount;
                $product->order_quantity = $discountOrderQuantities[$newIndex];
            }
            return $product;
        
        });

         //dd($product);
            $carts = Cart::join('products', 'products.product_id', '=', 'carts.product_id')->where('carts.email', auth()->user()->email)->get();
            return view('usernew.product-details')->with(compact('product', 'carts','recomendation_product'));
        } else {
            $product = DB::table('products')->where('product_id', $product_id)->get();
            return view('usernew.product-details')->with(compact('product','recomendation_product'));
        }
    }

    public function get_outlets(Request $request)
    {

        if ($request->outlet) {
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

                    if (array_key_exists($foundIndex, $pincode)) {
                        $pincode = trim($pincode[$foundIndex]);
                    }
                    if (array_key_exists($foundIndex, $gst)) {
                        $gst = trim($gst[$foundIndex]);
                    }

                    return response()->json(['pincode' => $pincode, 'outlet_name' => $outlet_name, 'delivery_address' => $deliveryAddress, 'phone' => $phoneNumber, 'email' => $outletEmail, 'state' => $state, 'city' => $city, 'relationship_manager' => $relationship_manager, 'outlet_spoc_number' => $outlet_spoc_number, 'outlet_spoc' => $outlet_spoc,'gst'=>$gst,'billing_address'=> $billingAddress]);
                } else {
                    echo "Value not found in the array";
                }

            } else {
                echo "Customer not found";
            }
        } else {
            $data = '<option value=""></option>';
            return response()->json(['data' => $data]);
        }
    }

    public function check_order_status(Request $request)
    {

        $credit_amount = 0;
        $latestOrder = Order::where('email', $request->customer_email)->where('payment_status', '0')->latest()->first();
        $customer = CustomerDetail::where('email', $request->customer_email)->first();
        $credit_amount = Order::where('email', $request->customer_email)->where('payment_status', '0')->sum('total_price');

        $warehouse=UserDetail::join('users','users.email','=','userdetails.email')
        ->where('users.roles','warehouse')
        ->where('city',$request->city)
        ->first();

        $available_credit_amount = $customer->credit_amount - $credit_amount;

        if ($credit_amount > $customer->credit_amount || $request->totalprice > $available_credit_amount) {
            return response()->json(['error' => 'This Customer Reached their Credit Amount!! Upto ' . $available_credit_amount . 'INR Booking we Allowed']);
        }

        if ($latestOrder) {
            $created_at = $latestOrder->created_at;
            $today_date = now();
            $countLastOrderDay = $today_date->diffInDays($created_at);
            if ($countLastOrderDay >= $customer->credit_period) {
                return response()->json(['error' => 'This Customer Reached their Credit Period!! Please Clear Dew bills']);
            }
        }


        foreach ($request->product_id as $key => $productId) {

            $productAvailable = ProductAvailability::where('product_id', $productId)->where('city', $request->city)->first();
            if (!$productAvailable) {
                $product = Product::where('product_id', $productId)->first();
                return response()->json([
                    'error' => 'The product ' . $product->product_name . ' Not Available on this City: ' . $request->city
                ]);
            }
        }

        foreach ($request->product_id as $key => $productId) {

            $product = Stock::join('products','products.product_id','=','stocks.product_id')
            ->where('stocks.warehouse',$warehouse->email)
            ->where('stocks.product_id', $productId)->first();
            
            if ($product && $product->stocks >= $request->moq[$key]) {
             
            }else {
                return response()->json([
                    'error' => 'Insufficient stock for ' . $product->product_name . '!! Available stocks: ' . max($product->stocks, 0)
                ]);
            }
        }
        



        return response()->json(['success'=>'Eligible']);
    }

    public function create_order(Request $request)
    {
    
        $orderId = rand();
        $warehouse=UserDetail::join('users','users.email','=','userdetails.email')
        ->where('users.roles','warehouse')
        ->where('city',$request->city)
        ->first();

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
        ]);
        foreach ($request->product_id as $key => $productId) {

            $product = Stock::join('products','products.product_id','=','stocks.product_id')
            ->where('stocks.warehouse',$warehouse->email)
            ->where('stocks.product_id', $productId)->first();
            
            if ($product && $product->stocks >= $request->moq[$key]) {
                $product->stocks -= $request->moq[$key];
                $product->sold += $request->moq[$key];
                $product->save();
            }else {
                return response()->json([
                    'error' => 'Insufficient stock for ' . $product->product_name . '!! Available stocks: ' . max($product->stocks, 0)
                ]);
            }
        }
        
        $orders->save();

         $url = url('order-details/'.$orders->id);
          return response()->json(['url' => $url]);
    }

    public function orders_details($id)
    {
        $order_details = Order::where('id', $id)->first();
        $rm = UserDetail::where('email', $order_details->relationship_manager)->first();
        $territory = UserDetail::where('email', $rm->territory_manager)->first();
        $carts=Cart::where('email',auth()->user()->email)->get();
        $customer=CustomerDetail::where('email',$order_details->email)->first();
      
         if ($order_details) {
            $product_ids = explode(',', $order_details->product_id);
            for ($i = 0; $i < count($product_ids); $i++) {
                $product_id = $product_ids[$i];
                $product_details = Product::where('product_id', $product_id)->first();
            }
        } else {
            echo "Order not found.";
        }
        return view('users.orders')->with(compact('order_details', 'product_details', 'territory','carts','customer'));
    }


    // public function about()
    // {
    //     $carts = Cart::join('products', 'products.product_id', '=', 'carts.product_id')->where('carts.email', auth()->user()->email)->get();
    //     return view('users.about')->with(compact('carts'));
    // }

    public function contact()
    {
       // $carts = Cart::join('products', 'products.product_id', '=', 'carts.product_id')->where('carts.email', auth()->user()->email)->get();
        return view('usernew.contact');
    }

    public function infrastructure()
    {
      return view('usernew.infrastructure');
    }
    public function contact_submit(Request $request)
    {
      
        Mail::send('contact-mail', ['name' => $request->name], function (Message $message) use ($request) {
            $message->to($request->email)
                ->subject('Contact Us');
        });
      
       // dd($request->message);
        Mail::send('contactclintmail', ['name' => $request->name,'email'=>$request->email,'phone'=>$request->phone,'company'=>$request->company,'mailMessage'=> $request->message], function (Message $message) use ($request) {
            $message->to('info@janiscare.com')
                ->subject('Contact Us');
        });
        return back();
    }

    public function forgetpassword()
    {
        return view('usernew.forgetpassword');
    }

    public function forget_password(Request  $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = User::where('email', $request->email)->where('roles', 'customer')
        ->update(['password' => Hash::make($request->password)]);

        Mail::send('resetpasswordemail', ['password' => $request->password], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return redirect('/user-login')->with('message', 'Your password has been changed!');
    }



    
}
