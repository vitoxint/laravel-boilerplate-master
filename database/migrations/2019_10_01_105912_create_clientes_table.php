<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rut_cliente',12)->unique();
            $table->string('razon_social');
            $table->string('telefono', 12)->nullable(true);
            $table->string('celular', 12)->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('direccion');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('commune_id');
            $table->string('slug');
            
            $table->string('giro_comercial')->nullable();
            $table->foreign('commune_id')->references('id')->on('communes');
            $table->foreign('region_id')->references('id')->on('regions');      

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
        Schema::dropIfExists('clientes');
    }
}
