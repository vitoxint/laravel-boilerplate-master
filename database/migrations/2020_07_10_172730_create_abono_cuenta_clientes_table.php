<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonoCuentaClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abono_cuenta_clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cuentacl_id');
            $table->unsignedBigInteger('user_id');
            $table->datetime('fecha_registro');
            $table->double('monto');
            $table->integer('medio_pago');
            $table->string('observaciones')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cuentacl_id')->references('id')->on('cuenta_clientes');

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
        Schema::dropIfExists('abono_cuenta_clientes');
    }
}
