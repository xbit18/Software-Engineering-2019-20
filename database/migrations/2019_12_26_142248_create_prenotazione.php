<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prenotazione extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenotazione', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->enum('stato',['in atesa','accettato','rifiutato']);
        $table->string('durata');
        $table->longText('motivazione');
        $table->timestamp('data')->useCurrent();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prenotazione');
    }
}
