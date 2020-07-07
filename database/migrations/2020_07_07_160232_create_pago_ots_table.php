<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoOtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_ots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ot_id');
            $table->unsignedBigInteger('user_id');
            $table->double('monto');
            $table->integer('medio_pago');//1 - efectivo, 2 -Tarjeta, 3 -transferencia , 4 -cuenta cliente
            
            $table->datetime('fecha_abono');
            $table->timestamps();

            $table->foreign('ot_id')->references('id')->on('orden_trabajos');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago_ots');
    }
}
