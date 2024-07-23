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
        Schema::create("Peticiones", function(Blueprint $table){
            $table->id();
            $table->string('Peticion')->unique();
            $table->string('nombre');
            $table->string('cedula');
            $table->string('plan');
            $table->string('serial tarjeta 1')->unique();
            $table->string('serial deco 1')->unique();
            $table->string('serial tarjeta 2')->unique();
            $table->string('serial deco 2')->unique();
            $table->string('serial tarjeta 3')->unique();
            $table->string('serial deco 3')->unique();
            $table->string('serial tarjeta 4')->unique();
            $table->string('serial deco 4')->unique();
            $table->string('serial tarjeta 5')->unique();
            $table->string('serial deco 5')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
