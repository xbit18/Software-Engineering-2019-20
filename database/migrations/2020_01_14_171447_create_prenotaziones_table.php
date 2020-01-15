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
            $table->bigIncrements('id')->primary();
            $table->dateTime("data_inizio");
            $table->dateTime("data_fine");
            $table->text("motivazione");
            $table->enum("stato",["accettata","rifiutata"]);
            $table->integer("id_aula");
            $table->integer("id_studente");

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
