<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime("entry_date");
            $table->dateTime("exit_date")->nullable();
            $table->string("subject",50);
            $table->unsignedBigInteger("classroom_id")->nullable(true);
            $table->unsignedBigInteger("user_id")->nullable(true);
            $table->boolean('confirmation');

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
        Schema::dropIfExists('attendances');
    }
}
