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
        Schema::create('Clientes', function (Blueprint $table) {
            $table->id();
            $table->string('Referencia')->unique()->nullable();
            $table->string('Nombre');
            $table->string('Ciudad');
            $table->integer('Dia_de_pago');
            $table->bigInteger('Valor_mes');
            $table->string('Enero')->nullable();
            $table->string('Febrero')->nullable();
            $table->string('Marzo')->nullable();
            $table->string('Abril')->nullable();
            $table->string('Mayo')->nullable();
            $table->string('Junio')->nullable();
            $table->string('Julio')->nullable();
            $table->string('Agosto')->nullable();
            $table->string('Septiembre')->nullable();
            $table->string('Octubre')->nullable();
            $table->string('Noviembre')->nullable();
            $table->string('Diciembre')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
