<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExistenciaMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('existencia_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('deposito_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('origen_material');  // 1 compra material ,2 Retazo material , Proporcionado por cliente
            $table->string('detalle_origen')->nullable(); // guia de despacho, factura, cliente (ot)
            $table->double('dimension_largo');
            $table->double('dimension_ancho')->nullable();
            $table->double('valor_unit');
            $table->double('valor_total');
            $table->integer('estado_consumo'); //1 disponible , 2 Asignado, 3 consumido 

            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('deposito_id')->references('id')->on('depositos');

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
        Schema::dropIfExists('existencia_materials');
    }
}
