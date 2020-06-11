<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteValorToMaquinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::table('maquinas', function (Blueprint $table) {
                $table->dropColumn('valor_hora');
                $table->dropColumn('especificaciones');
                
            });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maquinas', function (Blueprint $table) {
            $table->double('valor_hora')->after('nombre')->default(0);
            $table->double('especificaciones')->after('valor_hora')->nullable();
        });
    }
}
