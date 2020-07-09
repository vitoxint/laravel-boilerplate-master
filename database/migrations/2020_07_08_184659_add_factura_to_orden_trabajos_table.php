<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacturaToOrdenTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('orden_trabajos', function (Blueprint $table) {
            $table->integer('factura')->nullable()->after('estado_pago'); // 1 pendiente , 2 abonado , 3 pagada
            
            
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
            $table->dropColumn('factura');
        });
    }
}
