<?php
namespace App\Imports;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithStartRow;
class ImportRoles implements ToCollection,WithStartRow
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
        { $userdetails = UserDetail::where('email',$row[3])->first();
            if($userdetails){
                $user = User::where('email',$row[3])->first();
                $user->name = $row[2];
                $user->roles =  $row[18];
                $user->save();

                $userdetail = UserDetail::where('email',$row[3])->first();
                $userdetail->empid = $row[1];
                $userdetail->name = $row[2];
                $userdetail->email = $row[3];
                $userdetail->phone = $row[4];
                $userdetail->workaddress = $row[5];
                $userdetail->homeaddress = $row[6];
                $userdetail->spoc_name = $row[7];
                $userdetail->vehicle = $row[8];
                $userdetail->runner = $row[9];
                $userdetail->state = $row[10];
                $userdetail->city = $row[11];
                $userdetail->pincode = $row[12];
                $userdetail->spoc_number = $row[13];
                $userdetail->territory_manager = $row[14];
                $userdetail->relationship_manager = $row[15];
                $userdetail->warehouse = $row[16];
                $userdetail->note = $row[17];
                $userdetail->status = $row[19];
                $userdetail->save();
            }else{
            User::create([
               'name' => $row[2],
               'email'=> $row[3],
               'roles'=> $row[18],
               'password'=> bcrypt($password),  
           ]);
       
           UserDetail::create([
               'empid' => $row[1],
               'name' => $row[2],
               'email' => $row[3],
               'phone' => $row[4],
               'workaddress' => $row[5],
               'homeaddress' => $row[6],
               'spoc_name' => $row[7],
               'vehicle' => $row[8],
               'runner' => $row[9],
               'state' => $row[10],
               'city' => $row[11],
               'pincode' => $row[12],
               'spoc_number' => $row[13],
               'territory_manager' => $row[14],
               'relationship_manager' => $row[15],
               'warehouse'=> $row[16],
               'note' => $row[17],
               'status' => $row[19],
               'showpassword'=> $password, 
               'status'=>'NotApproved',
           ]);
        } 
      }
   }
   public function startRow(): int
   {
       return 2;
   }
}
