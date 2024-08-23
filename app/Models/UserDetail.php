<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
class UserDetail extends Authenticatable implements CanResetPasswordContract
{
    use HasFactory;
    use CanResetPassword;
    protected $primarykey='id';
    protected $table='userdetails';
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
    protected $fillable = [
        'id',
        'empid',
        'name',
        'company_name',
        'warename',
        'email',
        'showpassword',
        'phone',
        'address',
        'workaddress',
        'homeaddress',
        'spoc_name',
        'vehicle',
        'runner',
        'state',
        'city',
        'pincode',
        'gst',	
        'warehouse_id',
        'product_id',
        'image',
        'addressproof',
        'discount_price',
        'order_quantity',
        'billing_address',
        'spoc_number',
        'photo',
        'territory_manager',
        'relationship_manager',
        'warehouse',
        'document',
        'delivery_address',
        'fda_certificate',
        'contact_person',
        'landline_number',
        'status',
        'note'	
    ];
    

}
