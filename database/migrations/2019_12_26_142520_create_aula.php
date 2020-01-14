<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aula', function (Blueprint $table) {
            $table->unsignedBigInteger('id',true);
            $table->string('codice');
            $table->boolean('disponibilita')->default('1');
            $table->string('tipo');
            $table->integer('capienza')->unsigned();
            $table->enum('stato',['occupata','libera'])->default('libera');
          //  $table->primary('codice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aula');
    }
}
