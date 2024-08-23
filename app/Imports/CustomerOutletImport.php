<?php
namespace App\Imports;

use App\Models\CustomerDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
class CustomerOutletImport implements ToCollection,WithStartRow
{
   /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function collection(Collection $rows)
{
    $emailGroups = [];

    foreach ($rows as $row) {
        $email = $row[0];
        $state = $row[1];
        $city = $row[2];
        $outletName = $row[3];
        $outletSpoc =  $row[4];
        $outlet_spoc_number = $row[5];
        $phone = $row[6];
        $gst = $row[7];
        $fda_license_number = $row[8];
        $issuedate = $row[9];
        $expirydate = $row[10];
        $pincode = $row[11];
        $billing_address = $row[12];
        $delivery_address = $row[13];
        $outlet_email = $row[14];
        $note = $row[15];

        if (!isset($emailGroups[$email])) {
            $emailGroups[$email] = [
                'state' => [],
                'city' => [],
                'outletName' => [],
                'outletSpoc' => [],
                'outlet_spoc_number' => [],
                'phone' => [],
                'gst' => [],
                'fda_license_number' => [],
                'issuedate' => [],
                'expirydate' => [],
                'pincode' => [],
                'billing_address' => [],
                'delivery_address' => [],
                'outlet_email' => [],
                'note' => [],

            ];
        }

        $emailGroups[$email]['state'][] = $state;
        $emailGroups[$email]['city'][] = $city;
        $emailGroups[$email]['outletName'][] = $outletName;
        $emailGroups[$email]['outletSpoc'][] = $outletSpoc;
        $emailGroups[$email]['outlet_spoc_number'][] = $outlet_spoc_number;
        $emailGroups[$email]['phone'][] = $phone;
        $emailGroups[$email]['gst'][] = $gst;
        $emailGroups[$email]['fda_license_number'][] = $fda_license_number;
        $emailGroups[$email]['issuedate'][] = $issuedate;
        $emailGroups[$email]['expirydate'][] = $expirydate;
        $emailGroups[$email]['pincode'][] = $pincode;
        $emailGroups[$email]['billing_address'][] = $billing_address;
        $emailGroups[$email]['delivery_address'][] = $delivery_address;
        $emailGroups[$email]['outlet_email'][] = $outlet_email;
        $emailGroups[$email]['note'][] = $note;
       
    }

    foreach ($emailGroups as $email => $data) {
        CustomerDetail::where('email', $email)->update([
            'state' => implode(',', $data['state']),
            'city' => implode(',', $data['city']),
            'outlet_name' => implode(',', $data['outletName']),
            'outlet_spoc' => implode(',', $data['outletSpoc']),
            'outlet_spoc_number' => implode(',', $data['outlet_spoc_number']),
            'phone' => implode(',', $data['phone']),
            'gst' => implode(',', $data['gst']),
            'fda_license_number' => implode(',', $data['fda_license_number']),
            'issuedate' => implode(',', $data['issuedate']),
            'expirydate' => implode(',', $data['expirydate']),
            'pincode' => implode(',', $data['pincode']),
            'billing_address' => implode(',', $data['billing_address']),
            'delivery_address' => implode(',', $data['delivery_address']),
            'outlet_email' => implode(',', $data['outlet_email']),
            'note' => implode(',', $data['note']),  
        ]);
    }
}
 public function startRow(): int
   {
       return 2;
   }
}
