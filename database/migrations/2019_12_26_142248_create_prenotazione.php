<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenotazione extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenotazione', function (Blueprint $table) {
            $table->unsignedBigInteger('id',true);
            $table->enum('stato',['in atesa','accettato','rifiutato'])->default('in atesa');
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
