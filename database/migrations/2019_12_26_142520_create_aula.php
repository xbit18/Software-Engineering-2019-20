<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Aula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aula', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('codice')->primary();
            $table->boolean('disponibilita')->default('true');
            $table->string('tipo');
            $table->integer('capienza')->unsigned();
            $table->enum('stato',['occupata','libera'])->default('libera');
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
