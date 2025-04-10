<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Define the fillable attributes to allow mass assignment
    protected $fillable = [
        'name', 'email', 'phone', 'message',
    ];
}
