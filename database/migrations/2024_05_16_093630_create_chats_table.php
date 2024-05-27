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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('astrologer_id')->nullable();
            $table->text('message')->nullable();
            $table->tinyInteger('sent_by_customer')->default(0);
            $table->tinyInteger('sent_by_astrologer')->default(0);
            $table->tinyInteger('seen_by_customer')->default(1);
            $table->tinyInteger('seen_by_astrologer')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
