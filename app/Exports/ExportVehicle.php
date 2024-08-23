<?php

namespace App\Exports;

use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportVehicle implements FromCollection, WithHeadings,WithMapping ,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Vehicle::all();
    }
    public function map($data): array
    {
        return[
        $data->id,
        $data->name,
        $data->number,
        $data->drivarname,
        $data->type,
        $data->warecity,
        $data->warename,
        $data->drivarnumber,
        date('d-m-Y',strtotime($data->created_at)),
        date('d-m-Y',strtotime($data->updated_at)),
        ];
    }
    public function headings(): array
    {

        return [

            'Id',

            'Vehicle Name',

            'Vehicle Number',

            'Driver Name',

            'Vehicle Type',

            'City',

            'Warehouse Email',

            'Phone Number',

            'Created At',

            'Updated At',

        ];

    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:M1')
                                ->getFont()
                                ->setBold(true);
            },
        ];
    }
}
