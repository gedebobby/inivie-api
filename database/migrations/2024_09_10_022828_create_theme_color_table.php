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
        Schema::create('theme_color', function (Blueprint $table) {
            $table->id();
            $table->string('old_color');
            $table->string('header_color');
            $table->string('body_color');
            $table->string('line_color');
            $table->string('footer_color');
            $table->string('button_line_top');
            $table->string('button_hover');
            $table->foreignId('list_property_id')->constrained('list_properties');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_color');
    }
};
