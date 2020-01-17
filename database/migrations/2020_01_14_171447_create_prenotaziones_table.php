<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenotazionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenotazioni', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime("data_inizio");
            $table->dateTime("data_fine");
            $table->text("motivazione");
            $table->enum("stato",["in attesa", "accettata","rifiutata"])->default("in attesa");
            $table->integer('piano');
            $table->unsignedBigInteger("id_aula");
            $table->unsignedBigInteger("id_utente");

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
        Schema::dropIfExists('prenotazioni');
    }
}
