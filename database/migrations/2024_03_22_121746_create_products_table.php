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
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->longtext('description')->nullable();
            $table->float('unit_price')->default(0);
            $table->float('purchase_price')->default(0);
            $table->string('discount')->default(0.00);
            $table->string('discount_type')->nullable();
            $table->string('tax')->default(0.00);
            $table->string('tax_type')->nullable();
            $table->float('shipping_cost')->nullable();
            $table->integer('current_stock')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_image')->nullable();
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
