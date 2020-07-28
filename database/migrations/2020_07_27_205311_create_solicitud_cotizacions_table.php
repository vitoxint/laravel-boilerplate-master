<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_cotizacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_solicitante');
            $table->string('email_solicitante');
            $table->string('telefono_solicitante')->nullable();
            $table->text('mensaje')->nullable();
            $table->integer('estado'); // 1 - solicitada , 2 - resuelta , 3 - enviada(ok)  ,  4 - vencida// si hoy =  fecha envio + validez
            $table->date('fecha_envio')->nullable();
            $table->integer('validez')->nullable();
            $table->double('valor_total')->default(0);
            $table->string('mensaje_respuesta')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('item_scs', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sc_id');
            $table->unsignedBigInteger('producto_id');
            $table->double('cantidad');
            $table->double('valor_unitario')->default(0);
            $table->double('descuento')->default(0);
            $table->double('valor_total')->default(0);
            $table->timestamps();

            $table->foreign('sc_id')->references('id')->on('solicitud_cotizacions');
            $table->foreign('producto_id')->references('id')->on('producto_ventas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_cotizacions' , 'item_scs');
    
    }
}
