<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    // Accessor cho status_badge_class
    public function getStatusBadgeClassAttribute()
    {
        return $this->status == 0 ? 'border-danger text-danger' : 'border-success text-success';
    }

    // Accessor cho status_name
    public function getStatusNameAttribute()
    {
        return $this->status == 0 ? 'Ngưng hoạt động' : 'Hoạt động';
    }
}
