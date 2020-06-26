<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTrabajoUseMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trabajo_use_materials', function (Blueprint $table) {

            $table->integer('estado')->after('valor_total'); // 1 En espera ,, 2 Disponible ,, 3 Utlizado
            $table->unsignedBigInteger('existencia_material_id')->after('estado')->nullable();
            $table->unsignedBigInteger('solicitud_material_id')->after('existencia_material_id')->nullable();

            $table->foreign('existencia_material_id')->references('id')->on('existencia_materials');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trabajo_use_materials', function (Blueprint $table) {
            $table->dropColumn('estado');
            $table->dropColumn('existencia_material_id');
            $table->dropColumn('solicitud_material_id');
        });
    }
}
