<?php

namespace App\Exports;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportProduct implements FromCollection, WithHeadings,WithMapping ,WithEvents
{
  
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select('*')->get();
    }
    public function map($data): array
    {
        return[
        $data->id,
        $data->manufacturer,
        $data->brand_name,
        $data->product_id,
        $data->product_name,
        $data->image,
        $data->others_image,
        $data->min_order_quantity,
        $data->price,
        $data->packsize,
        $data->unit,
        $data->jsp,
        $data->description,
        $data->categories,
        $data->sub_categories,
        $data->sub_sub_categories,
        date('d-m-Y',strtotime($data->created_at)),
        date('d-m-Y',strtotime($data->updated_at)),
      
        ];
    }
    public function headings(): array
    {

        return [

            'Id',

            'Manufacturer',

            'Brand Name',

            'Product Id',

            'Product Name',

            'Image',

            'Other Image',

            'Minimum Order Quantity',

            'MRP',

            'Pack Size',

            'Unit',

            'JSP(Janis Sales Price)',

            'Description',

            'Categories',

            'Sub Categories',

            'Sub Sub Categories',

            'Created At',

            'Updated At',

        ];

    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:S1')
                                ->getFont()
                                ->setBold(true);
   
            },
        ];
    }
}
// select('id','brand_name','product_id','product_name','min_order_quantity','price','stocks','description','categories')->get()