<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtapaItemOtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etapa_item_ots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('detalle')->nullable();
            $table->time('tiempo_asignado');
            $table->time('tiempo_real')->nullable();
            $table->date('fh_inicio')->nullable();
            $table->date('fh_termino')->nullable();
            $table->date('fh_limite')->nullable();
            $table->integer('estado_avance')->default(1);

            $table->unsignedBigInteger('itemot_id');
            $table->unsignedBigInteger('proceso_id');
            $table->unsignedBigInteger('maquina_id');
            $table->unsignedBigInteger('empleado_id');
           
            $table->foreign('itemot_id')->references('id')->on('item_ots');           
            $table->foreign('proceso_id')->references('id')->on('procesos');
            $table->foreign('maquina_id')->references('id')->on('maquinas');
            $table->foreign('empleado_id')->references('id')->on('empleados');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etapa_item_ots');
    }
}
