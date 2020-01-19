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
            $table->integer("numero_posto");
            $table->enum("disponibilita", ["libero", "occupato"])->default("libero")->nullable();
            $table->unsignedBigInteger("id_occupazione")->nullable(true);
            $table->unsignedBigInteger("id_aula");

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
