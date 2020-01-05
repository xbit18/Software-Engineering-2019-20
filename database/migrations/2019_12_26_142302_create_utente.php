<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utente', function (Blueprint $table) {
            $table->unsignedBigInteger('id',true);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nome');
            $table->year('data_di_nascita');
            $table->enum('tipo',['admin','adetto','docente','studente']);
            $table->string('cognome');
            $table->string('corso');
            $table->integer('matricola')->unsigned();
            $table->string('numero_documento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utente');
    }
}
