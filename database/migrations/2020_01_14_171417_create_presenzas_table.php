<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresenzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presenze', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime("data_entrata");
            $table->dateTime("data_uscita")->nullable();
            $table->string("materia",50);
            $table->unsignedBigInteger("id_aula")->nullable(true);
            $table->unsignedBigInteger("id_utente")->nullable(true);
            $table->boolean('conferma');

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
        Schema::dropIfExists('presenze');
    }
}
