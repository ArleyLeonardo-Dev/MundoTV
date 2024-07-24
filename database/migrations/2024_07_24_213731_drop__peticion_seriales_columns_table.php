<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\BlueprintState;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Extension\CommonMark\Parser\Block\BlockQuoteStartParser;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('Peticiones',function(Blueprint $table){
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
        //
    }
};
