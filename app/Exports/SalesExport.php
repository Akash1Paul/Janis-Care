<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class SalesExport implements FromCollection,WithHeadings,WithMapping ,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  Order::where('status', 'Delivered')->whereYear('created_at', '=', date('Y'))->orderBy('created_at', 'DESC')->get();
    }
    public function map($data): array
    {
        $ordersperday = [];
        $count = 0;
        $ordersperday = explode(',', $data['moq']);
        foreach ($ordersperday as $info) {
            $count += $info;
        }
        return[
        date('d-m-Y',strtotime($data->updated_at)),
        $data->outlet_name,
        $data->product_id,
        $count,
        round($data->total_price),
        round($data->total_price + round(($data->total_price)*6/100) *2)
        ];
    }
    public function headings(): array
    {

        return [

            'Date',

            'Customer',

            'Product Id',

            'QTY',

            'Amount ( Without GST )',

            'Amount ( With GST )'

        ];

    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:M1')
                                ->getFont()
                                ->setBold(true);
            },
        ];
    }
}
