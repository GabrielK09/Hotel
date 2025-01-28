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
        Schema::create('item_nfces', function (Blueprint $table) {
            $table->id();
            $table->integer('cod_produto');
            $table->string('produto', 255);
            $table->integer('quantidade');
            $table->decimal('preco_bruto', 16,2);
            $table->decimal('preco_liquido', 16,2);
            $table->decimal('preco_desconto', 16,2);
            $table->integer('NCM');
            $table->integer('CEST');
            $table->integer('CSOSN');
            $table->integer('CFOP');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_nfces');
    }
};
