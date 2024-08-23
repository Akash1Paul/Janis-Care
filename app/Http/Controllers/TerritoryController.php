<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Vehicle;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Carbon\Carbon;
use App\Models\CustomerDetail;
use App\Models\Order;

class TerritoryController extends Controller
{
    public function index()
    {
        $territorydetails = UserDetail::where('userdetails.email','=',auth()->user()->email)->get();
        foreach($territorydetails as $relation)
        {
            $relationship = $relation->relationship_manager;
        }
        $orders = CustomerDetail::join('orders','customers_details.email','=','orders.email' )->where('orders.relationship_manager','=',$relationship)->orderBy('customers_details.created_at', 'DESC')->get();
        return view('territory.allOrderDetails')->with(compact('orders'));
    }
    public function filter_orders(Request $request)
    {
        $data = '';
        $territorydetails = UserDetail::where('userdetails.email','=',auth()->user()->email)->get();
        foreach($territorydetails as $relation)
        {
            $relationship = $relation->relationship_manager;
        }
        $orders = CustomerDetail::join('orders','customers_details.email','=','orders.email' )->where('orders.relationship_manager','=',$relationship)->where('orders.status', $request->status)->orderBy('customers_details.created_at', 'DESC')->get();
     
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
            <td>' . $value->relationship_manager . '</td>
            <td>' . $value->spoc_name . '</td>
            
            <td>' . $value->delivery_address . '</td>
            <td>' . $diff_days . ' Days'. '</td>
            <td>
                <a
                    href="' . url("relation/orders-details/" . $value->id) . '">
                    <button type="button"
                        class="btn btn-primary waves-effect waves-light">
                        <i class="fas fa-eye"></i></button>
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
    public function correction()
    {
        $territorydetails = UserDetail::where('userdetails.email','=',auth()->user()->email)->get();
        foreach($territorydetails as $relation)
        {
            $city = $relation->city;
        }
       
        $customers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')
        ->where('users.roles', '=', 'customer')
        ->where('customers_details.city', '=', $city )
        ->where('customers_details.status', '=','NotApproved')
        ->orWhere('customers_details.status', '=','Correction')
        ->orderBy('customers_details.created_at', 'DESC')
        ->get(); 
       
        $days = [];
        foreach($customers as $customer)
        {
            $toDate = Carbon::createFromFormat('Y-m-d H:s:i', $customer->created_at);
            $fromDate = Carbon::now();
            $days[] = $toDate->diffInDays($fromDate);
        }
        $approvedcustomers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')
        ->where('users.roles', '=', 'customer')
        ->where('customers_details.status', '=','Approved')
        ->where('customers_details.city', '=', $city )
        ->orderBy('customers_details.created_at', 'DESC')
        ->get(); 
     
        $appdays = [];
        foreach($approvedcustomers as $approvedcustomer)
        {
            $toDate = Carbon::createFromFormat('Y-m-d H:s:i', $approvedcustomer->created_at);
            $fromDate = Carbon::now();
            $appdays[] = $toDate->diffInDays($fromDate);
        }

        
        return view('territory.approval')->with(compact('customers','days','approvedcustomers','appdays'));
    }
    public function listofrm()
    {
        $territorydetails = UserDetail::where('userdetails.email','=',auth()->user()->email)->get();
        foreach($territorydetails as $relation)
        {
            $city = $relation->city;
        }
       
        $relationship_managers = User::where('roles','=','relationship')->join('userdetails', 'userdetails.email', '=', 'users.email')->orderBy('userdetails.created_at', 'DESC')->where('userdetails.city', '=', $city )->get();
        $customer = User::where('roles','=','customer')->join('customers_details', 'customers_details.email', '=', 'users.email')->orderBy('customers_details.created_at', 'DESC')->get();
        $data = [];
        $count  = [];
        $totalcustomer = [];
        foreach($relationship_managers as $realation)
        {
            foreach ($customer as $customers){
                if($customers->relationship_manager == $realation->email)
                {
                    $data +=  explode(" ",$customers->relationship_manager);
                    $count[] = count($data);
                    $totalcustomer[] = count($count);
                  
                }
            }
        }
        return view('territory.listRM')->with(compact('relationship_managers','customer','totalcustomer'));
    }
    public function productforOrder()
    {
        $products = Product::all();
        return view('territory.productforOrder')->with(compact('products'));
    }
    public function productDetails($id)
    {
        $products = Product::find($id);
        return view('territory.productDetails')->with(compact('products'));;
    }
    public function orderDetails($id)
    {
        $layout = 3;
        $order_details = Order::where('id', $id)->first();
        $territory = UserDetail::where('relationship_manager',$order_details['relationship_manager'])->first();

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

        return view('territory.orders')->with(compact('layout', 'order_details', 'product_details','territory'));;
    }
    public function customerapproval(Request $request, $email)
    {
        $customers = CustomerDetail::join('users', 'customers_details.email', '=', 'users.email')->where('customers_details.email', '=', $email)->first();
        return view('territory.approvalCustomerDetails')->with(compact('customers'));  
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
        
        Mail::send('email', ['email' => $request->email, 'password' => ''], function (Message $message) use ($request) {
            $message->to($request->email)
                ->subject('You Are Approved');
        });
        return redirect('territory/correction')->with('status', 'Customer Updated Successfully.');
    }
    public function add_to_carts(Request $request)
    {
        
        $carts = Cart::where('product_id', $request->product_id)->where('email', auth()->user()->email)->first();
        if (!$carts) {
            $cart = new Cart;
            $cart->product_id = $request->product_id;
            $cart->email = auth()->user()->email;
            $cart->save();
            return response()->json(["success" => "Item add to cart"]);
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
    public function carts(Request $request)
    {
        $carts = Cart::join('products', 'carts.product_id', '=', 'products.product_id')->where('carts.email', Auth()->user()->email)->get();
        $layout = 0;
        $customers = CustomerDetail::all();
        return view('territory.cart')->with(compact('layout', 'carts', 'customers'));
    }

}
