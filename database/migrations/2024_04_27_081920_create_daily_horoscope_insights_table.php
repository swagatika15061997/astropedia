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
        Schema::create('daily_horoscope_insights', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('coverImage')->nullable();
            $table->string('title')->nullable();
            $table->longtext('description')->nullable();
            $table->integer('zodiac_sign_id')->nullable();
            $table->string('horoscopeDate')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_horoscope_insights');
    }
};
