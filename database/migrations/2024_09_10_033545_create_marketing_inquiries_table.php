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
        Schema::create('marketing_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('name');
            $table->string('username');
            $table->string('email');
            $table->string('phone');
            $table->text('message');
            $table->string('file');
            $table->string('country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_inquiries');
    }
};
