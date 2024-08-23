<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $primarykey='id';
    protected $fillable = [
        'id',
        'brand_name',
        'product_id',
        'product_name',
        'image',
        'others_image',
        'min_order_quantity',
        'price',
        'stocks',
        'description',
        'categories',
        'sub_categories',
        'sub_sub_categories',
        'packsize',
        'unit',
        'jsp',
        'manufacturer',
    ];

 
    //     public function pincodes() {
    //         return $this->hasMany(ProductPincode::class);
        
    // }
}
