<?php

namespace App\Http\Controllers;

use App\Models\CustomerDetail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;

class RelationshipController extends Controller
{
    public function index()
    {
        $orders = CustomerDetail::join('orders','customers_details.email','=','orders.email' )->where('orders.relationship_manager','=',auth()->user()->email)->orderBy('customers_details.created_at', 'DESC')->get();
        return view('relationship.allOrderDetails')->with(compact('orders'));
    }


    public function filter_orders(Request $request)
    {
        $data = '';
        $orders = CustomerDetail::join('orders','customers_details.email','=','orders.email' )->where('orders.relationship_manager','=',auth()->user()->email)->Where('orders.status', $request->status)->orderBy('customers_details.created_at', 'DESC')->get();
        // dd($orders );
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

    public function orderdetails($id)
    {
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

        return view('relationship.orderDetails')->with(compact('order_details', 'product_details','territory'));
    }
    public function customer()
    {
        $customer = CustomerDetail::where('relationship_manager','=',auth()->user()->email)->join('users', 'customers_details.email', '=', 'users.email')->orderBy('customers_details.created_at', 'DESC')->get();

        return view('relationship.listCustomer')->with(compact('customer'));
    }
    public function filter_status($status)
    {
        if( $status == 'all')
        {
            $orders = CustomerDetail::join('orders','customers_details.email','=','orders.customer_name')->where('orders.relationship_manager','=',auth()->user()->email)->get()->toArray();
            return $orders;
        }
        else{
            $orders = CustomerDetail::join('orders','customers_details.email','=','orders.customer_name')->where('orders.relationship_manager','=',auth()->user()->email)
            ->where('orders.status', '=', $status)->get()->toArray();
            return $orders;
        }
    }

}
