<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
           
            $table->integer('perfil'); //1 barra redonda , 2 barra red perforada, 3 plancha laminada
            $table->integer('sistema_medida');// 1 en mm , 2 en pulg
            $table->string('diam_exterior')->nullable();
            $table->string('diam_interior')->nullable();
            $table->string('espesor')->nullable();
            $table->double('densidad');
            $table->double('valor_kg');
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
        Schema::dropIfExists('materials');
    }
}
