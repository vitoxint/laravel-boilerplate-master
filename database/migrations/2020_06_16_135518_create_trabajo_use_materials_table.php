<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajoUseMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajo_use_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('itemot_id');
            $table->double('dimension_largo');
            $table->double('dimension_ancho')->nullable();
            $table->double('valor_unit');
            $table->double('valor_total');

            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('itemot_id')->references('id')->on('item_ots');

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
        Schema::dropIfExists('trabajo_use_materials');
    }
}
