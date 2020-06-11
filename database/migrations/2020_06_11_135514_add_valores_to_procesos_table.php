<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValoresToProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('procesos', function (Blueprint $table) {
            $table->integer('tipo_valorizacion')->after('descripcion'); // 1 por hora , 2 por Kg, 3 por operacion
            $table->double('valor_unitario')->after('tipo_valorizacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('procesos', function (Blueprint $table) {
            $table->dropColumn('tipo_valorizacion');
            $table->dropColumn('valor_unitario');
        });
    }
}
