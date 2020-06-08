<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesoHasMaquinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceso_has_maquinas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('proceso_id');
            $table->unsignedBigInteger('maquina_id');

            $table->foreign('proceso_id')->references('id')->on('procesos');
            $table->foreign('maquina_id')->references('id')->on('maquinas');
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
        Schema::dropIfExists('proceso_has_maquinas');
    }

    
}
