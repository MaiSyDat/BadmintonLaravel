<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
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

    public function details()
    {
        return $this->hasMany(orders_detail::class, 'order_id');
    }

    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
