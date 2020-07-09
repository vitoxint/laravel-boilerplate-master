<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCuentaClienteToPagoOtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pago_ots', function (Blueprint $table) {
            $table->unsignedBigInteger('cuenta_cliente_id')->nullable()->after('medio_pago');

            $table->foreign('cuenta_cliente_id')->references('id')->on('cuenta_clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pago_ots', function (Blueprint $table) {
            $table->dropColumn('cuenta_cliente_id');
        });
    }
}
