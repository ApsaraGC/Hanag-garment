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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();// Auto-incrementing primary key column (id).
            $table->unsignedBigInteger('user_id'); // Foreign Key
            $table->string('order_type')->default('online');
            // Column for storing the subtotal amount (max digits = 10, 2 decimal places).
            $table->decimal('sub_total',10,2);
            // Column for storing a discount percentage, defaults to 0 if not set.
            $table->integer('discount')->default(false);
            $table->text('description')->nullable();

            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Drops the "orders" table if it exists.
        Schema::dropIfExists('orders');
    }
};
