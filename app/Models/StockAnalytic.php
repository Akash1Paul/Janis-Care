<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAnalytic extends Model
{
    use HasFactory;
    protected $table = 'stock_analytics';
    protected $primarykey='id';
    protected $fillable = [
        'id',
        'product_id',
        'stocks',
        'sold',
    ];
}
