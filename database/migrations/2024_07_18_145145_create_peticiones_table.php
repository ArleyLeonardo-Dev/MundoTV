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
        Schema::create('Peticiones', function (Blueprint $table) {
            $table->id();
            $table->string('peticion');
            $table->string('nombre');
            $table->string('cedula');
            $table->string('cuenta de pago');
            $table->string('clave');
            $table->string('direccion');
            $table->string('fecha de instalacion');
            $table->string('ganancias netas');
            $table->string('fecha de pago');
            $table->string('pago del plan');
            $table->string('codigo de radicado');
            $table->string('cantidad de decos');
            $table->string('fecha de seriales de decos rectificados');
            $table->string('promocion');
            $table->string('telefono fijo');
            $table->string('moden');
            $table->string('serial-1');
            $table->string('tarjeta-1');
            $table->string('serial-2');
            $table->string('tarjeta-2');
            $table->string('serial-3');
            $table->string('tarjeta-3');
            $table->string('serial-4');
            $table->string('tarjeta-4');
            $table->string('serial-5');
            $table->string('tarjeta-5');
            $table->string('plan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peticiones');
    }
};
