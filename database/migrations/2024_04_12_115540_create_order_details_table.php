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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->text('product_details')->nullable();
            $table->integer('qty')->default(0);
            $table->double('price', 8, 2)->default(0);
            $table->double('discount', 8, 2)->default(0);
            $table->string('delivery_status', 15)->default('pending');
            $table->string('payment_status', 15)->default('unpaid');
            $table->string('discount_type', 30)->nullable();
            $table->tinyInteger('is_stock_decreased')->default(1);
            $table->integer('refund_request')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
