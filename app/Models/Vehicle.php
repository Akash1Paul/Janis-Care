<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table='vehicle';
    protected $primarykey='id';
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'number',
        'drivarname',
        'type',
        'warecity',
        'warename',
        'drivarnumber',
        'created_at',
        'updated_at',
    ];
}
