<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdificiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edifici', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->string("nome",50)->unique();
            $table->string("indirizzo",150)->nullable();
            $table->integer("numero_aule")->nullable();

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
        Schema::dropIfExists('edifici');
    }
}
