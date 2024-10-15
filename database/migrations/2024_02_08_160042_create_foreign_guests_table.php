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
        Schema::create('foreign_guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id');
            $table->string('country');
            $table->string('passport_number')->unique();
            $table->string('image_path');
            $table->string('driver_name')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->timestamps();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foreign_guests');
    }
};
