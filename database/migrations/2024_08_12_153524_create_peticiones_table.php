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
            $table->bigInteger('peticion')->unique();
            $table->string('nombre')->nullable();
            $table->string('cedula')->nullable();
            $table->string('plan')->nullable();
            $table->string('serial_tarjeta_1')->unique()->nullable();
            $table->string('serial_deco_1')->unique()->nullable();
            $table->string('serial_tarjeta_2')->unique()->nullable();
            $table->string('serial_deco_2')->unique()->nullable();
            $table->string('serial_tarjeta_3')->unique()->nullable();
            $table->string('serial_deco_3')->unique()->nullable();
            $table->string('serial_tarjeta_4')->unique()->nullable();
            $table->string('serial_deco_4')->unique()->nullable();
            $table->string('serial_tarjeta_5')->unique()->nullable();
            $table->string('serial_deco_5')->unique()->nullable();
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
