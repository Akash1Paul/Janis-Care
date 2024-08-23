<?php

namespace App\Exports;

use App\Models\UserDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportRoles implements FromCollection,WithHeadings,WithMapping ,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserDetail::join('users','userdetails.email','=','users.email')->select('userdetails.id','empid','userdetails.name','userdetails.email','phone','workaddress','homeaddress','spoc_name','vehicle','runner','state','city','pincode','spoc_number','territory_manager','relationship_manager','warehouse','note','roles','status','userdetails.created_at','userdetails.updated_at')->get();
    }
    public function map($data): array
    {
        return[
        $data->id,
        $data->empid,
        $data->name,
        $data->email,
        $data->phone,
        $data->workaddress,
        $data->homeaddress,
        $data->spoc_name,
        $data->vehicle,
        $data->runner,
        $data->state,
        $data->city,
        $data->pincode,
        $data->spoc_number,
        $data->territory_manager,
        $data->relationship_manager,
        $data->warehouse,
        $data->note,
        $data->roles,
        $data->status,
        date('d-m-Y',strtotime($data->created_at)),
        date('d-m-Y',strtotime($data->updated_at)),
       
        ];
    }
    public function headings(): array
    {

        return [

            'Id',

            'Employee Id',

            'Name',

            'Email',

            'Phone',

            'Work Address',

            'Home Address',

            'Spoc Name',

            'Vehicle',

            'Runner',

            'State',

            'City',

            'Pin Code',

            'Spoc Number',

            'Territory Manager',

            'Relationship Manager',

            'Warehouse Email',

            'Note',

            'Roles',

            'Status',

            'Created At',

            'Updated At',

        ];

    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:V1')
                                ->getFont()
                                ->setBold(true);
   
            },
        ];
    }
}
