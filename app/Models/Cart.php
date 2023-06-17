<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_quantity'
    ];
}
