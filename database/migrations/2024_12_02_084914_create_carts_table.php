<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('order_id')->nullable(); // Foreign Key (Nullable)
            $table->enum('status', ['pending', 'completed'])->default('pending'); // Default 'pending'
            $table->integer('quantity')->nullable();//antity of the product
            $table->decimal('price', 10, 2)->nullable(); // Product price (nullable)
            $table->unsignedBigInteger('product_id')->nullable(); // Foreign Key to Product (Nullable)
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign Key to User (Nullable)
            $table->timestamps(); // Created at, Updated at

            // Foreign key constraints
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};

