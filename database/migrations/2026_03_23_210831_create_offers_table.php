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
        Schema::create('offers', function (Blueprint $table) {
    $table->id();
    $table->foreignId('creator_id')->constrained('users')->onDelete('cascade');
    $table->double('discount_percentage');
    $table->enum('type', ['flash', 'seasonal']); 
    $table->dateTime('start_date');
    $table->dateTime('end_date');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
