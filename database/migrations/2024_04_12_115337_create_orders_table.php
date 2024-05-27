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
            $table->id();
            $table->string('unique_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->double('order_amount')->default(0);
            $table->double('discount_amount', 8, 2)->default(0);
            $table->string('discount_type')->nullable();
            $table->string('order_status',50)->default('pending');
            $table->string('payment_method',100)->default('unpaid');
            $table->string('transaction_ref')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->text('shipping_address_data')->nullable();
            $table->text('billing_address_data')->nullable();
            $table->string('verification_code')->default(000000);
            $table->tinyInteger('checked')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
