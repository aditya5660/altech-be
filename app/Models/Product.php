<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'desc',
        'price',
        'image',
        'is_active',
        'is_featured',
        'category_id',
    ];

    // with
    protected $with = ['category'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
