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
        Schema::create('local_guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id');
            $table->string('addressline1');
            $table->string('addressline2')->nullable();
            $table->string('city');
            $table->string('phone');
            $table->string('id_number');
            $table->date('registration_date'); 
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');

            // Add a composite unique index
            $table->unique(['id_number', 'phone', 'registration_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_guests');
    }
};
