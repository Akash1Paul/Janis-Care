<?php

namespace App\Imports;

use App\Models\Vehicle;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
class ImportVehicle implements ToCollection,WithStartRow    
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Vehicle([
            'name' => $row[1],
            'number' => $row[2],
            'drivarname' =>$row[3],
            'type'=>$row[4],
            'warecity'=>$row[5],
            'warename'=>$row[6],
            'drivarnumber'=>$row[7],
            'created_at'=>$row[8],
            'updated_at'=>$row[9]
        ]);
    }
    public function collection(Collection $rows)
    {
       
        foreach ($rows as $row)
        { $vehicles = Vehicle::where('number',$row[2])->first();
            if($vehicles){
                $vehicle = Vehicle::where('number',$row[2])->first();
                $vehicle->name = $row[1];
                $vehicle->number = $row[2];
                $vehicle->drivarname = $row[3];
                $vehicle->type = $row[4];
                $vehicle->warecity = $row[5];
                $vehicle->warename = $row[6];
                $vehicle->drivarnumber = $row[7];
            }else{
                Vehicle::create([
                    'name' => $row[1],
                    'number' => $row[2],
                    'drivarname' =>$row[3],
                    'type'=>$row[4],
                    'warecity'=>$row[5],
                    'warename'=>$row[6],
                    'drivarnumber'=>$row[7],
           ]); 
        } 
      }
   }
    public function startRow(): int
    {
        return 2;
    }
}
