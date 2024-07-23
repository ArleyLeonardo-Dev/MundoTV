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
        Schema::table('Peticiones', function(Blueprint $table){
            $table->dropColumn('Peticion');
            $table->dropColumn('serial tarjeta 1');
            $table->dropColumn('serial deco 1');
            $table->dropColumn('serial tarjeta 2');
            $table->dropColumn('serial deco 2');
            $table->dropColumn('serial tarjeta 3');
            $table->dropColumn('serial deco 3');
            $table->dropColumn('serial tarjeta 4');
            $table->dropColumn('serial deco 4');
            $table->dropColumn('serial tarjeta 5');
            $table->dropColumn('serial deco 5');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Peticiones',function(Blueprint $table){
            $table->string('Peticion')->unique();
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
        });
    }
};
