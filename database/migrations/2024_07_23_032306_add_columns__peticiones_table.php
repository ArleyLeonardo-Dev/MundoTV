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
        Schema::table('Peticiones',function(Blueprint $table){
            $table->string('Peticion')->unique()->nullable();
            $table->string('serial tarjeta 1')->unique()->nullable();
            $table->string('serial deco 1')->unique()->nullable();
            $table->string('serial tarjeta 2')->unique()->nullable();
            $table->string('serial deco 2')->unique()->nullable();
            $table->string('serial tarjeta 3')->unique()->nullable();
            $table->string('serial deco 3')->unique()->nullable();
            $table->string('serial tarjeta 4')->unique()->nullable();
            $table->string('serial deco 4')->unique()->nullable();
            $table->string('serial tarjeta 5')->unique()->nullable();
            $table->string('serial deco 5')->unique()->nullable();
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
