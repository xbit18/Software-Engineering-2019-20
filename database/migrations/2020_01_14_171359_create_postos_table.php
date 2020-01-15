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
            $table->bigIncrements('id');
            $table->integer("numero_posto")->unique();
            $table->enum("disponibilita", ["libero", "occupato"]);
            $table->unsignedBigInteger("id_utente")->nullable(true);
            $table->unsignedBigInteger("id_aula")->unique()->nullable(true);

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
