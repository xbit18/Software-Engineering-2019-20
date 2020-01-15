<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posti', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->integer("numero_posto")->unique();
            $table->enum("disponibilita", ["libero", "occupato"]);
            $table->integer("id_utente");
            $table->integer("id_aula")->unique();

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
        Schema::dropIfExists('posti');
    }
}
