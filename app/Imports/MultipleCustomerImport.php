<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
class MultipleCustomerImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new CustomerDetailsImport(),
            1 => new CustomerOutletImport()
            ];
    }
}  
