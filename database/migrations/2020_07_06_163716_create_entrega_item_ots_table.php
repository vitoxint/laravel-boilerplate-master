<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregaItemOtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrega_item_ots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('entregaot_id');
            $table->unsignedBigInteger('itemot_id');

            $table->foreign('entregaot_id')->references('id')->on('entrega_ots');
            $table->foreign('itemot_id')->references('id')->on('item_ots');


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
        Schema::dropIfExists('entrega_item_ots');
    }
}
