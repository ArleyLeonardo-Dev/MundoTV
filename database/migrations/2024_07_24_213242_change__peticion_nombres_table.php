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
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Peticiones', function(Blueprint $table){
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
};
