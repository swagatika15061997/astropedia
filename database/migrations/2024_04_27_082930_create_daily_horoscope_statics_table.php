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
        Schema::create('daily_horoscope_statics', function (Blueprint $table) {
            $table->id();
            $table->integer('zodiac_sign_id')->nullable();
            $table->string('horoscopeDate')->nullable();
            $table->string('luckyTime')->nullable();
            $table->string('luckyColor')->nullable();
            $table->string('luckyNumber')->nullable();
            $table->string('moodday')->nullable();
            $table->tinyInteger('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_horoscope_statics');
    }
};
