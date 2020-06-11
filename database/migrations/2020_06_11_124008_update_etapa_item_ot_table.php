<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEtapaItemOtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('etapa_item_ots', function (Blueprint $table) {
            $table->unsignedBigInteger('empleado_id')->nullable()->change();
            $table->double('valor_unitario')->after('empleado_id')->default(0);
            $table->double('cantidad')->after('valor_unitario')->default(0);
            $table->double('valor_proceso')->after('cantidad')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('etapa_item_ots', function (Blueprint $table) {
            $table->unsignedBigInteger('empleado_id')->change();
            $table->dropColumn('valor_unitario');
            $table->dropColumn('cantidad');
            $table->dropColumn('valor_proceso');
        });
    }
}
