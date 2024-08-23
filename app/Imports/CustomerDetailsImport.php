<?php
namespace App\Imports;

use App\Models\CustomerDetail;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
class CustomerDetailsImport implements ToCollection,WithStartRow
{
   /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
    public function collection(Collection $rows)
    {
      $password = rand();
      
        foreach ($rows as $row)
        {
         $customer = CustomerDetail::where('email',$row[5])->first();
         if($customer){
           $user = User::where('email',$row[5])->first();
           $user->name = $row[2];
           $user->roles = 'customer';
           $user->save();

           $customer = CustomerDetail::where('email',$row[5])->first();
           $customer->brand_name = $row[1];
           $customer->buisness_name = $row[2];
           $customer->company_name = $row[3];
           $customer->relationship_manager = $row[4];
           $customer->email = $row[5];
           $customer->spoc_name = $row[6];
           $customer->spoc_number = $row[7];
           $customer->credit_amount = $row[8];
           $customer->credit_period = $row[9];
           $customer->save();
         
      }else{
            User::create([
               'name' => $row[2],
               'email'=> $row[5],
               'roles'=> 'customer',
               'password'=> bcrypt($password),
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
               'credit_period' => $row[9],
            
           ]);
           
      }
        
      }
    }
   public function startRow(): int
   {
       return 2;
   }
}
