<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    //
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_name',
        'description',
        'short_description',
        'regular_price',
        'sale_price',
        'stock_status',
        'is_featured',
        'quantity',
        'image',
        'images',
        'color',
        'size',
        'category_id',
        'brand_id',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'regular_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'images' => 'array', // If stored as JSON
    ];

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    // app/Models/Product.php
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }



 // Accessor for average rating
 public function getAverageRatingAttribute()
 {
     return $this->reviews->avg('rating');
 }
}
