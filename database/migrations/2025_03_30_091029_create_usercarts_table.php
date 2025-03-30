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
        Schema::create('usercarts', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->integer('quantity')->nullable(); // Quantity of the product
            $table->decimal('price', 10, 2)->nullable(); // Product price (nullable)
            $table->unsignedBigInteger('product_id')->nullable(); // Foreign Key to Product (Nullable)
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign Key to User (Nullable)
            $table->timestamps(); // Created at, Updated at

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('usercarts');
    }
};
