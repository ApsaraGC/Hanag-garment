<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'sub_total', 'discount', 'total_amount', 'order_type', 'status', 'description'];

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Define the relationship with the Product model
    public function products()
    {
        return $this->belongsTo(Product::class); // Assuming a many-to-many relationship
    }
}
