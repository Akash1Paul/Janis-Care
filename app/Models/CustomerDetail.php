<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    use HasFactory;
    protected $table='customers_details';
    protected $primarykey='id';
    protected $fillable = [
        'brand_name',
        'buisness_name',
        'company_name',
        'relationship_manager',
        'email',
        'spoc_name',
        'spoc_number',
        'credit_amount',
        'photo',
        'state',
        'city',
        'credit_period',
        'outlet_name',
        'outlet_spoc',
        'outlet_spoc_number',
        'phone',
        'gst',
        'product_id',
        'discount_price',
        'order_quantity',
        'document',
        'fda_license_number',
        'expirydate',
        'pincode',
        'billing_address',
        'delivery_address',
        'outlet_email',
        'note',
        'status',
        'created_at',
        'updated_at'
    ];

}
