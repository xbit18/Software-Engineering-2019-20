<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("password",20);
            $table->string("email",50)->unique();
            $table->string("course", 100);
            $table->bigInteger("matriculation_number")->unique();
            $table->enum("type",["student","teacher","admin","operator"]);
            $table->date("birthdate");
            $table->string("name",30);
            $table->string("surname",30);
            $table->string("identification_number",50)->unique();

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
        Schema::dropIfExists('users');
    }
}
