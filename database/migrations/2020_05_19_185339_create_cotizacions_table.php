<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('folio');
            $table->string('empresa');
            $table->string('contacto')->nullable();
            $table->string('telefono_contacto')->nullable();
            $table->string('email_contacto')->nullable();
            $table->integer('dias_validez');
            $table->double('valor_neto');
            $table->string('estado');
            $table->unsignedBigInteger('user_id');
            $table->string('observaciones')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('cotizacions');
    }
}
