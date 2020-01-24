<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("seat_number");
            $table->enum("availability", ["free", "occupied"])->default("free")->nullable();
            $table->unsignedBigInteger("seat_reservation_id")->nullable(true);
            $table->unsignedBigInteger("classroom_id");

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
        Schema::dropIfExists('seats');
    }
}
