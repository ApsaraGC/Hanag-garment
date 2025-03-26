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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
             // 'description' stores a long description of the product, nullable
            $table->text('description')->nullable();
            $table->string('short_description');
            $table->decimal('regular_price');
            $table->decimal('sale_price')->nullable();
             // 'stock_status' is an enum that can either be 'instock' or 'outofstock'
            $table->enum('stock_status',['instock','outofstock']);
            $table->boolean('is_featured')->default(false);
            // 'quantity' stores the number of items in stock (default 10)
            $table->unsignedInteger('quantity')->default(10);
            $table->string('image')->nullable();
            $table->text('images')->nullable();
            $table->string('color')->nullable();
            $table->integer('size')->nullable();
            // 'category_id' stores the ID of the associated category, references 'id' in 'categories' table
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
