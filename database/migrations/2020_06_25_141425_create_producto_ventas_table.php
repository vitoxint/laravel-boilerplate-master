<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        
        Schema::create('marcas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('familia_productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('producto_ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('descripcion');
            $table->unsignedBigInteger('marca_id')->nullable();
            $table->unsignedBigInteger('familia_producto_id');
            $table->string('imagen_url')->nullable();
            $table->double('precio_lista')->nullable();
            $table->double('stock_seguridad');
            
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('familia_producto_id')->references('id')->on('familia_productos');


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
        Schema::dropIfExists('producto_ventas');
    }
}
