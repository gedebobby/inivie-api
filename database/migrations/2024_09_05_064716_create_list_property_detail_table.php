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
        Schema::create('list_property_detail', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('favicon');
            $table->string('star');
            $table->string('meta_title');
            $table->string('meta_keyword');
            $table->string('meta_description');
            $table->string('link_gmaps');
            $table->string('address');
            $table->string('slogan');
            $table->string('description');
            $table->string('yt_video');
            $table->foreignId('list_property_id')->constrained('list_properties');
            $table->foreignId('contact_id')->constrained('contact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_property_detail');
    }
};
