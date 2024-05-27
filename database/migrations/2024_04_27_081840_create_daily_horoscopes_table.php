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
        Schema::create('daily_horoscopes', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->longtext('description')->nullable();
            $table->integer('percentage')->nullable();
            $table->integer('zodiac_sign_id')->nullable();
            $table->string('horoscopeDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_horoscopes');
    }
};
