<?php

namespace App\Imports;

use App\Models\ProductAvailability;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
class ProductPincodeImport implements  ToCollection,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new ProductPincode([
    //         'product_id' => $row[1],
    //         'pincode' => $row[2],
    //         'updated_at'=>$row[3],
    //         'categories'=>$row[4],
    //     ]);
        
    // }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        { $city = ProductAvailability::where('city',$row[2])->first();
            if($city){
                $city = ProductAvailability::where('city',$row[2])->first();
                $city->product_id = $row[1];
                $city->pincode = $row[2];
               
            }else{
                ProductAvailability::create([
               'product_id' => $row[1],
               'city'=> $row[2],
           ]);
       
          
        } 
      }
   }
    public function startRow(): int
    {
        return 2;
    }
}
