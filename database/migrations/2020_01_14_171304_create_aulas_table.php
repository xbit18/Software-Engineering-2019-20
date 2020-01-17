<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codice', 50)->unique();
            $table->enum('disponibilita',['disponibile','non disponibile']);
            $table->enum('tipo', ['lezione', 'studio', 'lavoro']);
            $table->integer('capienza');
            $table->enum('stato',['aperta','chiusa']);
            $table->unsignedBigInteger('id_edificio')->nullable(true);
            $table->integer('piano');

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
        Schema::dropIfExists('aule');
    }
}
