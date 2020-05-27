<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_cotizacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('folio');
            $table->double('cantidad');
            $table->string('descripcion');
            $table->double('valor_unitario');
            $table->double('descuento');
            // $table->integer('dias_validez');
            $table->double('valor_parcial');
            $table->string('observaciones')->nullable();

            $table->unsignedBigInteger('cotizacion_id');

            $table->foreign('cotizacion_id')->references('id')->on('cotizacions');
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
        Schema::dropIfExists('item_cotizacions');
    }
}
