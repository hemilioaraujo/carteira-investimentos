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
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_id')->constrained('tipos');
            $table->foreignId('corretora_id')->nullable()->constrained('corretoras');
            $table->foreignId('ativo_id')->constrained('ativos');
            $table->decimal('quantidade', 15, 4);
            $table->decimal('preco_unitario', 15, 4);
            $table->decimal('valor_total', 15, 4);
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes');
    }
};
