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
        Schema::create('stadiums', function (Blueprint $table) {
    $table->id();
    $table->string('name');          
    $table->string('city');          
    $table->string('address');       
    $table->double('price');         
    $table->string('image')->nullable(); 
    $table->float('rate')->default(5); 
    
    $table->decimal('latitude', 10, 8)->nullable();
    $table->decimal('longitude', 11, 8)->nullable();

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('stadiums');
    }
};
