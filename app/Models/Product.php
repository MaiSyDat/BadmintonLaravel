<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'sale',
        'hot',
        'description',
        'content',
        'img',
        'status',
        'total_pay',
        'categories_id'
    ];
    // Accessor cho status_badge_class
    public function getStatusBadgeClassAttribute()
    {
        return $this->status == 0 ? 'border-danger text-danger' : 'border-success text-success';
    }

    // Accessor cho status_name
    public function getStatusNameAttribute()
    {
        return $this->status == 0 ? 'Hết hàng' : 'Còn hàng';
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'categories_id');
    }

    public function getFormattedPrice()
    {
        return number_format($this->price, 0, ',', '.') . ' VNĐ';
    }

    // Hàm tính giá sau khi giảm
    public function getDiscountedPrice()
    {
        return $this->price - ($this->price * ($this->sale / 100));
    }
}
