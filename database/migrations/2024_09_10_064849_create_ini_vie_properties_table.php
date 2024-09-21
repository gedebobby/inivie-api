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
        Schema::create('ini_vie_properties', function (Blueprint $table) {
            $table->id();
            $table->text('images');
            $table->text('images_id');
            $table->text('images_path');
            $table->string('title');
            $table->longText('desc');
            $table->string('address');
            $table->string('reservation');
            $table->string('phone');
            $table->string('email');
            $table->string('website');
            $table->string('booking_link');
            $table->foreignId('property_type_id')->constrained('ini_vie_property_type');
            $table->foreignId('property_area_id')->constrained('ini_vie_property_area');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ini_vie_properties');
    }
};
