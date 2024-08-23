<?php
namespace App\Imports;

use App\Models\CustomerDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
class DiscountImport implements ToCollection,WithStartRow
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
        $product_id = $row[1];
        $discount_price = $row[2];
        $order_quantity = $row[3];

        if (!isset($emailGroups[$email])) {
            $emailGroups[$email] = [
                'product_id' => [],
                'discount_price' => [],
                'order_quantity' => [],
            ];
        }

        $emailGroups[$email]['product_id'][] = $product_id;
        $emailGroups[$email]['discount_price'][] = $discount_price;
        $emailGroups[$email]['order_quantity'][] = $order_quantity;
       
       
    }

    foreach ($emailGroups as $email => $data) {
        CustomerDetail::where('email', $email)->update([
            'product_id' => implode(',', $data['product_id']),
            'discount_price' => implode(',', $data['discount_price']),
            'order_quantity' => implode(',', $data['order_quantity']),
        ]);
    }
}
 public function startRow(): int
   {
       return 2;
   }
}
