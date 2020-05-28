<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormapagoToCotizacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cotizacions', function (Blueprint $table) {
            $table->string('forma_pago')->after('valor_neto')->nullable();
            $table->string('condicion_pago')->after('valor_neto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cotizacions', function (Blueprint $table) {
            //
        });
    }
}
