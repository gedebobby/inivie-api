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
        Schema::create('page_popups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('photo');
            $table->string('slug');
            $table->string('status');
            $table->foreignId('list_property_id')->constrained('list_properties');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_popups');
    }
};
