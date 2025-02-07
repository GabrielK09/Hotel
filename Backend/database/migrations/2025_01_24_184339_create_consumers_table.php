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
        Schema::create('consumers', function (Blueprint $table) {
            $table->id();
            $table->string('cliente', 255)->unique();
            $table->integer('CPF')->nullable();
            $table->integer('CNPJ')->nullable();
            $table->string('email', 255)->unique();
            $table->string('phone', 15)->unique();
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumers');
    }
};
