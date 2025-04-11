<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products_img extends Model
{
    use HasFactory;
    protected $table = 'products_imgs';

    protected $fillable = ['product_id', 'name', 'path'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
