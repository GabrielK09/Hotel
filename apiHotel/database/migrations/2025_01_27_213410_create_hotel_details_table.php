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
        Schema::create('hotel_details', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('cnpj', 14);
            $table->string('email', 170);
            $table->string('address', 120);
            $table->integer('number', false, 20);
            $table->integer('number_of_rooms', false, 20);
            $table->integer('number_of_employees', false, 20);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_details');
    }
};
