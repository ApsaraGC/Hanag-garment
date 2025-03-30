<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel's naming conventions)


    // Fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'product_id',
       
        'status',
        'total_amount',
    ];

    // Define relationships (if any)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
