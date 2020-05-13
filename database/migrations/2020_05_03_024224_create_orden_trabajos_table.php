<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_trabajos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('folio');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('representante_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('estado');
            $table->string('cotizacion')->nullable();
            $table->double('valor_total');
            $table->string('orden_compra')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('entrega_estimada');
            $table->date('fecha_termino')->nullable();
            
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('representante_id')->references('id')->on('cliente_representantes');           
            $table->timestamps();
        });
        
         Schema::create('item_ots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('folio');
            $table->double('cantidad');
            $table->double('valor_unitario');
            $table->double('valor_parcial');
            $table->string('descripcion');
            $table->unsignedBigInteger('ot_id');           
            $table->string('estado');
            $table->string('especificaciones')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_termino')->nullable();
            
            $table->foreign('ot_id')->references('id')->on('orden_trabajos');                   
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
        Schema::dropIfExists('orden_trabajos','item_ots');
    }
}
