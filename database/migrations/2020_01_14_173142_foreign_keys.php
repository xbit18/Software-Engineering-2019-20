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
                ->on('edifici')->onDelete('set null'); });

        Schema::table('token', function(Blueprint $table1) {
            $table1->foreign('id_aula')->references('id')
                ->on('aule')->onDelete('set null'); });

        Schema::table('mappe', function(Blueprint $table2) {
            $table2->foreign('id_edificio')->references('id')
                ->on('edifici')->onDelete('set null'); });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
