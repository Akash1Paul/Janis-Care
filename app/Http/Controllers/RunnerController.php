<?php

namespace App\Http\Controllers;

use App\Models\CustomerDetail;
use App\Models\DeliveryList;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Vehicle;
use Exception;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;
use GuzzleHttp\Exception\GuzzleException;

class RunnerController extends Controller
{
   public function login()
   {
      return view('runner.login');
   }

   public function runnerLogin(Request $request)
   {
      
      if ($request->isMethod('post')) {
         $request->validate([
             'email' => 'required',
             'password' => 'required',
         ]);
         $credentials = $request->only('email', 'password');
      
         $runner = User::where('email', $credentials['email'])->first();

         if ($runner && $runner->roles == 'runner') {
        
             if ($runner->roles == 'runner') { 
              
                 // Assuming role field contains the role of the user.
                 Auth::login($runner);
                
                 return redirect('runner/order');
             } else {
                 return redirect()->back()->withErrors(['msg' => 'Invalid Credentials']);
             }
         } else {
             return redirect()->back()->withErrors(['msg' => 'Invalid Credentials']);
         }
     } else {
         return view('runner.login');
     }
   }
   
   public function index()
   {
        $delivery_list = DeliveryList::where('delivery_list.runner',Auth()->user()->email)->get(); 
        $orders = [];
        $vehicle = [];
        foreach($delivery_list as $delivery){
          
            $orders[] = DeliveryList::join('orders','delivery_list.order_id','=','orders.order_id')->where('delivery_list.order_id',$delivery->order_id)->orderBy('delivery_list.created_at','desc')->get()->toArray();

            $vehicle []= DeliveryList::join('vehicle','delivery_list.vehicle','=','vehicle.number')->where('delivery_list.vehicle',$delivery->vehicle)->get()->toArray();
         
        }
       //dd($orders);
        return view('runner.order')->with(compact('orders','vehicle'));
   
   
    }


   public function orders_details($id)
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


       return view('runner.orderDetails')->with(compact('layout', 'order_details', 'product_details','territory'));
   }
   public function changestatus(Request $request)
   {
       $orders = Order::where('order_id', '=', $request->order_id)->first();
      
       $orders->status = $request->status;
       $orders->updated_at =  date('Y-m-d H:i:s');
       $orders->update();

       return redirect('runner/order')->with('status', ' Updated Successfully.');
   }


   protected $code, $smsVerifcation;
   function __construct()
    {
    $this->smsVerifcation = new \App\Models\SmsVerification();
    }
   public function store(Request $request)
   {
   $code = rand(100000, 999999); //generate random code
   $request['code'] = $code;
   $request['contact_number'] = $request->phonenumber; //add code in $request body
   $this->smsVerifcation->store($request); //call store method of model
   return $this->sendSms($request); // send and return its response
   if($this->sendSms($request))
   {
    return response()->json(["success" => "OTP is send"]);
   }
   else{
    return response()->json(["error" => "OTP Not is send"]);
   }
   }
  
    
   public function sendSms(Request $request)
   {
    $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
    $authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
   try
    {
    $client = new Client($accountSid, $authToken);
    $result = $client->messages->create(
        // The number you'd like to send the message to
        $request->contact_number,
        [
            // A Twilio phone number you purchased at https://console.twilio.com
            'from' => '+17653990254',
            // The body of the text message you'd like to send
            'body' => 'CODE: '. $request->code, //set message body
        ]
    );
   
    return $result;
    }
    catch (Exception $e)
    {
    echo "Error: " . $e->getMessage();
    }
   }
   public function verifyContact(Request $request)
   {
 
   $smsVerifcation = 
  $this->smsVerifcation::where('contact_number','=',
  $request->contact_number)
   ->latest() //show the latest if there are multiple
   ->first();
  if($request->code == $smsVerifcation->code)
   {
   $request["status"] = 'verified';
   $smsVerifcation->updateModel($request);
   $msg["message"] = "verified";

   $orders = Order::where('order_id', '=', $request->order_id)->first();
      
   $orders->status = $request->status2;
   $orders->updated_at =  date('Y-m-d H:i:s');
   $orders->update();
   return $msg;
   }
   else
   {
   $msg["message"] = "not verified";
   return $msg;
   }
  }
   public function remarks(Request $request)
   {
    $orders = Order::where('order_id', '=', $request->order_id)->first();
      
    $orders->remarks = $request->remark;
    $orders->update();

    return redirect('runner/order')->with('status', ' Updated Successfully.');
   }
  
}
