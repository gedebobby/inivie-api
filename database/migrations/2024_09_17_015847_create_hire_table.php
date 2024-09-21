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
        Schema::create('hire', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('list_property_job_id')->constrained('list_properties_job');
            $table->foreignId('job_position_id')->constrained('job_positions');
            $table->string('work_time');
            $table->string('description');
            $table->string('salary');
            $table->dateTime('expired');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hire');
    }
};
