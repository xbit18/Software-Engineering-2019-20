<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aule', function(Blueprint $table0) {
            $table0->foreign('id_edificio')->references('id')
                ->on('edifici')->onDelete('cascade'); });

        Schema::table('token', function(Blueprint $table1) {
            $table1->foreign('id_aula')->references('id')
                ->on('aule')->onDelete('cascade'); });

        Schema::table('mappe', function(Blueprint $table2) {
            $table2->foreign('id_edificio')->references('id')
                ->on('edifici')->onDelete('cascade'); });

        Schema::table('posti', function(Blueprint $table3) {
            $table3->foreign('id_aula')->references('id')
                ->on('aule')->onDelete('cascade'); });

        Schema::table('posti', function(Blueprint $table4) {
            $table4->foreign('id_utente')->references('id')
                ->on('utenti')->onDelete('cascade'); });

        Schema::table('presenze', function(Blueprint $table5) {
            $table5->foreign('id_aula')->references('id')
                ->on('aule')->onDelete('cascade'); });

        Schema::table('presenze', function(Blueprint $table6) {
            $table6->foreign('id_utente')->references('id')
                ->on('utenti')->onDelete('cascade'); });

        Schema::table('prenotazioni', function(Blueprint $table7) {
            $table7->foreign('id_aula')->references('id')
                ->on('aule')->onDelete('cascade'); });

        Schema::table('prenotazioni', function(Blueprint $table8) {
            $table8->foreign('id_utente')->references('id')
                ->on('utenti')->onDelete('cascade'); });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aule', function(Blueprint $table0) {
            $table0->dropForeign(['id_edificio']);
        });
        Schema::table('token', function(Blueprint $table1) {
            $table1->dropForeign(['id_aula']);
        });
        Schema::table('mappe', function(Blueprint $table2) {
            $table2->dropForeign(['id_edificio']);
        });
        Schema::table('posti', function(Blueprint $table3) {
            $table3->dropForeign(['id_aula']);
        });
        Schema::table('posti', function(Blueprint $table4) {
            $table4->dropForeign(['id_utente']);
        });
        Schema::table('presenze', function(Blueprint $table5) {
            $table5->dropForeign(['id_aula']);
        });
        Schema::table('presenze', function(Blueprint $table6) {
            $table6->dropForeign(['id_utente']);
        });
        Schema::table('prenotazioni', function(Blueprint $table7) {
            $table7->dropForeign(['id_aula']);
        });
        Schema::table('prenotazioni', function(Blueprint $table8) {
            $table8->dropForeign(['id_utente']);
        });

    }
}
