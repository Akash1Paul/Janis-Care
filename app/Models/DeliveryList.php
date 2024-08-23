<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryList extends Model
{
    protected $table='delivery_list';
    protected $primarykey='id';
    use HasFactory;
}
