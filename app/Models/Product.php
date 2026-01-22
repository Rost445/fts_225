<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   use HasFactory;
   
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'brand_id',
        'SKU',
        'quantity',
        'stock_status',
        'regular_price',
        'sale_price',
        'short_description',
        'description',
        'featured',
        'image',
        'images',
    ];

   
    public function category()
    {
         return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
         return $this->belongsTo(Brand::class, 'brand_id');
    }

}
