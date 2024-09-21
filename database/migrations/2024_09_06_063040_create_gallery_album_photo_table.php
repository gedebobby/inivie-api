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
        Schema::create('gallery_album_photo', function (Blueprint $table) {
            $table->id();
            $table->string('photo_name');
            $table->string('photo_path');
            $table->foreignId('album_id')->constrained('albums');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_album_photo');
    }
};
