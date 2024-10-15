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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->nullable();
            $table->foreignId('billing_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('ticket_id')->nullable();
            $table->decimal('total_adults_price')->nullable();
            $table->decimal('total_kids_price')->nullable(); 
            $table->enum('payment_mode', ['Cash', 'Card']);
            $table->string('card_type')->nullable(); 
            $table->decimal('total_amount');
            $table->string('bill_number')->nullable(); 
            $table->timestamps();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
            $table->foreign('billing_id')->references('id')->on('billings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
