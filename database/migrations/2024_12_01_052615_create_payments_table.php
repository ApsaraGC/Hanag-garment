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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Foreign Key
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->default('cash_on_delivery');
            $table->date('payment_date')->nullable();
            $table->timestamps();

    // Foreign key constraint
    $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
