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
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('whatsapp');
            $table->string('email');
            $table->string('phone');
            $table->string('booking_link');
            $table->string('whatsapp_link');
            $table->string('instagram');
            $table->string('facebook');
            $table->string('youtube');
            $table->string('trip_advisor');
            $table->string('tiktok_link');
            $table->string('google_link');
            $table->string('tripadvisor_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact');
    }
};
