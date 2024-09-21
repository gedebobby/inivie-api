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
        Schema::create('room_list', function (Blueprint $table) {
            $table->id();
            $table->string('title');          
            $table->string('slug');          
            $table->string('bed_size');            
            $table->string('room_size');            
            $table->string('max_occupancy');            
            $table->string('description');             
            $table->string('photo');          
            $table->foreignId('facilities_list_id')->constrained('facilities_list');
            $table->foreignId('facilities_room_id')->constrained('facilities_room');
            $table->foreignId('list_property_id')->constrained('list_properties');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_list');
    }
};
