<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'status',
        'quantity',
        'total_price'
    ];
}
