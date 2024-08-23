<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleCustomerExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        return [
        'Customer' => new CustomerDeatilsExport(),
        'Outlet' => new CustomerOutletExport()
        ];
    }
    
}
