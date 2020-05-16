<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenItemOtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagen_item_ots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');

            $table->unsignedBigInteger('itemot_id');
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
        Schema::dropIfExists('imagen_item_ots');
    }
}
