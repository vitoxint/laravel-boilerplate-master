<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstadoPagoOrdenTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orden_trabajos', function (Blueprint $table) {
            $table->integer('estado_pago')->after('estado'); // 1 pendiente , 2 abonado , 3 pagada
            
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orden_trabajos', function (Blueprint $table) {
            $table->dropColumn('estado_pago');
           
        });
    }
}
