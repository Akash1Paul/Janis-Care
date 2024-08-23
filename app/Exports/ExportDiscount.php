<?php

namespace App\Exports;

use App\Models\CustomerDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
class ExportDiscount implements FromCollection,WithHeadings,WithMapping,WithEvents,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CustomerDetail::all();
    }
    public function title():string{
        return 'Outlets';
    }
    public function map($data1): array
    {
    $maindata = [];
    $customers = CustomerDetail::all();
   
    foreach ($customers as $item) {
        $email = $item->email;
        $product_id = explode(',', $item['product_id']);
        $discount_price = explode(',', $item->discount_price);
        $order_quantity = explode(',', $item['order_quantity']);
        $customer_name = $item->spoc_name;
        
        foreach ($discount_price as $key => $value) {
            $maindata[] = [
                'Email' => $email,
                'product_id' => $product_id[$key],
                'discount_price' => $value,
                'order_quantity' => $order_quantity[$key],
                'customer_name' => $customer_name,
            ];
        }
    }

    // Now $maindata contains the mapped values, you can return it or do something else with it
    return $maindata;
}
    public function headings(): array
    {

        return [
            'Email',
            'Product Id',
            'Discount Price',
            'Order Quantity',
            'Customer Name' 
        ];

    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:AD1')
                                ->getFont()
                                ->setBold(true);
            },
        ];
    }
}
