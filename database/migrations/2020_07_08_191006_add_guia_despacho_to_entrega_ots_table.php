<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGuiaDespachoToEntregaOtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrega_ots', function (Blueprint $table) {
            $table->string('guia_despacho')->nullable()->after('rut_receptor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrega_ots', function (Blueprint $table) {
            $table->dropColumn('guia_despacho');
        });
    }
}
