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
        Schema::create('page_facilities', function (Blueprint $table) {
            $table->id();            
            $table->string('title');
            $table->string('slug');
            $table->string('subtitle');
            $table->string('menu_link');
            $table->text('description');
            $table->string('photo');
            $table->foreignId('facilities_list_id')->constrained('facilities_list');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_facilities');
    }
};
