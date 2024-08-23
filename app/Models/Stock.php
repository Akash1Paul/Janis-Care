<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stocks';
    protected $primarykey='id';
    protected $fillable = [
        'id',
        'warehouse',
        'batch_id',
        'product_id',
        'quantity',
        'sold',
        'purchase_id',
    ];
}
