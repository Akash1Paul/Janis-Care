<?php

namespace App\Exports;

use App\Models\CustomerDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
class CustomerOutletExport implements FromCollection,WithHeadings,WithMapping,WithEvents,WithTitle
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
            $state = explode(',', $item->state);
            $city = explode(',', $item->city);
            $outlet_name = explode(',', $item->outlet_name);
            $outlet_spoc = explode(',', $item->outlet_spoc);
            $outlet_spoc_number = explode(',', $item->outlet_spoc_number);
            $phone = explode(',', $item->phone);
            $gst = explode(',', $item->gst);
            $fda_license_number = explode(',', $item->fda_license_number);
            $issuedate = explode(',', $item->issuedate);
            $expirydate = explode(',', $item->expirydate);
            $pincode = explode(',', $item->pincode);
            $billing_address = explode(',', $item->billing_address);
            $delivery_address = explode(',', $item->delivery_address);
            $outlet_email = explode(',', $item->outlet_email);
            $note = explode(',', $item->note);
            $customer_name = $item->spoc_name;

            $count = count($outlet_name);
    
            for ($i = 0; $i<$count; $i++) {
                              
                $maindata[] = [
                    'Id' => $email,
                    'state' => isset($state[$i]) ? $state[$i] : null,
                    'city' => isset($city[$i]) ? $city[$i] : null,
                    'outlet_name' => isset($outlet_name[$i]) ? $outlet_name[$i] : null,
                    'outlet_spoc' => isset($outlet_spoc[$i]) ? $outlet_spoc[$i] : null,
                    'outlet_spoc_number' => isset($outlet_spoc_number[$i]) ? $outlet_spoc_number[$i] : null,
                    'phone' => isset($phone[$i]) ? $phone[$i] : null,
                    'gst' => isset($gst[$i]) ? $gst[$i] : null,
                    'fda_license_number' => isset($fda_license_number[$i]) ? $fda_license_number[$i] : null,
                    'issuedate' => isset($issuedate[$i]) ? $issuedate[$i] : null,
                    'expirydate' => isset($expirydate[$i]) ? $expirydate[$i] : null,
                    'pincode' => isset($pincode[$i]) ? $pincode[$i] : null,
                    'billing_address' => isset($billing_address[$i]) ? $billing_address[$i] : null,
                    'delivery_address' => isset($delivery_address[$i]) ? $delivery_address[$i] : null,
                    'outlet_email' => isset($outlet_email[$i]) ? $outlet_email[$i] : null,
                    'note' => isset($note[$i]) ? $note[$i] : null,
                    'customer_name' => $customer_name,
                ];
               
            }    
    }
    // echo '<pre>';
    // print_r($maindata);  
    //dd(count($maindata));
        // Now $maindata contains the mapped values without duplication
    
    return $maindata;
      
    }
    // public function map($data1): array
    // {
    //     $maindata = [];
    //     $customers = CustomerDetail::all();
      
    //     foreach ($customers as $item) {
    //         $email = $item->email;
    //         $state = explode(',', $item->state);
    //         $city = explode(',', $item->city);
    //         $outlet_name = explode(',', $item->outlet_name);
    //         $outlet_spoc = explode(',', $item->outlet_spoc);
    //         // ... (similar for other fields)
    
    //         $count = count($outlet_name);
    
    //         for ($i = 0; $i < $count; $i++) {
    //             $uniqueIdentifier = $email . '_' . $i; // Use a combination of email and outlet index as a unique identifier
    
    //             // Debugging statement
              
    //             $maindata[$uniqueIdentifier] = [
    //                 'Id' => $email,
    //                 'state' => isset($state[$i]) ? $state[$i] : null,
    //                 'city' => isset($city[$i]) ? $city[$i] : null,
    //                 'outlet_name' => isset($outlet_name[$i]) ? $outlet_name[$i] : null,
    //                 'outlet_spoc' => isset($outlet_spoc[$i]) ? $outlet_spoc[$i] : null,
    //                 // ... (add other fields similarly)
    //             ];
    //         }
    //     }
    
    //     // Now $maindata contains the mapped values without duplication
    //     return array_values($maindata); // Reset array keys to ensure numeric keys
    // }
    public function headings(): array
    {

        return [
            'Customer Email',
            'State',
            'City',
            'Outlet Name',
            'Outlet Spoc',
            'Outlet Spoc Number',
            'Phone',
            'GST',
            'FDA License number',
            'FDA Issue Date',
            'FDA Expiry Date',
            'Pin Code',
            'Billing Address',
            'Delivery Address',
            'Outlet Email',
            'Note',
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
