<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'note',
        'total_quantity',
        'status_payment',
        'status_transport',
        'total_discount',
        'total_price'
    ];
}
