<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->text("motivation");
            $table->enum("state",["pending", "accepted","refused"])->default("pending");
            $table->unsignedBigInteger("classroom_id");
            $table->unsignedBigInteger("user_id");

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
        Schema::dropIfExists('classroom_reservations');
    }
}
