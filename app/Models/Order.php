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
        return $this->belongsToMany(Product::class, 'order_items')
                    ->withPivot('quantity', 'price') // Include additional pivot fields
                    ->withTimestamps();
    }

    // Add the relationship method
    public function order_items()
    {
        return $this->hasMany(order_items::class); // Assuming the related model is OrderItem
    }

// In Order.php (Order model)
public function payment()
{
    return $this->hasOne(Payment::class); // or belongsTo depending on your schema
}
public function userCarts()
{
    return $this->hasMany(UserCart::class);
}
}
