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
        Schema::create('room_facilities_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_list_id')->constrained('room_list');
            $table->foreignId('facilities_room_id')->constrained('facilities_room');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_facilities_detail');
    }
};
