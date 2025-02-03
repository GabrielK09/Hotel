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
        Schema::create('nfces', function (Blueprint $table) {
            $table->id();
            $table->string('descricao', 255)->default('VENDA REFERENTE A NFCE Nº');
            $table->decimal('preco_bruto', 16,2);
            $table->decimal('preco_liquido', 16,2);
            $table->decimal('preco_desconto', 16,2);
            $table->string('forma_pagamento', 255);
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfces');
    }
};
