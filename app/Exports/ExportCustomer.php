<?php

namespace App\Exports;

use App\Models\CustomerDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class ExportCustomer implements FromCollection,WithHeadings,WithMapping,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CustomerDetail::all();
    }
    public function map($data): array
    {
        return[
        $data->id,
        $data->brand_name,
        $data->buisness_name,
        $data->company_name,
        $data->relationship_manager,
        $data->email,
        $data->spoc_name,
        $data->spoc_number,
        $data->credit_amount,
        $data->credit_period,
        // $data->state,
        // $data->city,
       
        // $data->outlet_name,
        // $data->outlet_spoc,
        // $data->outlet_spoc_number,  
        // $data->phone,
        // $data->gst,
        // $data->product_id,
        // $data->discount_price,
        // $data->order_quantity,
        // $data->fda_license_number,
        // $data->expirydate,
        // $data->pincode,
        // $data->billing_address,
        // $data->delivery_address,
        // $data->outlet_email,
        // $data->note,
         $data->status,
        // date('d-m-Y',strtotime($data->created_at)),
        // date('d-m-Y',strtotime($data->updated_at)),
        ];
    }
    public function headings(): array
    {

        return [
            'Id',
            'Brand Name',
            'Buisness Name',
            'Company Name',
            'Relationship Manager Email',
            'Customer Email',
            'Spoc Name',
            'Spoc Number',
            'Credit Amount',
            'Credit Period',
            // 'State',
            // 'City',
           
            // 'Outlet Name',
            // 'Outlet Spoc',
            // 'Outlet Spoc Number',
            // 'Phone',
            // 'GST',
            // 'Product Id',
            // 'Discount Price',
            // 'Order Quantity',
            // 'FDA License number',
            // 'FDA Expiry Date',
            // 'Pin Code',
            // 'Billing Address',
            // 'Delivery Address',
            // 'Outlet Email',
            // 'Note',
             'Status',
            // 'Created At',
            // 'Updated At',
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
