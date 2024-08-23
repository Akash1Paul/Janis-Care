<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAvailability extends Model
{
    use HasFactory;

    protected $table = 'product_availabilities';
    protected $primarykey = 'id';

    protected $fillable = ['id','product_id', 'city','created_at','updated_at'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
