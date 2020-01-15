<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utenti', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("password",20);
            $table->string("email",50)->unique();
            $table->string("corso", 100);
            $table->bigInteger("matricola")->unique();
            $table->enum("tipo",["studente","docente","admin","addetto"]);
            $table->date("data_nascita");
            $table->string("nome",30);
            $table->string("cognome",30);
            $table->string("codice_documento",50)->unique();

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
        Schema::dropIfExists('utenti');
    }
}
