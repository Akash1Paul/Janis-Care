<?php
namespace App\Imports;

use App\Models\CustomerDetail;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithStartRow;
class ImportCustomer implements ToCollection,WithStartRow
{
   /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            User::create([
               'name' => $row[2],
               'email'=> $row[5],
               'roles'=> 'customer',
               'password'=> Hash::make('12345678'),  
           ]);
           CustomerDetail::create([
               'brand_name' => $row[1],
               'buisness_name' => $row[2],
               'company_name' => $row[3],
               'relationship_manager' => $row[4],
               'email' => $row[5],
               'spoc_name' => $row[6],
               'spoc_number' => $row[7],
               'credit_amount' => $row[8],
               'state' => $row[9],
               'city' => $row[10],
               'credit_period' => $row[11],
               'outlet_name' => $row[12],
               'outlet_spoc' => $row[13],
               'outlet_spoc_number' => $row[14],
               'phone' => $row[15],
               'gst' => $row[16],
               'product_id'=>$row[17],
               'discount_price' => $row[18],
               'order_quantity,'=> $row[19],
               'fda_license_number'=>$row[20], 
               'expirydate'=>$row[21], 
               'pincode'=>$row[22], 
               'billing_address'=>$row[23], 
               'delivery_address'=>$row[24], 
               'outlet_email'=>$row[25], 
               'note'=>$row[26], 
               'status'=>$row[27],
           ]);
           
      }
   }
   public function startRow(): int
   {
       return 2;
   }
}
