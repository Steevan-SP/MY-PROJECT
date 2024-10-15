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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->enum('guest_type', ['local', 'foreign', 'complementary']);
            $table->string('title');
            $table->string('guestfirstname');
            $table->string('guestlastname');
            $table->string('email')->unique();
            $table->integer('adult_count');
            $table->integer('kids_count')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('ticket_number')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
