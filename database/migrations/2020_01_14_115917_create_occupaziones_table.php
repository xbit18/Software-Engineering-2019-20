<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccupazionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occupazioni', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('data_inizio');
            $table->dateTime('data_fine');
            $table->unsignedBigInteger("id_posto");
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
        Schema::dropIfExists('occupazioni');
    }
}
