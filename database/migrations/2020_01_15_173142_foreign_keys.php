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
        Schema::table('classrooms', function(Blueprint $table0) {
            $table0->foreign('building_id')->references('id')
                ->on('buildings')->onDelete('cascade'); });

        Schema::table('token', function(Blueprint $table1) {
            $table1->foreign('classroom_id')->references('id')
                ->on('classrooms')->onDelete('cascade'); });

        Schema::table('maps', function(Blueprint $table2) {
            $table2->foreign('building_id')->references('id')
                ->on('buildings')->onDelete('cascade'); });

        Schema::table('seats', function(Blueprint $table3) {
            $table3->foreign('classroom_id')->references('id')
                ->on('classrooms')->onDelete('cascade'); });

        Schema::table('seats', function(Blueprint $table4) {
            $table4->foreign('seat_reservation_id')->references('id')
                ->on('seat_reservations')->onDelete('cascade'); });

        Schema::table('attendances', function(Blueprint $table5) {
            $table5->foreign('classroom_id')->references('id')
                ->on('classrooms')->onDelete('cascade'); });

        Schema::table('attendances', function(Blueprint $table6) {
            $table6->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade'); });

        Schema::table('classroom_reservations', function(Blueprint $table7) {
            $table7->foreign('classroom_id')->references('id')
                ->on('classrooms')->onDelete('cascade'); });

        Schema::table('classroom_reservations', function(Blueprint $table8) {
            $table8->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade'); });

        Schema::table('seat_reservations', function(Blueprint $table9) {
            $table9->foreign('seat_id')->references('id')
                ->on('seats')->onDelete('cascade'); });

        Schema::table('seat_reservations', function(Blueprint $table10) {
            $table10->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade'); });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classrooms', function(Blueprint $table0) {
            $table0->dropForeign(['building_id']);
        });
        Schema::table('token', function(Blueprint $table1) {
            $table1->dropForeign(['classroom_id']);
        });
        Schema::table('maps', function(Blueprint $table2) {
            $table2->dropForeign(['building_id']);
        });
        Schema::table('seats', function(Blueprint $table3) {
            $table3->dropForeign(['classroom_id']);
        });
        Schema::table('seats', function(Blueprint $table4) {
            $table4->dropForeign(['seat_reservation_id']);
        });
        Schema::table('attendances', function(Blueprint $table5) {
            $table5->dropForeign(['classroom_id']);
        });
        Schema::table('attendances', function(Blueprint $table6) {
            $table6->dropForeign(['user_id']);
        });
        Schema::table('classroom_reservations', function(Blueprint $table7) {
            $table7->dropForeign(['classroom_id']);
        });
        Schema::table('classroom_reservations', function(Blueprint $table8) {
            $table8->dropForeign(['user_id']);
        });
        Schema::table('seat_reservations', function(Blueprint $table9) {
            $table9->dropForeign(['seat_id']);
        });
        Schema::table('seat_reservations', function(Blueprint $table10) {
            $table10->dropForeign(['user_id']);
        });

    }
}
