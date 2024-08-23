<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
class ImportProduct implements ToCollection,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new Product([
    //         'id'=> $row[0],
    //         'brand_name' => $row[1],
    //         'product_id' => $row[2],
    //         'product_name' =>$row[3],
    //         'image'=>$row[4],
    //         'others_image'=>$row[5],
    //         'min_order_quantity'=>$row[6],
    //         'price'=>$row[7],
    //         'stocks'=>$row[8],
    //         'description'=>$row[9],
    //         'created_at'=>$row[10],
    //         'updated_at'=>$row[11],
    //         'categories'=>$row[12],
    //     ]);
        
    // }
    public function collection(Collection $rows)
    {
       $product_id_new =  str_replace(' ', '', 'JANIS' . rand(1000, 9999));
        foreach ($rows as $row)
        { $products = Product::where('product_id',$row[3])->first();
            if($products){
                $product = Product::where('product_id',$row[3])->first();
                $product->id = $row[0];
                $product->manufacturer = $row[1];
                $product->brand_name = $row[2];
                $product->product_id = $row[3];
                $product->product_name = $row[4];
                $product->image = $row[5];
                $product->others_image = $row[6];
                $product->min_order_quantity = $row[7];
                $product->price = $row[8];
                $product->packsize = $row[9];
                $product->unit = $row[10];
                $product->jsp = $row[11];
                $product->description = $row[12];
                $product->categories = $row[13];
                $product->sub_categories = $row[14];
                $product->sub_sub_categories = $row[15];
                $product->update();
            }else{
                Product::create([
                    'id'=> $row[0],
                    'manufacturer' => $row[1],
                    'brand_name' => $row[2],
                    'product_id' => str_replace(' ', '', 'JANIS' . rand(1000, 9999)),
                    'product_name' =>$row[4],
                    'image'=>$row[5],
                    'others_image'=>$row[6],
                    'min_order_quantity'=>$row[7],
                    'price'=>$row[8],
                    'packsize'=>$row[9],
                    'unit'=>$row[10],
                    'jsp'=>$row[11],
                    'description'=>$row[12],
                    'categories'=>$row[13],
                    'sub_categories'=>$row[14],
                    'sub_sub_categories'=>$row[15],
                    'created_at'=>$row[16],
                    'updated_at'=>$row[17],  
           ]); 
        } 
      }
   }
    public function startRow(): int
    {
        return 2;
    }
}
