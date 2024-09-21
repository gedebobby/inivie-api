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
        Schema::create('offers_villa', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('photo');
            $table->longText('description');
            $table->string('link');
            $table->foreignId('list_property_id')->constrained('list_properties');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers_villa');
    }
};
