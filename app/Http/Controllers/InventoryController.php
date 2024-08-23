<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Stock;
use App\Models\UserDetail;
use Carbon\Carbon;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Date;

class InventoryController extends Controller
{


    public function orders()
    {
        $layout = 0;
        $orders = Order::all();
        return view('inventory.orders')->with(compact('orders', 'layout'));
    }


    public function stocks()
    {
        $user_details=UserDetail::where('email',auth()->user()->email)->first();
        $warehoue_name = UserDetail::where('email',$user_details->warehouse_inventory)->first();
        $stocks = Stock::join('products','products.product_id','=','stocks.product_id')
        ->where('stocks.warehouse','=',$user_details->warehouse_inventory)->get();
        $categories = Category::all();
        $batch_id = stock::get()->last();
    //dd( $stocks );
        $layout = 0;
        return view('inventory.stocks')->with(compact('stocks', 'layout', 'categories','batch_id','warehoue_name'));
    }



    public function filter_stocks(Request $request)
    {
        $user_details=UserDetail::where('email',auth()->user()->email)->first();


        if ($request->category) {
            $products =  Stock::join('products','products.product_id','=','stocks.product_id')
            ->where('products.categories',$request->category)
            ->where('stocks.warehouse','=',$user_details->warehouse_inventory)->get();
        } else {
            $products =  Stock::join('products','products.product_id','=','stocks.product_id')
            ->where('stocks.warehouse','=',$user_details->warehouse_inventory)->get();
        }

        $data = '';

        foreach ($products as $key => $item) {

            $data .= '<tr rowspan="2">
                <td class="mt-2 mr-2">' . ($key + 1) . '</td>
                <td>' . $item->product_id . '</td>
                <td>' . $item->product_name . '</td>
                <td>' . $item->categories . '</td>
                <td>' . $item->stocks . '</td>
                <td><img src="' . url("image/" . $item->image) . '" style="width:50px;height:50px;border-radius:50%" alt=""></td>
                <td><a href="' . url("inventory/stocks-details/" . $item->id) . '">
                        <button type="button"
                            class="btn btn-primary waves-effect waves-light">
                            <i class="fas fa-eye"></i></button>
                    </a></td>
                <td>                    
                </tr>';
        
            }

        return response()->json(['data' => $data]);
    }



    public function upgrade_stocks(Request $request)
    {
        $stock = Stock::where('product_id', $request->product_id)->first();
        $randomNumber = random_int(100000, 999999);
        $batch_id = Carbon::now()->format('y').'H2'.$randomNumber;
        if ($stock) {
        
            $barcode = new DNS1D();
            $barcodeFolder = 'barcodes';
            $barcode->setStorPath(public_path($barcodeFolder)); 
            $barcodeValue = $stock->updated_at;
            $barcodePath = $barcode->getBarcodePNGPath($barcodeValue, 'C128');
            $stock->barcode_path = basename($barcodePath);
            $stock->max_stocks = $stock->stocks + $request->stocks;
            $stock->stocks += $request->stocks;
            $stock->batch_id=$request->stockcategory=='new'?$batch_id:$stock->batch_id;
            $stock->update();
        }

        // if($request->stockcategory=='new')
        // {  
        //     $stocks->product_id = $request->product_id;
        //     $stocks->num_of_prod =  $request->stocks;
        //     $stocks->batch_id = $batch_id;
        //     $stocks->save();
        // }
        // else{  
        //     $stocks->product_id = $request->product_id;
        //     $stocks->num_of_prod =  $request->stocks;
        //     $stocks->batch_id = $request->stockcategory;
        //     $stocks->save();
        // }

        return response()->json(['message' => 'stocks updated'], 200);
    
    }





}

