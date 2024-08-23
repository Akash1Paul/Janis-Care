<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable = [
        'order_id', // Add 'order_id' to the fillable attributes
        'outlet_name',
        'product_id',
        'moq',
        'price',
        'total_price',
        'delivery_address',
        'billing_address',
        'phone',
        'state',
        'city',
        'spoc_name',
        'spoc_number',
        'relationship_manager',
        'email',
        'status',
        'pincode',
        'gst',
        'MRP'
        
        // Add other fields as needed
    ];
}
