<?php

namespace App\Exports;

use App\Models\ProductAvailability;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class ProductPincodeExport implements FromCollection, WithHeadings,WithMapping ,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProductAvailability::all();
    }
    public function map($data): array
    {
        return[
        $data->id,
        $data->product_id,
        $data->city,
        date('d-m-Y',strtotime($data->created_at)),
        date('d-m-Y',strtotime($data->updated_at)),
        ];
    }
    public function headings(): array
    {

        return [

            'Id',

            'Product Id',

            'City',

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
